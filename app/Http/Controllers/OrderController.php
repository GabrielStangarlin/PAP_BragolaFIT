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

            $cartItems = Cart::where('user_id', $user->id)->get();

            $totalValue = 0;
            $totalQuantity = 0;

            foreach ($cartItems as $item) {
                $itemTotalValue = $item->product->price * $item->quantity;
                $totalValue += $itemTotalValue;
                $totalQuantity += $item->quantity;

                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'value' => $itemTotalValue,
                ]);
            }

            Cart::where('user_id', $user->id)->delete();
        });

        return response()->json(['success' => true]);
    }
}
