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
                    primary: '#0369a1', // Adjust this to match your brand blue
                    secondary: '#075985',
                },
                container: {
                    center: true,
                    padding: '1rem',
                    screens: {
                        xl: '1200px',
                    },
                }
            }
        }
    }
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<link rel="stylesheet" href="{{ asset('assets/css/plugins/pe-icon-7-stroke.css') }}" />

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans text-gray-600 antialiased">

<header class="hidden lg:block bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto py-4">
            <div class="flex justify-between items-center">
                <div class="w-1/4">
                    <a href="index.php">
                        <img src="{{asset('assets/images/logo.png')}}" alt="Logo" class="max-w-[200px]" />
                    </a>
                </div>

                <div class="w-1/2 flex justify-center">
                    <nav>
                        <ul class="flex space-x-8 font-medium text-gray-700">
                            <li><a href="index.php" class="hover:text-primary transition">Home</a></li>
                            <li><a href="shop.php" class="hover:text-primary transition">Shop</a></li>
                            <li><a href="cart.php" class="hover:text-primary transition">Cart</a></li>
                            <li><a href="wishlist.php" class="hover:text-primary transition">Wishlist</a></li>
                            <li><a href="contact.php" class="hover:text-primary transition">Contact</a></li>
                        </ul>
                    </nav>
                </div>

                <div class="w-1/4 flex justify-end items-center space-x-6">
                <div class="relative group">
                    <button class="text-2xl hover:text-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
                    <div class="absolute right-0 mt-2 w-64 bg-white border shadow-lg p-3 rounded opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                        <form class="flex">
                            <input type="text" placeholder="Search..." class="w-full border p-2 text-sm outline-none focus:border-primary" />
                            <button class="p-2 text-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </div>
                </div>

                <a href="wishlist.php" class="text-2xl hover:text-primary"><i class="fa-regular fa-heart"></i></a>
                
                <a href="cart.php" class="text-2xl hover:text-primary relative">
                    <i class="fa-solid fa-bag-shopping"></i>
                    <span class="absolute -top-2 -right-2 bg-primary text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>
                </a>

                <div class="relative group">
                    <button class="text-2xl hover:text-primary">
                        @auth
                        <span class="flex items-center justify-center w-10 h-10 bg-blue-600 text-white rounded-full font-bold uppercase text-lg shadow-sm">
                            {{ strtoupper(substr(Auth::user()->name,0,1))) }}
                        </span>
                        @else
                        <span class="flex items-center justify-center w-10 h-10 bg-blue-600 text-white rounded-full font-bold uppercase text-lg shadow-sm">
                            <i class="fa-regular fa-user"></i>
                        </span>
                        @endauth

                    </button>
                    <ul class="absolute right-0 mt-2 w-40 bg-white border shadow-lg py-2 rounded opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">                            
                        @guest
                        <li><a href='{{ route('login') }} class="block px-4 py-2 hover:bg-gray-100 text-sm">Sign In</a></li>  
                        @else
                        <li><a href='My-Account.php' class="block px-4 py-2 hover:bg-gray-100 text-sm">My Account</a></li>
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block px-4 py-2 hover:bg-gray-100 text-sm">Sign Out</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="post" class="hidden">

                            </form>
                        </li>
                        @endguest                            
                    </ul>
                </div>
            </div>
            </div>
        </div>
    </header>

    <header class="lg:hidden bg-white shadow-sm sticky top-0 z-50">
    <div class="container mx-auto px-4 py-4">
        <div class="flex justify-between items-center mb-4">
            <button id="mobile-menu-btn" class="text-2xl focus:outline-none">
                <i class="fa-solid fa-bars"></i>
            </button>

            <a href="index.php">
                <img src="{{asset('assets/images/logo.png')}}" alt="Logo" class="max-w-[120px]" />
            </a>

            <div class="flex items-center space-x-5">
                <a href="wishlist.php" class="text-xl hover:text-primary">
                    <i class="fa-regular fa-heart"></i>
                </a>

                <a href="cart.php" class="text-xl hover:text-primary relative">
                    <i class="fa-solid fa-bag-shopping"></i>
                    <span class="absolute -top-2 -right-2 bg-primary text-white text-[10px] rounded-full w-4 h-4 flex items-center justify-center">3</span>
                </a>

                <div class="relative">
                    <button id="mobile-avatar-button" class="text-xl hover:text-primary focus:outline-none">
                        <i class="fa-regular fa-user"></i>
                    </button>
                    
                    <ul id="avatar-submenu-mobile" class="absolute right-0 mt-3 w-44 bg-white border border-gray-100 shadow-xl py-2 rounded-lg hidden z-[100]">
                        <li><a href="my-account.php" class="block px-4 py-2 hover:bg-gray-100 text-sm text-gray-700">My Account</a></li>
                        <li><a href="checkout.php" class="block px-4 py-2 hover:bg-gray-100 text-sm text-gray-700">Checkout</a></li>
                        <li class="border-t border-gray-50 mt-1">
                            <a href="login.php" class="block px-4 py-2 hover:bg-gray-100 text-sm font-bold text-primary">Sign In</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="pb-2">
            <form action="shop.php" method="GET" class="relative">
                <input type="text" name="q" placeholder="Search for products..." 
                       class="w-full bg-gray-100 border-none px-4 py-2.5 rounded-lg text-sm focus:ring-2 focus:ring-primary focus:bg-white transition-all outline-none">
                <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-primary">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
    </div>
