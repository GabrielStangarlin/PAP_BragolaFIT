<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;

class SiteController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function dashboardHome()
    {
        $userCount = User::count();
        $productCount = Product::count();

        return view('dashboard.dHome', compact('userCount', 'productCount'));
    }
}
