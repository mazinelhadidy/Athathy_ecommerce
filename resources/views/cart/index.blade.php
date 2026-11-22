<x-app-layout>
      <!-- Main Content Start -->

    <div class="relative bg-sky-700 text-white h-64 flex items-center justify-center bg-cover bg-center" style="background-image: url({{ asset('assets/images/page-banner.jpg') }});">
        <div class="absolute inset-0 bg-black bg-opacity-40"></div>
        <div class="relative z-10 text-center">
            <h2 class="text-4xl font-bold mb-2">Cart</h2>
            <ul class="flex justify-center space-x-2 text-sm">
                <li><a href="{{route('home.index')}}" class="hover:text-primary">Home</a></li>
                <li>/</li>
                <li class="text-primary">Cart</li>
            </ul>
        </div>
    </div>

    <section class="py-16">
        <div class="container mx-auto px-4">

            @if(Cart::instance('cart')->content()->count() == 0)
            <div id="empty-cart" class="text-center py-10 ">
                <h2 class="text-2xl font-bold mb-4">There are no more items in your cart</h2>
                <img src="{{ asset("assets/images/cart.png") }}" alt="Empty Cart" class="mx-auto mb-6 max-w-xs">
                <p class="text-gray-500 mb-6">No item found in your cart</p>
                <a href="{{ route('shop.index') }}" class="inline-block bg-primary text-white px-6 py-2 rounded hover:bg-blue-600 transition">Continue Browsing</a>
            </div>
            @else
            <div id="cart-content" class="cart-wrapper">
                <div class="overflow-x-auto mb-8">
                    <table class="w-full cart-table">
                        <thead class="bg-gray-100 border-b">
                            <tr>
                                <th class="py-4 px-4 text-left font-bold text-gray-700">Image</th>
                                <th class="py-4 px-4 text-left font-bold text-gray-700">Product Information</th>
                                <th class="py-4 px-4 text-left font-bold text-gray-700">Quantity</th>
                                <th class="py-4 px-4 text-left font-bold text-gray-700">Total Price</th>
                                <th class="py-4 px-4 text-left font-bold text-gray-700">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach(Cart::instance('cart')->content() as $item)

                            @php
                                $product= Cart::model($item->rowId);
                            @endphp

                            <tr>
                                <td class="py-4 px-4 product-thumb" data-label="Image">
                                    <a href="{{route('shop.product.details',$product->slug)}}"><img src="{{asset("uploads/products/thumbnails")}}/{{$product->image}}" class="w-20 h-20 object-cover rounded" alt="{{$item->name}}"></a>
                                </td>
                                <td class="py-4 px-4" data-label="Product">
                                    <h6 class="font-bold text-gray-800"><a href={{route('shop.product.details',$product->slug)}} class="hover:text-primary">{{$item->name}}</a></h6>
                                    <div class="text-sm mt-1">
                                        <span class="text-primary font-bold">${{number_format($item->price,2)}}</span>
                                    </div>
                                </td>
                                <td class="py-4 px-4" data-label="Quantity">
                                <form action="{{ route('cart.update')}}" method="POST">
                                     @csrf
                                      @method('PUT')
                                      <input type="hidden" name="rowId" value="{{ $item->rowId }}">                                 
                                       <div class="flex border rounded w-max">
                                          <button type="submit" class="px-3 py-1 hover:bg-gray-100" onclick="updateCartQuantity(this, -1)">-</button>
                                           <input type="number" name="quantity" value="{{ $item->qty }}" class="w-12 text-center focus:outline-none" readonly>
                                          <button type="submit" class="px-3 py-1 hover:bg-gray-100" onclick="updateCartQuantity(this, 1)">+</button>
                                      </div>
                                 </form>
                                </td>
                                <td class="py-4 px-4 font-bold text-primary" data-label="Total">${{number_format($item->subtotal,2)}}</td>
                                <td class="py-4 px-4" data-label="Action">
                                    <form action="{{ route('cart.remove',$item->rowId)}}" method="POST" class="inline-block">
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
                        <form action="{{route('cart.clear')}}" method="POST" class="w-full" >
                            @csrf
                            @method('DELETE')
                        <button type="submit" class="border border-gray-800 text-gray-800 px-6 py-3 rounded hover:bg-sky-800 hover:text-white transition w-full sm:w-auto text-center">Clear Cart</button>
                        </form>
                    </div>
                </div>
    
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8"> 
                    <div class="bg-gray-50 p-6 rounded border">
                        <h4 class="font-bold text-lg mb-2">Calculate Shipping</h4>
                        <p class="text-sm text-gray-500 mb-4">Estimate your shipping fee *</p>
                        <form class="space-y-4">
                            <select class="w-full border p-3 rounded bg-white focus:outline-none focus:border-primary text-gray-500">
                                <option>Select a country...</option>
                                <option>Bangladesh</option>
                                <option>Canada</option>
                                <option>USA</option>
                                <option>UK</option>
                            </select>
                            <select class="w-full border p-3 rounded bg-white focus:outline-none focus:border-primary text-gray-500">
                                <option>Select a state/region...</option>
                                <option>Dhaka</option>
                                <option>New York</option>
                                <option>London</option>
                            </select>
                            <input type="text" placeholder="Postcode/Zip" class="w-full border p-3 rounded focus:outline-none focus:border-primary">
                            <button class="bg-sky-800 text-white px-6 py-3 rounded hover:bg-primary transition w-full">Update Totals</button>
                        </form>
                    </div>
    
                    <div class="bg-gray-50 p-6 rounded border">
                        <h4 class="font-bold text-lg mb-2">Coupon Code</h4>
                        <p class="text-sm text-gray-500 mb-4">Enter your coupon code if you have one.</p>
                        <form class="space-y-4">
                            <input type="text" placeholder="Enter coupon code..." class="w-full border p-3 rounded focus:outline-none focus:border-primary">
                            <button class="bg-sky-800 text-white px-6 py-3 rounded hover:bg-primary transition w-full">Apply Coupon</button>
                        </form>
                    </div>
    
                    <div class="bg-gray-50 p-6 rounded border">
                        <h4 class="font-bold text-lg mb-4">Cart Totals</h4>
                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between border-b pb-2">
                                <span class="font-medium">Subtotal</span>
                                <span class="font-bold">${{number_format(Cart::instance('cart')->subtotal(),2)}}</span>
                            </div>
                             <div class="flex justify-between border-b pb-2">
                                <span class="font-medium">Tax</span>
                                <span class="font-bold">${{number_format(Cart::instance('cart')->taxTotal(),2)}}</span>
                            </div>
                            <div class="flex justify-between items-start border-b pb-2">
                                <span class="font-medium pt-1">Shipping</span>
                                <div class="text-right text-sm space-y-1">
                                    <label class="flex items-center justify-end cursor-pointer">
                                        <input type="radio" name="shipping" checked class="mr-2"> Flat Rate
                                    </label>
                                    <label class="flex items-center justify-end cursor-pointer">
                                        <input type="radio" name="shipping" class="mr-2"> Free Shipping
                                    </label>
                                    <label class="flex items-center justify-end cursor-pointer">
                                        <input type="radio" name="shipping" class="mr-2"> Local Pickup
                                    </label>
                                </div>
                            </div>
                            <div class="flex justify-between pt-2">
                                <span class="font-bold text-lg">Total</span>
                                <span class="font-bold text-lg text-primary">{{number_format(Cart::instance('cart')->total(),2)}}</span>
                            </div>
                        </div>
                        <a href="checkout.php" class="block bg-sky-800 text-white text-center px-6 py-3 rounded hover:bg-primary transition w-full">Proceed To Checkout</a>
                    </div>
                </div>
    
            </div>
            @endif
        </div>
    </section>

    <!-- Main Content End -->

    <script>
        function updateCartQuantity(button, change) {
        const form = button.closest('form');
        const quantityInput = form.querySelector('input[name="quantity"]'); 
        let currentQty = parseInt(quantityInput.value);
        if (isNaN(currentQty)) currentQty = 0;   
       const newQty = Math.max(0,currentQty + change);
       quantityInput .value = newQty;
    }
    </script>

</x-app-layout>