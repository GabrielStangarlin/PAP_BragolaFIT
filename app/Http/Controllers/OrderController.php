<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Notifications\PurchaseConfirmed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
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
                        return "<div style='font-weight: bold; color:rgb(131, 0, 0)'>Enviado</div>";
                    } elseif ($order->order_status == 2) {
                        return "<div style='font-weight: bold; color:green;'>Recebido</div>";
                    }
                })
                ->addColumn('options', function ($order) {
                    $buttons = '
                    <a href="javascript:void(0);" id="show-order" onClick="showFunction('.$order->id.')" data-toggle="tooltip" data-original-title="show" class="show btn btn-secondary"><i class="fa-solid fa-eye"></i></a>
                    ';
                    if ($order->order_status == 0 || $order->order_status == 1) {
                        $buttons .= '
                        <a href="javascript:void(0);" id="update-order" onClick="updateFunction('.$order->id.', '.$order->order_status.')" data-toggle="tooltip" data-original-title="show" class="show btn btn-success"><i class="fa-solid fa-truck-fast"></i></a>
                        ';
                    }

                    return $buttons;
                })
                ->rawColumns(['name', 'order_status', 'options'])
                ->make(true);
        }

        return view('dashboard/dOrders');
    }

    public function checkout(Request $request)
    {
        $user = auth()->user();

        DB::beginTransaction();

        try {
            $order = Order::create([
                'user_id' => $user->id,
                'order_status' => 0,
                'ship_address' => $user->address,
                'invoicing_address' => $user->address,
            ]);

            $cartItems = Cart::with('products')->where('user_id', $user->id)->get();
            $totalPrice = 0;
            $products = [];
            $insufficientStockProducts = [];

            foreach ($cartItems as $cartItem) {
                foreach ($cartItem->products as $product) {
                    // Acessa a quantidade da tabela pivot
                    $quantity = $product->pivot->quantity;

                    $itemTotalValue = $product->price * $quantity;

                    $productInStock = Product::find($product->id);

                    if ($productInStock) {
                        if ($productInStock->quantity < $quantity) {
                            $insufficientStockProducts[] = $productInStock->name;
                        }
                    }
                }
            }

            if (!empty($insufficientStockProducts)) {
                throw new \Exception('Quantidade insuficiente para os produtos: ' . implode(', ', $insufficientStockProducts));
            }

            foreach ($cartItems as $cartItem) {
                foreach ($cartItem->products as $product) {
                    // Acessa a quantidade da tabela pivot
                    $quantity = $product->pivot->quantity;

                    $itemTotalValue = $product->price * $quantity;

                    // Cria uma nova instância de OrderProduct
                    OrderProduct::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => $quantity,
                        'value' => $product->price,
                    ]);

                    $productInStock = Product::find($product->id);

                    if ($productInStock) {
                        $productInStock->quantity -= $quantity;
                        $productInStock->save();
                    }
                    $totalPrice += $itemTotalValue;
                    $products[] = $product;
                }
            }

            Cart::where('user_id', $user->id)->delete();

            DB::commit();

            // Enviar notificação de confirmação de compra
            Notification::send($user, new PurchaseConfirmed($order, $products, $totalPrice));

            return response()->json(['status' => 'success', 'order_id' => $order->id]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }



    public function orderInfo(Request $request)
    {
        $order = Order::with('orderProducts.products')->where('id', $request->id)->first();

        return response()->json($order);
    }

    public function updateOrder(Request $request)
    {
        $order = Order::find($request->id);
        if ($order) {
            if ($order->order_status == 0) {
                $order->order_status = 1;
            } elseif ($order->order_status == 1) {
                $order->order_status = 2;
            }
            $order->save();

            return response()->json(['success' => 'Estado da encomenda atualizado com sucesso.']);
        }

        return response()->json(['error' => 'Encomenda não encontrada.'], 404);
    }
}
