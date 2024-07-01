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

        return view('store.store', compact('categories', 'newProducts', 'bestSellers', 'cart', "wishlistProductIds"));
    }

    public function storectg()
    {
        $categories = Category::all();
        $products = Product::orderBy('id', 'desc')->take(8)->get();

        return view('store.store_showctg', compact('categories', 'products'));
    }

    public function filterBySubcategory($id)
    {
        $categories = Category::all();

        // Busca a subcategoria pelo ID
        $subcategory = Subcategory::findOrFail($id);

        // Usando Eloquent para buscar os produtos relacionados à subcategoria
        $products = Product::whereHas('subcategories', function ($query) use ($id) {
            $query->where('subcategories.id', $id);
        })->get();

        return view('store.store_showctg', compact('categories', 'products', 'subcategory'));
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

        return view('store.store_showctg1', compact('categories', 'products', 'category', 'subcategories'));
    }

    public function dashboardHome()
    {
        $userCount = User::count();
        $productCount = Product::count();
        $orderCount = Order::count();

        return view('dashboard.dHome', compact('userCount', 'productCount', 'orderCount'));
    }
}
