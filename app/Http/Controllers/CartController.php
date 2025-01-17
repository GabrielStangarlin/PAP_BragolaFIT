<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cartDetails(Request $request)
    {
        $categories = Category::all();
        $cart = Cart::where('user_id', Auth::user()->id)->first();

        if(Auth::check()){

            return view('cart.cart_details', compact('cart', 'categories'));
        }else {
            return redirect('/login');
        }

    }

    public function checkProductQuantity($productId)
    {
        $product = Product::find($productId);

        if (! $product) {
            return response()->json(['error' => 'Produto não encontrado'], 404);
        }

        return response()->json(['quantity' => $product->quantity]);
    }

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

        $wishlist = Wishlist::where('user_id', $userId)->first();
        if ($wishlist && $wishlist->products->contains($productId)) {
            $wishlist->products()->detach($productId);
        }

        $totalItems = $cart->products->sum('pivot.quantity');

        return response()->json([
            'cart' => $cart,
            'cartCounter' => $totalItems
        ]);
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
                'id' => $product->id,
                'name' => $product->name,
                'photo_1' => $product->photo_1,
                'price' => number_format($product->price, 2, ',', '.'),
                'quantity' => $product->pivot->quantity,
            ];
        });

        $totalPrice = $cart->products->sum(function ($product) {
            return $product->price * $product->pivot->quantity;
        });

        $totalItems = $cart->products->sum(function ($product) {
            return $product->pivot->quantity;
        });

        return response()->json([
            'products' => $cartContent,
            'totalPrice' => number_format($totalPrice, 2, ',', '.'),
            'totalItems' => $totalItems, // Adicionando o total de itens ao retorno
        ]);
    }

    public function updateCartQuantity(Request $request)
    {
        if (! Auth::check()) {
            return response()->json(['error' => 'User is not logged in'], 403);
        }

        $userId = Auth::id();
        $productId = $request->input('productId');
        $action = $request->input('action');

        $cart = Cart::where('user_id', $userId)->first();

        if (! $cart) {
            return response()->json(['error' => 'Cart not found'], 404);
        }

        $cartProduct = $cart->products()->where('product_id', $productId)->first();

        if (! $cartProduct) {
            return response()->json(['error' => 'Product not found in cart'], 404);
        }

        if ($action == 'increase') {
            $cartProduct->pivot->quantity++;
        } elseif ($action == 'decrease') {
            $cartProduct->pivot->quantity--;

            if ($cartProduct->pivot->quantity <= 0) {
                $cart->products()->detach($productId);

                if ($cart->products()->count() == 0) {
                    $cart->delete();

                    return response()->json(['cartEmpty' => true]);
                }
            }
        }

        $cartProduct->pivot->save();

        return response()->json(['success' => true, 'cartCounter' => $cart->count()]);
    }

    public function removeItem(Request $request)
    {
        $id = $request->productId;
        $user = Auth::id();
        $cart = Cart::where('user_id', $user)->first();

        if (! $cart) {
            return response()->json(['success' => false, 'message' => 'Carrinho não encontrado.']);
        }

        $product = $cart->products()->where('product_id', $id)->first();

        if ($product) {
            $cart->products()->detach($id);

            return response()->json(['success' => true, 'message' => 'Item removido com sucesso!']);
        }

        if ($cart->products <= 0) {
            $cart->delete();
        }

        return response()->json(['success' => false, 'message' => 'Produto não encontrado no carrinho.']);
    }


    //mario
    public function increaseQuantity(Request $request)
    {
        $productId = $request->productId;
        $user = Auth::id();
        $cart = Cart::where('user_id', $user)->first();

        if ($cart) {
            $product = $cart->products()->where('product_id', $productId)->first();

            if ($product) {
                $product->pivot->quantity += 1;
                $product->pivot->save();
                $totalPrice = $cart->products->sum(function ($product) {
                    return $product->price * $product->pivot->quantity;
                });

                return response()->json(['success' => true, 'message' => 'Quantidade aumentada com sucesso!', 'quantity' => $product->pivot->quantity, 'totalPrice' => $totalPrice]);
            }
        }

        return response()->json(['success' => false, 'message' => 'Produto não encontrado no carrinho.']);
    }

    public function decreaseQuantity(Request $request)
    {
        $productId = $request->productId;
        $user = Auth::id();
        $cart = Cart::where('user_id', $user)->first();
    
        if ($cart) {
            $product = $cart->products()->where('product_id', $productId)->first();
    
            if ($product) {
                if ($product->pivot->quantity > 1) {
                    $product->pivot->quantity -= 1;
                    $product->pivot->save();
                    $totalPrice = $cart->products->sum(function ($product) {
                        return $product->price * $product->pivot->quantity;
                    });
    
                    return response()->json(['success' => true, 'message' => 'Quantidade diminuída com sucesso!', 'quantity' => $product->pivot->quantity, 'totalPrice' => $totalPrice]);
                } else {
                    // Remove item if quantity is 1
                    return $this->removeItem($request);
                }
            }
        }
    
        return response()->json(['success' => false, 'message' => 'Produto não encontrado no carrinho ou quantidade já está em 1.']);
    }

    public function cartDe()
{
    $user = Auth::id();
    $cart = Cart::where('user_id', $user)->with('products')->first();
    
    if ($cart) {
        return response()->json(['success' => true, 'cart' => $cart]);
    }
    
    return response()->json(['success' => false, 'message' => 'Carrinho não encontrado.']);
}
}
