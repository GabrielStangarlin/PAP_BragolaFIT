<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\User;

class SiteController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function store()
    {
        $categories = Category::all();
        $newProducts = Product::orderBy('id', 'desc')->take(8)->get();

        return view('store.store', compact('categories', 'newProducts'));
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
    
    public function dashboardHome()
    {
        $userCount = User::count();
        $productCount = Product::count();

        return view('dashboard.dHome', compact('userCount', 'productCount'));
    }
}
