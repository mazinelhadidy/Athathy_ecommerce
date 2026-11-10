<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::where('status', true)->orderBy('created_at', 'desc')->paginate(12);
        return view('shop.index', compact('products'));
    }
}
