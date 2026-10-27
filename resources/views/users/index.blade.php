<x-app-layout>

   <!-- Main Content Start -->

    <div class="relative bg-sky-700 text-white h-64 flex items-center justify-center bg-cover bg-center" style="background-image: url('{{asset('assets/images/page-banner.jpg')}}');">
        <div class="absolute inset-0 bg-black bg-opacity-40"></div>
        <div class="relative z-10 text-center">
            <h2 class="text-4xl font-bold mb-2">My Account</h2>
            <ul class="flex justify-center space-x-2 text-sm">
                <li><a href="{{ route('home.index') }}" class="hover:text-primary">Home</a></li>
                <li>/</li>
                <li class="text-primary">My Account</li>
            </ul>
        </div>
    </div>

    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-8">
                
              @include('users.sidebar')

                <div class="w-full lg:w-3/4">
                    
                    <div id="dashboard" class="account-tab-content">
                        <div class="bg-white border rounded p-6">
                            <h4 class="text-xl font-bold mb-4">Dashboard</h4>
                            <div class="bg-blue-50 border-l-4 border-primary p-4 mb-6">
                                <p>Hello, <strong>{{ Auth::user()->name }}</strong> (If Not <strong>{{ Auth::user()->name }}  !</strong> <a href="{{ route('login') }}" class="text-primary hover:underline">Logout</a>)</p>
                            </div>
                            <p class="text-gray-600 leading-relaxed">
                                From your account dashboard, you can easily check & view your recent orders, manage your shipping and billing addresses, and edit your password and account details.
                            </p>
                        </div>
                    </div>

                    <div id="orders" class="account-tab-content hidden">
                        <div class="bg-white border rounded p-6">
                            <h4 class="text-xl font-bold mb-6">Orders</h4>
                            <div class="overflow-x-auto">
                                <table class="w-full text-left border-collapse">
                                    <thead>
                                        <tr class="bg-gray-100 border-b">
                                            <th class="p-4 font-bold">No</th>
                                            <th class="p-4 font-bold">Name</th>
                                            <th class="p-4 font-bold">Date</th>
                                            <th class="p-4 font-bold">Status</th>
                                            <th class="p-4 font-bold">Total</th>
                                            <th class="p-4 font-bold">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y">
                                        <tr>
                                            <td class="p-4">1</td>
                                            <td class="p-4">Mostarizing Oil</td>
                                            <td class="p-4">Aug 22, 2020</td>
                                            <td class="p-4"><span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs">Pending</span></td>
                                            <td class="p-4">$100</td>
                                            <td class="p-4"><a href="#" class="bg-primary text-white px-4 py-1 rounded hover:bg-blue-600 text-sm">View</a></td>
                                        </tr>
                                        <tr>
                                            <td class="p-4">2</td>
                                            <td class="p-4">Katopeno Altuni</td>
                                            <td class="p-4">July 22, 2020</td>
                                            <td class="p-4"><span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">Approved</span></td>
                                            <td class="p-4">$45</td>
                                            <td class="p-4"><a href="#" class="bg-primary text-white px-4 py-1 rounded hover:bg-blue-600 text-sm">View</a></td>
                                        </tr>
                                        <tr>
                                            <td class="p-4">3</td>
                                            <td class="p-4">Murikhete Paris</td>
                                            <td class="p-4">June 22, 2020</td>
                                            <td class="p-4"><span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs">On Hold</span></td>
                                            <td class="p-4">$99</td>
                                            <td class="p-4"><a href="#" class="bg-primary text-white px-4 py-1 rounded hover:bg-blue-600 text-sm">View</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="downloads" class="account-tab-content hidden">
                        <div class="bg-white border rounded p-6">
                            <h4 class="text-xl font-bold mb-6">Download</h4>
                            <div class="overflow-x-auto">
                                <table class="w-full text-left border-collapse">
                                    <thead>
                                        <tr class="bg-gray-100 border-b">
                                            <th class="p-4 font-bold">Product</th>
                                            <th class="p-4 font-bold">Date</th>
                                            <th class="p-4 font-bold">Expire</th>
                                            <th class="p-4 font-bold">Download</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y">
                                        <tr>
                                            <td class="p-4">Mostarizing Oil</td>
                                            <td class="p-4">Aug 22, 2020</td>
                                            <td class="p-4">Yes</td>
                                            <td class="p-4"><a href="#" class="text-primary hover:underline">Download File</a></td>
                                        </tr>
                                        <tr>
                                            <td class="p-4">Katopeno Altuni</td>
                                            <td class="p-4">July 22, 2020</td>
                                            <td class="p-4">Never</td>
                                            <td class="p-4"><a href="#" class="text-primary hover:underline">Download File</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="payment" class="account-tab-content hidden">
                        <div class="bg-white border rounded p-6">
                            <h4 class="text-xl font-bold mb-4">Payment Method</h4>
                            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                                <p class="text-yellow-700">You Can't Save Your Payment Method yet.</p>
                            </div>
                        </div>
                    </div>

                    <div id="address" class="account-tab-content hidden">
                        <div class="bg-white border rounded p-6">
                            <h4 class="text-xl font-bold mb-6">Address</h4>
                            <div class="grid md:grid-cols-2 gap-8">
                                <div class="border p-4 rounded bg-gray-50">
                                    <h5 class="font-bold text-lg mb-2">Billing Address</h5>
                                    <address class="not-italic text-sm text-gray-600 mb-4">
                                        <strong class="block text-gray-800 text-base mb-1">Alex Tuntuni</strong>
                                        1355 Market St, Suite 900<br>
                                        San Francisco, CA 94103<br>
                                        Mobile: (123) 456-7890
                                    </address>
                                    <a href="#" class="inline-block bg-primary text-white px-4 py-2 rounded hover:bg-blue-600 text-sm"><i class="fa fa-edit"></i> Edit Address</a>
                                </div>
                                <div class="border p-4 rounded bg-gray-50">
                                    <h5 class="font-bold text-lg mb-2">Shipping Address</h5>
                                    <address class="not-italic text-sm text-gray-600 mb-4">
                                        <strong class="block text-gray-800 text-base mb-1">Alex Tuntuni</strong>
                                        1355 Market St, Suite 900<br>
                                        San Francisco, CA 94103<br>
                                        Mobile: (123) 456-7890
                                    </address>
                                    <a href="#" class="inline-block bg-primary text-white px-4 py-2 rounded hover:bg-blue-600 text-sm"><i class="fa fa-edit"></i> Edit Address</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="details" class="account-tab-content hidden">
                        <div class="bg-white border rounded p-6">
                            <h4 class="text-xl font-bold mb-6">Account Details</h4>
                            <form action="#" class="space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block mb-1 text-sm">First Name</label>
                                        <input type="text" class="w-full border p-3 rounded focus:outline-none focus:border-primary">
                                    </div>
                                    <div>
                                        <label class="block mb-1 text-sm">Last Name</label>
                                        <input type="text" class="w-full border p-3 rounded focus:outline-none focus:border-primary">
                                    </div>
                                </div>
                                <div>
                                    <label class="block mb-1 text-sm">Display Name</label>
                                    <input type="text" class="w-full border p-3 rounded focus:outline-none focus:border-primary">
                                </div>
                                <div>
                                    <label class="block mb-1 text-sm">Email Address</label>
                                    <input type="email" class="w-full border p-3 rounded focus:outline-none focus:border-primary">
                                </div>
                                
                                <div class="pt-4">
                                    <h5 class="text-lg font-bold mb-3">Password Change</h5>
                                    <div class="space-y-4">
                                        <input type="password" placeholder="Current Password" class="w-full border p-3 rounded focus:outline-none focus:border-primary">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <input type="password" placeholder="New Password" class="w-full border p-3 rounded focus:outline-none focus:border-primary">
                                            <input type="password" placeholder="Confirm Password" class="w-full border p-3 rounded focus:outline-none focus:border-primary">
                                        </div>
                                    </div>
                                </div>

                                <button class="bg-primary text-white px-6 py-3 rounded hover:bg-blue-600 transition shadow">Save Changes</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Main Content End -->
</x-app-layout>