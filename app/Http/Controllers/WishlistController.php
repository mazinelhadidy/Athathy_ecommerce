<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facades\Cart;

class WishlistController extends Controller
{
    public function add_to_wishlist(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'name' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        Cart::instance('wishlist')->add($request->product_id, $request->name, $request->quantity, $request->price)
            ->associate('App/Models/Product');
        return back()->with('success', 'Product added to wishlist successfully!');
    }
}