</header>

    <div id="mobile-sidebar" class="fixed inset-y-0 left-0 w-64 bg-white shadow-2xl transform -translate-x-full transition-transform duration-300 z-[60]">
        <div class="p-4 flex justify-between items-center border-b">
            <span class="font-bold text-lg">Menu</span>
            <button id="close-menu-btn" class="text-xl"><i class="pe-7s-close"></i></button>
        </div>
        <nav class="p-4">
            <ul class="space-y-4">
                <li><a href="index.php" class="block hover:text-primary">Home</a></li>
                <li><a href="shop.php" class="block hover:text-primary">Shop</a></li>
                <li><a href="cart.php" class="block hover:text-primary">Cart</a></li>
                <li><a href="wishlist.php" class="block hover:text-primary">Wishlist</a></li>
                <li><a href="contact.php" class="block hover:text-primary">Contact</a></li>
            </ul>
        </nav>
    </div>
    <div id="menu-overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden z-[55]"></div>
    
    <!-- Main Content Start -->

         {{ $slot }}

    <!-- Main Content End -->

<footer class="bg-sky-800 text-gray-100 py-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div>
                    <img src="{{asset('assets/images/logo-w.png')}}" alt="Logo" class="mb-6 max-w-[200px]" />
                    <ul class="space-y-2 text-sm">
                        <li>ABC, Address Here, Country</li>
                        <li>Call Us: <a href="#" class="hover:text-primary transition">+000 000 0000</a></li>
                        <li>Email: <a href="#" class="hover:text-primary transition">info@surfsidemedia.in</a></li>
                    </ul>
                    <div class="flex space-x-4 mt-6">
                        <a href="#" class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center hover:bg-primary transition"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center hover:bg-primary transition"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center hover:bg-primary transition"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>

                <div>
                    <h4 class="text-white font-bold text-lg mb-6">Our Categories</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-primary transition">Category 1</a></li>
                        <li><a href="#" class="hover:text-primary transition">Category 2</a></li>
                        <li><a href="#" class="hover:text-primary transition">Furniture</a></li>
                        <li><a href="#" class="hover:text-primary transition">Lighting</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-bold text-lg mb-6">Information</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="about.php" class="hover:text-primary transition">About Us</a></li>
                        <li><a href="#" class="hover:text-primary transition">How to Shop</a></li>
                        <li><a href="#" class="hover:text-primary transition">FAQ</a></li>
                        <li><a href="contact.php" class="hover:text-primary transition">Contact Us</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-bold text-lg mb-6">My Account</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="login.php" class="hover:text-primary transition">Sign In</a></li>
                        <li><a href="cart.php" class="hover:text-primary transition">View Cart</a></li>
                        <li><a href="wishlist.php" class="hover:text-primary transition">My Wishlist</a></li>
                        <li><a href="#" class="hover:text-primary transition">Track My Order</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-400 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-sm">&copy; 2026 Surfside Media All rights reserved.</p>
                <img src="{{asset('assets/images/payment.png')}}" alt="Payment" class="mt-4 md:mt-0" />
            </div>
        </div>
    </footer>

    <button id="back-to-top" class="fixed bottom-8 right-8 bg-primary text-white w-10 h-10 rounded shadow-lg hover:bg-blue-600 transition hidden items-center justify-center z-50">
        <i class="fa-solid fa-chevron-up text-xl"></i>
    </button>

