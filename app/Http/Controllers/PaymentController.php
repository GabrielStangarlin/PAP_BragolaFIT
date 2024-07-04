<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Cart;
use Stripe\Stripe;
use Stripe\Charge;

class PaymentController extends Controller
{
    public function index(Request $request){
        return view('payment.payment');
    }

    
}
