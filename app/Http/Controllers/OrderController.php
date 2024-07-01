<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
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
                }
            }

            Cart::where('user_id', $user->id)->delete();
        });

        return response()->json('success');
    }
}
