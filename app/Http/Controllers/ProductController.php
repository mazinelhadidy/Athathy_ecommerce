<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Carbon\Carbon;
use Intervention\Image\Laravel\Facades\Image;


class ProductController extends Controller
{
    public function products()
    {
        $products = Product::with('category', 'brand')->orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.products', compact('products'));
    }

    public function productAdd()
    {
        $categories = Category::select('id', 'name')->orderBy('name')->get();
        $brands = Brand::select('id', 'name')->orderBy('name')->get();
        return view('admin.product-add', compact('categories', 'brands'));
    }

    public function productStore(Request $request)
    {
        $request->validate([
            'name'             => 'required|string|max:255',
            'slug'             => 'required|string|max:255|unique:products,slug',
            'short_description' => 'nullable|string|max:500',
            'description'      => 'nullable|string',
            'regular_price'    => 'required|numeric|min:0',
            'sale_price'       => 'nullable|numeric|min:0|lt:regular_price',
            'SKU'              => 'required|string|max:100|unique:products,SKU',
            'stock_status'     => 'required|in:in_stock,out_of_stock,low_stock',
            'quantity'         => 'required|integer|min:0',
            'featured'         => 'boolean',
            'status'           => 'boolean',
            'category_id'      => 'nullable|exists:categories,id',
            'brand_id'         => 'nullable|exists:brands,id',
            'image'            => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'image.*'          => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->short_description = $request->short_description;
        $product->information = $request->information;
        $product->description = $request->description;
        $product->regular_price = $request->regular_price;
        $product->sale_price = $request->sale_price;
        $product->SKU = $request->SKU;
        $product->stock_status = $request->stock_status;
        $product->featured = $request->featured;
        $product->status = $request->status;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;

        $curent_timestamp = Carbon::now()->timestamp;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $curent_timestamp . '.' . $image->extension();
            $this->resizeAndSaveImage($image, $imageName, 'uploadds/products', 570, 604);
            $this->resizeAndSaveImage($image, $imageName, 'uploadds/products/thumbnails', 270, 303);
            $product->image = $imageName;
        }

        $gallry_arr = array();
        $gallery_images = "";
        $counter = 1;

        if ($request->hasFile('images')) {
            $allowedfileextension = ['png', 'jpg', 'jpeg', 'webp'];
            $files = request()->file('images');
            foreach ($files as $file) {
                $gextension = $file->getClientOriginalExtension();
                $gcheck = in_array($gextension, $allowedfileextension);
                if ($gcheck) {
                    $gaImagename = $curent_timestamp . '_' . $counter . '.' . $gextension;
                    $this->resizeAndSaveImage($file, $gaImagename, 'uploads/products/gallery', 570, 604);
                    $this->resizeAndSaveImage($file, $gaImagename, 'uploads/products/gallery/thumbnails', 270, 303);
                    array_push($gallry_arr, $gaImagename);
                    $counter++;
                }
            }
            $gallery_images = implode(",", $gallry_arr);
        }
        $product->images = $gallery_images;

        $product->save();

        return redirect()->route('admin.products')->with('success', 'Product Added Successfully.');
    }

    public function resizeAndSaveImage($image, $imageName, $folder, $width = 270, $height = 303)
    {
        //
    }
}
