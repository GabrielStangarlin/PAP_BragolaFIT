<?php

use App\Models\Products;
use App\Models\Wishlist;
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
        Schema::create('products_wishlist', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Wishlist::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Products::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_wishlist');
    }
};
