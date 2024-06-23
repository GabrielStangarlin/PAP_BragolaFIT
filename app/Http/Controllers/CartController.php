<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        if(!Auth::check()) {
            //User is not Logged in
            return redirect('/login');
        }

        $productId = $request->input('product_id');
        $userId = Auth::id();

        $product = Product::find($productId);
        if(!$product){
            return redirect()->back();
        }

        $cart = Cart::where('user_id', $userId)->first();

        if(!$cart){
            $cart = Cart::create(['user_id' => $userId]);
        }

        if($cart->products->contains($productId)){
            $cartProduct = $cart->products()->find($productId);
            $cartProduct->pivot->quantity++;
            $cartProduct->pivot->save();
        } else {
            $cart->products()->attach($productId, ['quantity' => 1]);
        }

        $cart->save();

        return response()->json($cart);
    }


    public function getCartContent()
    {
        if (! Auth::check()) {
            //User is not Logged in
            return redirect('/login');
        }

        $userId = Auth::id();
        $cart = Cart::with('products')->where('user_id', $userId)->where('ordered', 0)->first();

        if (! $cart) {
            return response()->json(['error' => 'Cart not found'], 404);
        }

        return response()->json($cart);
    }
}
