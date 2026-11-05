<x-admin-layout>
       <main class="flex-1 overflow-y-auto p-6 bg-gray-100">

                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Products</h1>
                        <p class="text-sm text-gray-500">Manage your product catalog</p>
                    </div>
                    <a href="product-add.php" class="bg-primary hover:bg-blue-600 text-white px-5 py-2.5 rounded-lg text-sm font-medium transition flex items-center gap-2 shadow-sm">
                        <i class="fa-solid fa-plus"></i> Add New Product
                    </a>
                </div>

                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 mb-6">
                    <div class="flex flex-col md:flex-row gap-4 justify-between">
                        <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto">
                            <div class="relative w-full md:w-64">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                    <i class="fa-solid fa-search text-gray-400"></i>
                                </span>
                                <input type="text" class="w-full pl-10 pr-4 py-2 border rounded-lg text-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary" placeholder="Search product name...">
                            </div>

                            <select class="w-full md:w-48 border px-3 py-2 rounded-lg text-sm focus:outline-none focus:border-primary bg-white text-gray-600">
                                <option value="">All Categories</option>
                                <option value="furniture">Furniture</option>
                                <option value="decor">Decor</option>
                                <option value="lighting">Lighting</option>
                            </select>

                            <select class="w-full md:w-40 border px-3 py-2 rounded-lg text-sm focus:outline-none focus:border-primary bg-white text-gray-600">
                                <option value="">All Status</option>
                                <option value="active">Active</option>
                                <option value="draft">Draft</option>
                                <option value="out">Out of Stock</option>
                            </select>
                        </div>

                        <button class="border border-gray-300 text-gray-600 hover:bg-gray-50 px-4 py-2 rounded-lg text-sm font-medium transition flex items-center justify-center gap-2">
                            <i class="fa-solid fa-file-export"></i> Export
                        </button>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left whitespace-nowrap">
                            <thead class="bg-gray-50 text-gray-500 text-xs uppercase font-semibold">
                                <tr>
                                    <th class="px-6 py-4">
                                        <input type="checkbox" class="rounded border-gray-300 text-primary focus:ring-primary">
                                    </th>
                                    <th class="px-6 py-4">Product Name</th>
                                    <th class="px-6 py-4">Brand</th>
                                    <th class="px-6 py-4">Category</th>
                                    <th class="px-6 py-4">Price</th>
                                    <th class="px-6 py-4">Stock</th>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-6 py-4 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($products as $product)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4">
                                        <input type="checkbox" class="rounded border-gray-300 text-primary focus:ring-primary">
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <img src="{{ asset('uploads/products/thumbnails')}}/{{ $product->image }}" class="w-12 h-12 rounded object-cover border" alt="{{ $product->name }}">
                                            <div>
                                                <p class="font-semibold text-gray-800 text-sm">{{ $product->name }}</p>
                                                <p class="text-xs text-gray-500">SKU: {{$product->SKU}}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $product->brand->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $product->category->name }}</td>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-800">
                                        @if($product->sale_price)
                                        <span class="line-through text-gray-400 mr-2">${{number_format($product->regular_price, 2)}}</span>
                                        <span class="text-primary">${{number_format($product->sale_price, 2)}}</span>
                                        @else
                                        <span class="text-gray-800">${{ number_format($product->regular_price, 2) }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $product->quantity }}</td>
                                    <td class="px-6 py-4">
                                        <span class="bg-green-100 text-green-700 px-2.5 py-1 rounded-full text-xs font-semibold">
                                            @if($product->status)
                                            Published
                                            @else
                                            Draft
                                            @endif
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="product-edit.php" class="w-8 h-8 rounded-full hover:bg-gray-100 text-blue-500 transition flex items-center justify-center" title="Edit">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <button class="w-8 h-8 rounded-full hover:bg-gray-100 text-red-500 transition flex items-center justify-center" onclick="deleteProduct(this, 'Samsung', 101)" title="Delete">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                @empty  
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center text-gray-500">
                                            <i class="fa-solid fa-boxes-stacked text-4xl mb-3 text-gray-300"></i>
                                            <h3 class="text-lg font-medium text-gray-900">Products not available</h3>
                                            <p class="text-sm mt-1">You haven't added any products to your store yet.</p>
                                            <a href="category-add.php" class="mt-4 text-primary hover:underline text-sm font-medium">
                                                Add your first product
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="px-6 py-4 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                       {{ $products->links() }}
                    </div>
                </div>

            </main>

            <!-- Main Content End -->
</x-admin-layout>