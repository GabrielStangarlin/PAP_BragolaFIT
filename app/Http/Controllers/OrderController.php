<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function listOrder()
    {
        if (request()->ajax()) {
            return datatables::of(Order::all())
                ->editColumn('name', function ($order) {
                    return $order->user->name;
                })
                ->editColumn('order_status', function ($order) {
                    if ($order->order_status == 0) {
                        return "<div style='font-weight: bold; color:blue;'>Em processamento</div>";
                    } elseif ($order->order_status == 1) {
                        return "<div style='font-weight: bold; color:yellow;'>Enviado</div>";
                    } elseif ($order->order_status == 2) {
                        return "<div style='font-weight: bold; color:green;'>Recebido</div>";
                    }
                })
                ->rawColumns(['name', 'order_status'])
                ->make(true);
        }

        return view('dashboard/dOrders');
    }

    public function checkout(Request $request)
    {
        $user = auth()->user();

        DB::transaction(function () use ($user) {
            $order = Order::create([
                'user_id' => $user->id,
                'order_status' => 0,
                'ship_address' => $user->address,
                'invoicing_address' => $user->address,
            ]);

            $cartItems = Cart::with('products')->where('user_id', $user->id)->get();

            foreach ($cartItems as $cartItem) {
                foreach ($cartItem->products as $product) {
                    // Acessa a quantidade da tabela pivot
                    $quantity = $product->pivot->quantity;

                    // Calcula o valor total do item
                    $itemTotalValue = $product->price * $quantity;

                    // Cria uma nova instância de OrderProduct
                    OrderProduct::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => $quantity,
                        'value' => $itemTotalValue,
                    ]);

                    $productInStock = Product::find($product->id);

                    if ($productInStock) {
                        if ($productInStock->quantity < $quantity) {
                            throw new \Exception('Quantidade insuficiente para o produto: '.$productInStock->name);
                        }
                        $productInStock->quantity -= $quantity;
                        $productInStock->save();
                    }
                }
            }

            Cart::where('user_id', $user->id)->delete();
        });

        return response()->json('success');
    }
}
