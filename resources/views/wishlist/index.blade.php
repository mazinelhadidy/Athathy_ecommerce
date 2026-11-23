<x-app-layout>
      <!-- Main Content Start -->

    <div class="relative bg-sky-700 text-white h-64 flex items-center justify-center bg-cover bg-center" style="background-image: url('assets/images/page-banner.jpg');">
    <div class="absolute inset-0 bg-black bg-opacity-40"></div>
    <div class="relative z-10 text-center">
        <h2 class="text-4xl font-bold mb-2">Wishlist</h2>
        <ul class="flex justify-center space-x-2 text-sm">
            <li><a href="{{ route('home.index') }}" class="hover:text-primary">Home</a></li>
            <li>/</li>
            <li class="text-primary">Wishlist</li>
        </ul>
    </div>
</div>

<section class="py-16">

    <div class="container mx-auto px-4">
        @if(Cart::instance('wishlist')->content()->count()==0)
        <div id="empty-wishlist" class="text-center py-10">
            <h2 class="text-2xl font-bold mb-4">There are no more items in your wishlist</h2>
            <img src="assets/images/wishlist.png" alt="Empty Wishlist" class="mx-auto mb-6 max-w-xs">
            <p class="text-gray-500 mb-6">No item found in your wishlist</p>
            <a href="{{route('shop.index')}}" class="inline-block bg-primary text-white px-6 py-2 rounded hover:bg-blue-600 transition">Wishlist Now</a>
        </div>
        @else
        <div id="wishlist-content" class="overflow-x-auto">
            <table class="w-full wishlist-table">
                <thead class="bg-gray-100 border-b">
                    <tr>
                        <th class="py-4 px-4 text-left font-bold text-gray-700">Image</th>
                        <th class="py-4 px-4 text-left font-bold text-gray-700">Product Information</th>
                        <th class="py-4 px-4 text-left font-bold text-gray-700">Quantity</th>
                        <th class="py-4 px-4 text-left font-bold text-gray-700">Add to Cart</th>
                        <th class="py-4 px-4 text-left font-bold text-gray-700">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach(Cart::instance('wishlist')->content() as $item)
                    @php
                        $product = Cart::model($item->rowId);
                    @endphp
                    <tr>
                        <td class="py-4 px-4 product-thumb" data-label="Image">
                            <a href="{{route('shop.product.details',$product->slug)}}"><img src="{{asset('uploads/products/thumbnails')}}/{{$product->image}}" class="w-20 h-20 object-cover rounded" alt="{{ $item->name }}"></a>
                        </td>
                        <td class="py-4 px-4" data-label="Product">
                            <h6 class="font-bold text-gray-800"><a href="{{route('shop.product.details',$product->slug)}}" class="hover:text-primary">{{ $item->name }}</a></h6>
                            <div class="text-sm mt-1">
                                <span class="text-primary font-bold">${{number_format($item->price,2)}}</span>
                            </div>
                        </td>
                        <td class="py-4 px-4" data-label="Quantity">
                            <div class="flex border rounded w-max">
                                1
                            </div>
                        </td>
                        <td class="py-4 px-4" data-label="Add to Cart">
                            <button class="bg-sky-800 text-white px-4 py-2 rounded hover:bg-primary transition text-sm">Add to Cart</button>
                        </td>
                        <td class="py-4 px-4" data-label="Action">
                            <form action="{{ route('wishlist.remove',$item->rowId) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this item from your wishlist?');">
                                @csrf
                                @method('DELETE')
                            <button type="submit" class="text-gray-400 hover:text-red-500 transition"><i class="fa-solid fa-trash-can text-xl"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach                
                </tbody>
            </table>
        </div>

         <div class="flex flex-col sm:flex-row justify-between items-center mb-12 gap-4">
                    <a href="{{ route('shop.index') }}" class="bg-sky-800 text-white px-6 py-3 rounded hover:bg-primary transition w-full sm:w-auto text-center">Continue Shopping</a>
                    <div class="flex gap-4 w-full sm:w-auto">
                        <form action="{{route('wishlist.clear')}}" method="POST" class="w-full" onsubmit="return confirm('Are you sure you want to clear your wishlist?');">
                            @csrf
                            @method('DELETE')
                        <button type="submit" class="border border-gray-800 text-gray-800 px-6 py-3 rounded hover:bg-sky-800 hover:text-white transition w-full sm:w-auto text-center">Clear Wishlist</button>
                        </form>
                    </div>
                </div>

        @endif 
    </div>
</section>

    <!-- Main Content End -->
</x-app-layout>