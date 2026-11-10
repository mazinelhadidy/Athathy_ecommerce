<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Carbon\Carbon;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Exports\ProductExport;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function products(Request $request)
    {
        $query = Product::with('category', 'brand');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('SKU', 'like', "%$search%");
            });
        }
        if (request()->filled('category')) {
            $query->where('category_id', $request->input('category'));
        }
        if (request()->filled('brand')) {
            $query->where('brand_id', $request->input('brand'));
        }
        if (request()->has('status') && $request->input('status') !== null) {
            $query->where('status', $request->input('status'));
        }

        $products = $query->orderBy('created_at', 'DESC')->paginate(10)->withQueryString();

        $categories = Category::select('id', 'name')->orderBy('name')->get();
        $brands = Brand::select('id', 'name')->orderBy('name')->get();

        return view('admin.products', compact('products', 'categories', 'brands'));
    }

    public function productAdd()
    {
        $categories = Category::select('id', 'name')->orderBy('name')->get();
        $brands     = Brand::select('id', 'name')->orderBy('name')->get();
        return view('admin.product-add', compact('categories', 'brands'));
    }

    public function productStore(Request $request)
    {
        $request->validate([
            'name'             => 'required|string|max:255',
            'slug'             => 'required|string|max:255|unique:products,slug',
            'short_description' => 'nullable|string|max:500',
            'description'       => 'required|string',
            'regular_price'    => 'required|numeric|min:0',
            'sale_price'       => 'nullable|numeric|min:0|lt:regular_price',
            'SKU'              => 'required|string|max:100|unique:products,SKU',
            'stock_status'     => 'required|in:in_stock,out_of_stock,low_stock',
            'quantity'         => 'required|integer|min:0',
            'featured'         => 'nullable|boolean',
            'status'           => 'nullable|boolean',
            'category_id'      => 'nullable|exists:categories,id',
            'brand_id'         => 'nullable|exists:brands,id',
            'image'            => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'images'           => 'nullable|array',
            'images.*'         => 'image|mimes:jpeg,png,jpg,webp|max:2048',
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
        $product->featured = $request->boolean('featured');
        $product->status   = $request->boolean('status');
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;

        $curent_timestamp = Carbon::now()->timestamp;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $curent_timestamp . '.' . $image->extension();
            $this->resizeAndSaveImage($image, $imageName, 'uploads/products', 570, 604);
            $this->resizeAndSaveImage($image, $imageName, 'uploads/products/thumbnails', 270, 303);
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
        $destinationPath = public_path($folder);
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        $manager = new ImageManager(new Driver());
        $manager->decodePath($image->getRealPath())->cover($width, $height)->save($destinationPath . '/' . $imageName);
    }

    public function productEdit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::select('id', 'name')->orderBy('name')->get();
        $brands = Brand::select('id', 'name')->orderBy('name')->get();

        return view('admin.product-edit', compact('product', 'categories', 'brands'));
    }

    public function productUpdate(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name'             => 'required|string|max:255',
            'slug'             => 'required|string|max:255|unique:products,slug,' . $product->id,
            'short_description' => 'nullable|string|max:500',
            'information'      => 'nullable|string',
            'description'      => 'required|string',
            'regular_price'    => 'required|numeric|min:0',
            'sale_price'       => 'nullable|numeric|min:0|lt:regular_price',
            'SKU'              => 'required|string|max:100|unique:products,SKU,' . $product->id,
            'stock_status'     => 'required|in:in_stock,out_of_stock,low_stock',
            'quantity'         => 'required|integer|min:0',
            'featured'         => 'nullable|boolean',
            'status'           => 'nullable|boolean',
            'category_id'      => 'nullable|exists:categories,id',
            'brand_id'         => 'nullable|exists:brands,id',
            'image'            => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'images'           => 'nullable|array',
            'images.*'         => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $product->name = $request->name;
        $product->slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);
        $product->short_description = $request->short_description;
        $product->information = $request->information;
        $product->description = $request->description;
        $product->regular_price = $request->regular_price;
        $product->sale_price = $request->sale_price;
        $product->SKU = $request->SKU;
        $product->stock_status = $request->stock_status;
        $product->quantity = $request->quantity;
        $product->featured = $request->boolean('featured');
        $product->status   = $request->boolean('status');
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;

        $curent_timestamp = Carbon::now()->timestamp;

        if ($request->hasFile('image')) {

            if ($product->image && File::exists(public_path('uploads/products/' . $product->image))) {
                unlink(public_path('uploads/products/' . $product->image));
            }
            if ($product->image && File::exists(public_path('uploads/products/thumbnails/' . $product->image))) {
                unlink(public_path('uploads/products/thumbnails/' . $product->image));
            }

            $image = $request->file('image');
            $imageName = $curent_timestamp . '.' . $image->extension();
            $this->resizeAndSaveImage($image, $imageName, 'uploads/products', 570, 604);
            $this->resizeAndSaveImage($image, $imageName, 'uploads/products/thumbnails', 270, 303);
            $product->image = $imageName;
        }

        $gallery_arr = $product->images ? explode(',', $product->images) : [];
        $counter = 1;
        $prefix = $curent_timestamp . '_';

        if ($request->deleted_gallery_images && is_array($request->deleted_gallery_images)) {
            foreach ($request->deleted_gallery_images as $deletedImage) {
                $deletedImage = basename($deletedImage);

                $key = array_search($deletedImage, $gallery_arr);
                if ($key === false) {
                    continue;
                }

                File::delete(public_path('uploads/products/gallery/' . $deletedImage));
                File::delete(public_path('uploads/products/gallery/thumbnails/' . $deletedImage));

                unset($gallery_arr[$key]);
            }
            $gallery_arr = array_values($gallery_arr);
        }

        if ($request->hasFile('images')) {
            $files = request()->file('images');
            $counter = 1;

            foreach ($files as $file) {
                $gextension = $file->getClientOriginalExtension();
                $gaImagename = $prefix . $counter . '.' . $gextension;

                $this->resizeAndSaveImage($file, $gaImagename, 'uploads/products/gallery', 570, 604);
                $this->resizeAndSaveImage($file, $gaImagename, 'uploads/products/gallery/thumbnails', 270, 303);

                array_push($gallery_arr, $gaImagename);
                $counter++;
            }
        }

        $product->images = !empty($gallery_arr) ? implode(",", $gallery_arr) : null;

        $product->save();

        return redirect()->route('admin.products')->with('success', 'Product Updated Successfully.');
    }

    public function productDelete($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image && File::exists(public_path('uploads/products/' . $product->image))) {
            unlink(public_path('uploads/products/' . $product->image));
        }
        if ($product->image && File::exists(public_path('uploads/products/thumbnails/' . $product->image))) {
            unlink(public_path('uploads/products/thumbnails/' . $product->image));
        }

        if ($product->images) {
            $gellery_images = explode(",", $product->images);
            foreach ($gellery_images as $gellery_image) {
                if ($gellery_image && File::exists(public_path('uploads/products/gallery/' . $gellery_image))) {
                    unlink(public_path('uploads/products/gallery/' . $gellery_image));
                }
                if ($gellery_image && File::exists(public_path('uploads/products/gallery/thumbnails/' . $gellery_image))) {
                    unlink(public_path('uploads/products/gallery/thumbnails/' . $gellery_image));
                }
            }
        }
        $product->delete();
        return redirect()->route('admin.products')->with('success', 'Product Deleted Successfully.');
    }

    public function productBulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',      // الarray نفسه 
            'ids.*' => 'exists:products,id' //  الarray العناصر الي في
        ]);

        $ids = $request->ids;
        $products = Product::whereIn('id', $ids)->get();

        foreach ($products as $product) {
            if ($product->image && File::exists(public_path('uploads/products/' . $product->image))) {
                unlink(public_path('uploads/products/' . $product->image));
            }
            if ($product->image && File::exists(public_path('uploads/products/thumbnails/' . $product->image))) {
                unlink(public_path('uploads/products/thumbnails/' . $product->image));
            }

            if ($product->images) {
                $gellery_images = explode(",", $product->images);
                foreach ($gellery_images as $gellery_image) {
                    if ($gellery_image && File::exists(public_path('uploads/products/gallery/' . $gellery_image))) {
                        unlink(public_path('uploads/products/gallery/' . $gellery_image));
                    }
                    if ($gellery_image && File::exists(public_path('uploads/products/gallery/thumbnails/' . $gellery_image))) {
                        unlink(public_path('uploads/products/gallery/thumbnails/' . $gellery_image));
                    }
                }
            }
            $product->delete();
        }
        return back()->with('success', count($ids) . ' Products Deleted Successfully.');
    }

    public function productExport()
    {
        return Excel::download(new ProductExport, 'products.xlsx');
    }
}
