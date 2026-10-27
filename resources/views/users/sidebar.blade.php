  <div class="w-full lg:w-1/4">
                    <div class="bg-gray-50 border rounded overflow-hidden">
                        <ul class="flex flex-col divide-y">
                            <li>
                                <button class="account-tab-btn active w-full text-left px-6 py-4 transition flex items-center gap-3" data-target="dashboard">
                                    <i class="fa fa-tachometer w-5 text-center"></i> Dashboard
                                </button>
                            </li>
                            <li>
                                <button class="account-tab-btn w-full text-left px-6 py-4 transition flex items-center gap-3" data-target="orders">
                                    <i class="fa fa-shopping-cart w-5 text-center"></i> Orders
                                </button>
                            </li>
                            <li>
                                <button class="account-tab-btn w-full text-left px-6 py-4 transition flex items-center gap-3" data-target="downloads">
                                    <i class="fa fa-cloud-download w-5 text-center"></i> Downloads
                                </button>
                            </li>
                            <li>
                                <button class="account-tab-btn w-full text-left px-6 py-4 transition flex items-center gap-3" data-target="payment">
                                    <i class="fa fa-credit-card w-5 text-center"></i> Payment Method
                                </button>
                            </li>
                            <li>
                                <button class="account-tab-btn w-full text-left px-6 py-4 transition flex items-center gap-3" data-target="address">
                                    <i class="fa fa-map-marker w-5 text-center"></i> Address
                                </button>
                            </li>
                            <li>
                                <button class="account-tab-btn w-full text-left px-6 py-4 transition flex items-center gap-3" data-target="details">
                                    <i class="fa fa-user w-5 text-center"></i> Account Details
                                </button>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit()" class="w-full text-left px-6 py-4 transition flex items-center gap-3 hover:bg-gray-100 hover:text-red-500">
                                    <i class="fa fa-sign-out w-5 text-center"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>