<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    
    // --- Helper: Select Element ---
    const $ = (id) => document.getElementById(id);
    const $$ = (selector) => document.querySelectorAll(selector);

    // --- 1. UI Toggles (Mobile Menu & Avatar) ---
    const toggleUI = (btnId, menuId, overlayId = null) => {
        const btn = $(btnId);
        const menu = $(menuId);
        const overlay = overlayId ? $(overlayId) : null;

        if (!btn || !menu) return;

        const toggle = () => {
            menu.classList.toggle('-translate-x-full');
            menu.classList.toggle('hidden'); // For avatar type menus
            if (overlay) overlay.classList.toggle('hidden');
        };

        btn.addEventListener('click', (e) => {
            e.stopPropagation();
            toggle();
        });

        // Specific for mobile sidebar close button
        if ($(btnId === 'mobile-menu-btn' ? 'close-menu-btn' : null)) {
            $('close-menu-btn').addEventListener('click', toggle);
        }

        // Close when clicking outside
        document.addEventListener('click', (e) => {
            if (!menu.contains(e.target) && !btn.contains(e.target)) {
                menu.classList.add('-translate-x-full');
                menu.classList.add('hidden');
                if (overlay) overlay.classList.add('hidden');
            }
        });
    };

    toggleUI('mobile-menu-btn', 'mobile-sidebar', 'menu-overlay');
    toggleUI('mobile-avatar-button', 'avatar-submenu-mobile');

    // --- 2. Back to Top Button ---
    const backToTopBtn = $('back-to-top');
    if (backToTopBtn) {
        window.addEventListener('scroll', () => {
            const isVisible = window.scrollY > 300;
            backToTopBtn.classList.toggle('hidden', !isVisible);
            backToTopBtn.classList.toggle('flex', isVisible);
        });

        backToTopBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // --- 3. Swiper Initializations (Unified Logic) ---
    const initSwiper = (selector, options) => {
        if (document.querySelector(selector)) return new Swiper(selector, options);
    };

    // Hero
    initSwiper('.main-slider', {
        loop: true,
        pagination: { el: '.swiper-pagination', clickable: true },
        autoplay: { delay: 5000 },
    });

    // Product/Category Sliders (Common Breakpoints)
    const productBreakpoints = {
        640: { slidesPerView: 2 },
        768: { slidesPerView: 3 },
        1024: { slidesPerView: 4 }
    };

    initSwiper('.category-slider', { 
        slidesPerView: 2, spaceBetween: 20, loop: true, 
        breakpoints: { ...productBreakpoints, 1024: { slidesPerView: 6 } } 
    });

    initSwiper('.brand-slider', { 
        slidesPerView: 2, spaceBetween: 20, loop: true, 
        breakpoints: { ...productBreakpoints, 1024: { slidesPerView: 5 } } 
    });

    initSwiper('.featured-slider', { 
        slidesPerView: 1, spaceBetween: 20, 
        navigation: { nextEl: '.feat-next', prevEl: '.feat-prev' },
        breakpoints: productBreakpoints 
    });

    initSwiper('.related-slider', { 
        slidesPerView: 1, spaceBetween: 20, 
        navigation: { nextEl: '.related-next', prevEl: '.related-prev' },
        breakpoints: productBreakpoints 
    });

    // Gallery Thumbs logic
    const galleryThumbs = initSwiper('.gallery-thumbs', {
        spaceBetween: 10, slidesPerView: 4, freeMode: true, watchSlidesProgress: true,
    });

    initSwiper('.gallery-top', {
        spaceBetween: 10,
        navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
        thumbs: { swiper: galleryThumbs }
    });

    // --- 4. Tabs Logic ---
    $$('.tab-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            $$('.tab-btn').forEach(b => b.classList.remove('active'));
            $$('.tab-content').forEach(c => c.classList.add('hidden'));
            
            btn.classList.add('active');
            const target = $(btn.getAttribute('data-target'));
            if (target) target.classList.remove('hidden');
        });
    });

    // --- 5. Countdown Timer ---
    const countdownContainer = $('countdown-timer');
    if (countdownContainer) {
        const targetDate = new Date("2025-12-31T00:00:00").getTime();
        const updateTimer = () => {
            const distance = targetDate - new Date().getTime();
            if (distance < 0) {
                countdownContainer.innerHTML = "EXPIRED";
                return clearInterval(timerInterval);
            }
            const timeMap = {
                days: Math.floor(distance / 864e5),
                hours: Math.floor((distance % 864e5) / 36e5),
                minutes: Math.floor((distance % 36e5) / 6e4),
                seconds: Math.floor((distance % 6e4) / 1000)
            };
            Object.keys(timeMap).forEach(unit => {
                const el = $(unit);
                if (el) el.innerText = String(timeMap[unit]).padStart(2, '0');
            });
        };
        const timerInterval = setInterval(updateTimer, 1000);
        updateTimer();
    }
});

// --- 6. Global Functions ---
function updateQty(amount) {
    const input = document.getElementById('qty-input');
    if (!input) return;
    let val = parseInt(input.value) + amount;
    input.value = val < 1 ? 1 : val;
}
</script>
 
</body>

    {{-- <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body> --}}
</html>
