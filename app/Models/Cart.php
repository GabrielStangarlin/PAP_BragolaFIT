<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    public function products(){
        return $this->belongsToMany(Product::class, products_carts , product_id , cart_id)->withPivot('quantity');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function shipment(){
        return $this->hasOne(Shipment::class);
    }
}
