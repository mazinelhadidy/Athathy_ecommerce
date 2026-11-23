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

    public function add_to_cart(Request $request)
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

    public function update_cart(Request $request)
    {
        $request->validate([
            'quantity' => 'required|integer|min:-1',
        ]);
        Cart::instance('cart')->update($request->rowId, $request->quantity);
        return back()->with('success', 'Cart updated successfully!');
    }

    public function remove_form_cart(string $rowId)
    {
        Cart::instance('cart')->remove($rowId);
        return back()->with('success', 'Product removed from cart successfully!');
    }

    public function clear_cart()
    {
        Cart::instance('cart')->destroy();
        return back()->with('success', 'Cart cleared successfully!');
    }
}
