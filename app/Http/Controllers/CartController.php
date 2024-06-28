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
        $notLogged = false;

        if (! Auth::check()) {
            $notLogged = true;

            return response()->json([
                'error' => 'User is not Logged in',
                'not_logged_id' => $notLogged,
            ], 403);
        }

        $productId = $request->input('productId');
        $userId = Auth::user()->id;

        $product = Product::find($productId);
        if (! $product) {
            return redirect()->back();
        }

        $cart = Cart::where('user_id', $userId)->first();

        if (! $cart) {
            $cart = Cart::create(['user_id' => $userId]);
        }

        if ($cart->products->contains($productId)) {
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
            // User is not logged in
            return redirect('/login');
        }

        $userId = Auth::id();
        $cart = Cart::with('products')->where('user_id', $userId)->first();

        if (! $cart) {
            return response()->json(['error' => 'Cart not found'], 404);
        }

        $cartContent = $cart->products->map(function ($product) {
            return [
                'name' => $product->name,
                'photo_1' => $product->photo_1,
                'price' => number_format($product->price, 2, ',', '.'),
                'quantity' => $product->pivot->quantity,
            ];
        });

        $totalPrice = $cart->products->sum(function ($product) {
            return $product->price * $product->pivot->quantity;
        });

        return response()->json([
            'products' => $cartContent,
            'totalPrice' => number_format($totalPrice, 2, ',', '.'),
        ]);
    }

    public function updateQuantity(Request $request)
    {
        if (! Auth::check()) {
            return response()->json(['error' => 'User not authenticated'], 403);
        }

        $userId = Auth::id();
        $cart = Cart::where('user_id', $userId)->first();

        if (! $cart) {
            return response()->json(['error' => 'Cart not found'], 404);
        }

        $productId = intval($request->product_id); // Converter para inteiro para garantir a formatação correta

        // Verifique se o produto existe no carrinho
        $product = $cart->products()->where('product_id', $productId)->first();

        if (! $product) {
            return response()->json(['error' => 'Product not found in cart'], 404);
        }

        // Atualize a quantidade do produto no carrinho
        $newQuantity = $product->pivot->quantity + $request->change;

        if ($newQuantity < 1) {
            $cart->products()->detach($productId);
        } else {
            $cart->products()->updateExistingPivot($productId, ['quantity' => $newQuantity]);
        }

        return response()->json(['success' => true]);
    }
}
