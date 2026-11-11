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

    public function productDetails(string $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', true)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        return view('shop.details', compact('product', 'relatedProducts'));
    }
}
