<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query()->where('status', true);

        $sortBy = $request->input('sort_by', 'newest');

        match ($sortBy) {
            'price_asc' => $query->orderBy('sale_price', 'asc'),
            'price_desc' => $query->orderBy('sale_price', 'desc'),
            'featured'  => $query->where('featured', true),
            default    => $query->latest()
        };

        $perPage = $request->input('per_page', 3);

        $products = $query->paginate($perPage)->withQueryString();

        return view('shop.index', compact('products'));
    }

    public function productDetails(string $slug)
    {
        $product = Product::where('slug', $slug)->where('status', true)->firstOrFail();
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', true)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        return view('shop.details', compact('product', 'relatedProducts'));
    }
}
