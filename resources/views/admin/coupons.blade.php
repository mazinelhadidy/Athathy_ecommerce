<x-admin-layout>

       <main class="flex-1 overflow-y-auto p-6 bg-gray-100">

                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Coupons</h1>
                        <p class="text-sm text-gray-500">Manage discount codes and promotional offers</p>
                    </div>
                    <a href="{{ route('admin.coupon.add') }}" class="bg-primary hover:bg-blue-600 text-white px-5 py-2.5 rounded-lg text-sm font-medium transition flex items-center gap-2 shadow-sm">
                        <i class="fa-solid fa-plus"></i> Add New Coupon
                    </a>
                </div>

                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 mb-6">
                    <div class="flex flex-col md:flex-row gap-4 justify-between">
                        <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto">
                            <div class="relative w-full md:w-64">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                    <i class="fa-solid fa-search text-gray-400"></i>
                                </span>
                                <input type="text" class="w-full pl-10 pr-4 py-2 border rounded-lg text-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary" placeholder="Search coupon code...">
                            </div>

                            <select class="w-full md:w-40 border px-3 py-2 rounded-lg text-sm focus:outline-none focus:border-primary bg-white text-gray-600">
                                <option value="">All Types</option>
                                <option value="fixed">Fixed</option>
                                <option value="percent">Percent</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="overflow-x-auto">

                          @if(Session::has('success'))
                    <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded relative" role="alert">
                        {{ Session::get('success') }}
                    </div>
                    @endif
                    
                        <table class="w-full text-left whitespace-nowrap">
                            <thead class="bg-gray-50 text-gray-500 text-xs uppercase font-semibold">
                                <tr>
                                    <th class="px-6 py-4">ID</th>
                                    <th class="px-6 py-4">Code</th>
                                    <th class="px-6 py-4">Type</th>
                                    <th class="px-6 py-4">Value</th>
                                    <th class="px-6 py-4">Min. Cart Value</th>
                                    <th class="px-6 py-4">Expiry Date</th>
                                    <th class="px-6 py-4 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($coupons as $coupon)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 text-sm text-gray-500">#{{ $coupon->id }}</td>
                                    <td class="px-6 py-4">
                                        <span class="font-bold text-gray-800 tracking-wider">{{ $coupon->code }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($coupon->type == 'fixed')
                                        <span class="bg-green-50 text-green-700 px-2 py-1 rounded text-xs font-semibold uppercase">Fixed</span>
                                        @else
                                        <span class="bg-purple-50 text-purple-700 px-2 py-1 rounded text-xs font-semibold uppercase">Percent</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-800">
                                        @if($coupon->type == 'fixed')
                                        ${{ number_format($coupon->value, 2) }}
                                        @else
                                        {{ number_format($coupon->value, 2) }}%
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">${{ number_format($coupon->cart_value,2) }}</td>
                                    <td class="px-6 py-4">
                                        <span class="text-sm text-gray-600"><i class="fa-regular fa-calendar mr-1"></i> {{\Carbon\Carbon::parse($coupon->expiry_date)->format('d-m-y')}}</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="coupon-edit.php?id=1" class="w-8 h-8 rounded-full hover:bg-gray-100 text-blue-500 transition flex items-center justify-center" title="Edit">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <button class="w-8 h-8 rounded-full hover:bg-gray-100 text-red-500 transition flex items-center justify-center" onclick="deleteCoupon(this, 'SUMMER20', 1)" title="Delete">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center text-gray-500">
                                            <i class="fa-solid fa-ticket text-4xl mb-3 text-gray-300"></i>
                                            <h3 class="text-lg font-medium text-gray-900">No coupons available</h3>
                                            <p class="text-sm mt-1">You haven't created any discount codes yet.</p>
                                            <a href="{{ route('admin.coupon.add') }}" class="mt-4 text-primary hover:underline text-sm font-medium">
                                                Create your first coupon
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="px-6 py-4 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                        {{ $coupons->links() }}
                    </div>
                </div>

            </main>

</x-admin-layout>