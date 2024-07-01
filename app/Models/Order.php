<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'shipment_id', 'order_status', 'ship_address', 'invoicing_address',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'orders_products')
            ->withPivot('value', 'quantity');
    }
}
