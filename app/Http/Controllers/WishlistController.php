<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    

     public function add(Request $request)
        {
            $wishlist = Wishlist::firstOrCreate(['user_id' => Auth::id()]);
            $productId = $request->product_id;

            if ($wishlist->products()->where('product_id', $productId)->exists()) {
                $wishlist->products()->detach($productId);
                $action = 'removed';
            } else {
                $wishlist->products()->syncWithoutDetaching($productId);
                $action = 'added';
            }

    

            return response()->json(['success' => true, 'action' => $action, 'product_id' => $productId]);
        }

    public function hasWishlistItems()
    {
        $wishlist = Wishlist::where('user_id', Auth::id())->first();
        $hasItems = $wishlist && $wishlist->products()->count() > 0;
        
        return response()->json(['has_items' => $hasItems]);
    }

}
