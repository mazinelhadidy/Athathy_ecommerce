<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facades\Cart;

class CartController extends Controller
{
    public function index()
    {
        return view('cart.index');
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'name' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0'
        ]);

        Cart::instance('cart')->add($request->product_id, $request->name, $request->quantity, $request->price)
            ->associate('App\Models\Product');
        return back()->with('success', 'Product added to cart successfully!');
    }
}
