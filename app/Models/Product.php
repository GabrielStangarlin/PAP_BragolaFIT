<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsToMany(Category::class);
    }

    public function wishlist()
    {
        return $this->belongsToMany(Wishlist::class);
    }

    public function cart()
    {
        return $this->belongsToMany(Cart::class);
    }
}
