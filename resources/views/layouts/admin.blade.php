<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

  
<link href="{{ asset('favicon.ico') }}" rel="shortcut icon" type="image/x-icon" />

 <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3b82f6', // Brand Blue
                        secondary: '#1f2937', // Dark Gray
                        sidebar: '#111827', // Darker Gray for Sidebar
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="bg-gray-100 font-sans antialiased">

    <div class="flex h-screen overflow-hidden">
        
<aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-sky-800 text-gray-100 transition-transform transform -translate-x-full md:translate-x-0 md:static md:inset-0 flex flex-col">
    <div class="flex items-center justify-center h-16 bg-sky-700 border-b border-gray-800">
        <a href="{{ route('home.index') }}"><img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="h-12" /></a>
    </div>

    <div class="flex-1 overflow-y-auto py-4">
        <nav class="px-4 space-y-2">
            <a href="{{ route('home.index') }}" class="nav-link flex items-center gap-3 px-4 py-2.5 text-gray-100 hover:text-white hover:bg-gray-800 rounded-lg transition">
                <i class="fa-solid fa-gauge-high w-5 text-center"></i>
                <span>Dashboard</span>
            </a>
            
            <p class="px-4 text-xs font-semibold text-gray-300 uppercase mt-4 mb-2">Management</p>
            
            <a href="products.php" class="nav-link flex items-center gap-3 px-4 py-2.5 text-gray-100 hover:text-white hover:bg-gray-800 rounded-lg transition">
                <i class="fa-solid fa-box w-5 text-center"></i>
                <span>Products</span>
            </a>

            <a href="categories.php" class="nav-link flex items-center gap-3 px-4 py-2.5 text-gray-100 hover:text-white hover:bg-gray-800 rounded-lg transition">
                <i class="fa-solid fa-layer-group w-5 text-center"></i>
                <span class="font-medium">Categories</span>
            </a>

            <a href="{{ route('admin.brands') }}" class="nav-link flex items-center gap-3 px-4 py-2.5 text-gray-100 hover:text-white hover:bg-gray-800 rounded-lg transition">
                <i class="fa-solid fa-tag w-5 text-center"></i>
                <span>Brands</span>
            </a>

            <a href="orders.php" class="nav-link flex items-center gap-3 px-4 py-2.5 text-gray-100 hover:text-white hover:bg-gray-800 rounded-lg transition">
                <i class="fa-solid fa-cart-shopping w-5 text-center"></i>
                <span>Orders</span>
            </a>
            <a href="customers.php" class="nav-link flex items-center gap-3 px-4 py-2.5 text-gray-100 hover:text-white hover:bg-gray-800 rounded-lg transition">
                <i class="fa-solid fa-users w-5 text-center"></i>
                <span>Customers</span>
            </a>
            <a href="reviews.php" class="nav-link flex items-center gap-3 px-4 py-2.5 text-gray-100 hover:text-white hover:bg-gray-800 rounded-lg transition">
                <i class="fa-regular fa-star w-5 text-center"></i>
                <span>Reviews</span>
            </a>

            <p class="px-4 text-xs font-semibold text-gray-300 uppercase mt-4 mb-2">Settings</p>

            <a href="settings.php" class="nav-link flex items-center gap-3 px-4 py-2.5 text-gray-100 hover:text-white hover:bg-gray-800 rounded-lg transition">
                <i class="fa-solid fa-gear w-5 text-center"></i>
                <span>General Settings</span>
            </a>
        </nav>
    </div>

    <div class="p-4 border-t border-gray-800">
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link flex items-center gap-3 w-full px-4 py-2 text-gray-100 hover:text-white hover:bg-gray-800 rounded-lg transition">
            <i class="fa-solid fa-right-from-bracket w-5 text-center"></i>
            <span>Logout</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    </div>
</aside>

<div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden md:hidden"></div>
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            
<header class="bg-white shadow-sm h-16 flex items-center justify-between px-6 z-30">
                <button id="mobile-menu-btn" class="text-gray-500 focus:outline-none md:hidden">
                    <i class="fa-solid fa-bars text-2xl"></i>
                </button>

                <div class="hidden md:flex items-center bg-gray-100 rounded-lg px-3 py-2 w-96">
                    <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                    <input type="text" placeholder="Search categories..." class="bg-transparent border-none outline-none ml-2 text-sm w-full text-gray-600">
                </div>

                <div class="flex items-center gap-6">
                    <button class="relative text-gray-500 hover:text-primary transition">
                        <i class="fa-regular fa-bell text-xl"></i>
                    </button>
                    <div class="flex items-center gap-3">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-bold text-gray-700">{{Auth::user()->name}}</p>
                            <p class="text-xs text-gray-500">Super Admin</p>
                        </div>
                        <img src="https://i.pravatar.cc/150?img=12" alt="Admin" class="w-10 h-10 rounded-full border border-gray-200">
                    </div>
                </div>
            </header>
            <!-- Main Content Start -->

            {{ $slot }}

            <!-- Main Content End -->

        </div>
    </div>

<script>
    // Sidebar Toggle
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');

    function toggleSidebar() {
        const isClosed = sidebar.classList.contains('-translate-x-full');
        if (isClosed) {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
        } else {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        }
    }

    mobileMenuBtn.addEventListener('click', toggleSidebar);
    overlay.addEventListener('click', toggleSidebar);

    document.addEventListener("DOMContentLoaded", function() {
        // 1. Get the current URL filename
        const currentLocation = window.location.pathname.split("/").pop();

        // 2. Select all navigation links
        const menuLinks = document.querySelectorAll(".nav-link");

        menuLinks.forEach(link => {
            // 3. Check if link's href matches the current location
            const linkHref = link.getAttribute("href");

            if (linkHref === currentLocation) {
                // 4. Apply Active Tailwind Classes
                link.classList.add("bg-primary", "text-white", "shadow-md");
                link.classList.remove("hover:bg-sky-700");

                // 5. Optionally bold the text
                const span = link.querySelector("span");
                if (span) span.classList.add("font-medium");
            }
        });
    });
</script>

</body>

  
</html>
