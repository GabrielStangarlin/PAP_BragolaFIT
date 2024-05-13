<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    public function products(){
        return $this->belongsToMany(Products::class, products_carts , product_id , cart_id)->withPivot('quantity');
    }
}
