<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function store()
    {
        $categories = Category::all();
        $bestSellers = Product::orderBy('id', 'asc')->take(8)->get();
        $newProducts = Product::orderBy('id', 'desc')->take(8)->get();
        $wishlist = Wishlist::where('user_id', Auth::id())->first();
        $wishlistProductIds = $wishlist ? $wishlist->products->pluck('id')->toArray() : [];

        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->first();
        } else {
            $cart = null;
        }

        return view('store.store', compact('categories', 'newProducts', 'bestSellers', 'cart', 'wishlistProductIds'));
    }

    public function storectg()
    {
        $categories = Category::all();
        $products = Product::orderBy('id', 'desc')->take(8)->get();

        return view('store.store_ctg', compact('categories', 'products'));
    }

    public function filterBySubcategory($id)
    {
        $categories = Category::all();
        $subcategory = Subcategory::findOrFail($id);

        // Usando Eloquent para buscar os produtos relacionados à subcategoria
        $products = Product::whereHas('subcategories', function ($query) use ($id) {
            $query->where('subcategories.id', $id);
        })->get();

        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->first();
        } else {
            $cart = null;
        }
        $wishlist = Wishlist::where('user_id', Auth::id())->first();
        $wishlistProductIds = $wishlist ? $wishlist->products->pluck('id')->toArray() : [];

        return view('store.store_subctg', compact('categories', 'products', 'subcategory', 'cart', 'wishlistProductIds'));
    }

    public function filterByCategory($id)
    {
        $categories = Category::all();

        // Busca a categoria pelo ID
        $category = Category::findOrFail($id);

        // Busca todas as subcategorias da categoria
        $subcategories = $category->subcategories;

        // Usando Eloquent para buscar os produtos relacionados à categoria e suas subcategorias
        $products = Product::whereHas('subcategories', function ($query) use ($id) {
            $query->whereHas('category', function ($query) use ($id) {
                $query->where('categories.id', $id);
            });
        })->get();

        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->first();
        } else {
            $cart = null;
        }
        $wishlist = Wishlist::where('user_id', Auth::id())->first();
        $wishlistProductIds = $wishlist ? $wishlist->products->pluck('id')->toArray() : [];

        return view('store.store_ctg', compact('categories', 'products', 'category', 'subcategories', 'cart', 'wishlistProductIds'));
    }

    public function dashboardHome()
    {
        $userCount = User::count();
        $productCount = Product::count();
        $orderCount = Order::count();

        if(Auth::user()->isAdmin == 1)
        {
            return view('dashboard.dHome', compact('userCount', 'productCount', 'orderCount'));
        }else {
            return redirect()->route('store');
        }
    }


    public function search(Request $request)
    {
        $query = $request->input('query');

        // Busca os produtos pelo nome
        $products = Product::where('name', 'LIKE', "%{$query}%")->get();

        // Obtém os IDs dos produtos na wishlist do usuário autenticado
        $wishlistProductIds = auth()->check() && auth()->user()->wishlist
        ? auth()->user()->wishlist->pluck('id')->toArray()
        : [];


        // Obtém todas as categorias (ou conforme sua lógica de negócio)
        $categories = Category::all();

        // Retorna a view com os resultados da busca e os IDs dos produtos na wishlist
        return view('store.search_results', compact('products', 'wishlistProductIds', 'categories','query'));
    }
}
