<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'photo_1',
        'photo_2',
        'quantity',
    ];

    public function subcategories()
    {
        return $this->belongsToMany(Subcategory::class, 'products_subcategories');
    }

    public function wishlist()
    {
        return $this->belongsToMany(Wishlist::class);
    }

    public function cart()
    {
        return $this->belongsToMany(Cart::class);
    }

    public function order()
    {
        return $this->belongsToMany(Order::class);
    }
}
