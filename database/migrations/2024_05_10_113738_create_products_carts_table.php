<?php

use App\Models\Products;
use App\Models\Cart;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products_carts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Products::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Cart::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_carts');
    }
};
