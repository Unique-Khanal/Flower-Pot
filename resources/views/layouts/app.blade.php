<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FlowerPot') | FlowerPot</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
        .brand-font { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-stone-50" style="font-family:'Inter',sans-serif;">

    {{-- ============================================================
         NAVBAR — white, sticky, with new logo
    ============================================================ --}}
    <nav class="bg-white/95 backdrop-blur-sm border-b border-stone-200 shadow-sm sticky top-0 z-50"
         x-data="{ mobileOpen: false }">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between py-3">

                {{-- ---- Logo ---- --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3 group flex-shrink-0">
                    {{-- Square icon badge --}}
                    <svg width="46" height="46" viewBox="0 0 48 48" fill="none"
                         xmlns="http://www.w3.org/2000/svg"
                         class="flex-shrink-0 group-hover:scale-105 transition-transform duration-300">
                        <rect width="48" height="48" rx="13" fill="#15803d"/>
                        {{-- Pot body --}}
                        <path d="M14 30L16.5 42H31.5L34 30Z" fill="#f59e0b"/>
                        <path d="M30 30L32 42H31.5L29.5 30Z" fill="#fbbf24" opacity="0.4"/>
                        {{-- Pot rim --}}
                        <rect x="12" y="27" width="24" height="5" rx="2.5" fill="#d97706"/>
                        {{-- Soil --}}
                        <ellipse cx="24" cy="29.5" rx="9" ry="1.8" fill="#92400e"/>
                        {{-- Stem --}}
                        <rect x="22.2" y="17" width="3.6" height="13" rx="1.8" fill="#86efac"/>
                        {{-- Leaves --}}
                        <path d="M23 22 C19 17 11 18 12 24 C16 22 20 21 23 22Z" fill="#4ade80"/>
                        <path d="M25 22 C29 17 37 18 36 24 C32 22 28 21 25 22Z" fill="#86efac"/>
                        {{-- Petals --}}
                        <circle cx="24" cy="10"   r="3.2" fill="#fde68a"/>
                        <circle cx="29.8" cy="12.6" r="3.2" fill="#fde68a"/>
                        <circle cx="18.2" cy="12.6" r="3.2" fill="#fde68a"/>
                        <circle cx="27.8" cy="18.2" r="3.2" fill="#fde68a"/>
                        <circle cx="20.2" cy="18.2" r="3.2" fill="#fde68a"/>
                        {{-- Flower centre --}}
                        <circle cx="24" cy="14.5" r="5"   fill="#f59e0b"/>
                        <circle cx="24" cy="14.5" r="2.8" fill="#fbbf24"/>
                        <circle cx="24" cy="14.5" r="1.2" fill="#f59e0b"/>
                    </svg>
                    <div class="leading-none">
                        <span class="brand-font text-green-800 text-xl font-bold tracking-tight block">
                            Flower<span class="text-amber-500">Pot</span>
                        </span>
                        <span class="text-stone-400 text-xs font-medium tracking-wider">Plants &amp; Pots</span>
                    </div>
                </a>

                {{-- ---- Desktop links ---- --}}
                <div class="hidden md:flex items-center space-x-1">
                    <a href="{{ route('home') }}"
                       class="text-stone-600 hover:text-green-700 hover:bg-green-50 px-3 py-2 rounded-lg text-sm font-medium transition">
                        Home
                    </a>
                    <a href="{{ route('about') }}"
                       class="text-stone-600 hover:text-green-700 hover:bg-green-50 px-3 py-2 rounded-lg text-sm font-medium transition">
                        About
                    </a>
                    <a href="{{ route('services') }}"
                       class="text-stone-600 hover:text-green-700 hover:bg-green-50 px-3 py-2 rounded-lg text-sm font-medium transition">
                        Services
                    </a>

                    {{-- Products dropdown --}}
                    <div class="relative" x-data="{ open: false }"
                         @mouseenter="open = true" @mouseleave="open = false">
                        <button class="text-stone-600 hover:text-green-700 hover:bg-green-50 px-3 py-2 rounded-lg text-sm font-medium transition flex items-center gap-1">
                            Products
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="open" x-cloak
                             class="absolute left-0 mt-1 w-48 bg-white rounded-xl shadow-xl z-50 py-2 border border-stone-100">
                            {{-- Pots sub --}}
                            <div class="relative" x-data="{ pOpen: false }"
                                 @mouseenter="pOpen = true" @mouseleave="pOpen = false">
                                <a href="{{ route('products.pots') }}"
                                   class="flex items-center justify-between px-4 py-2.5 text-sm text-stone-700 hover:bg-green-50 hover:text-green-700 font-medium">
                                    Pots
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                                <div x-show="pOpen" x-cloak
                                     class="absolute left-full top-0 w-40 bg-white rounded-xl shadow-xl z-50 py-2 border border-stone-100">
                                    <a href="{{ route('products.ceramics') }}"
                                       class="block px-4 py-2 text-sm text-stone-700 hover:bg-green-50 hover:text-green-700">Ceramics</a>
                                    <a href="{{ route('products.cement') }}"
                                       class="block px-4 py-2 text-sm text-stone-700 hover:bg-green-50 hover:text-green-700">Cement</a>
                                    <a href="{{ route('products.mud') }}"
                                       class="block px-4 py-2 text-sm text-stone-700 hover:bg-green-50 hover:text-green-700">Mud</a>
                                    <a href="{{ route('products.plastic') }}"
                                       class="block px-4 py-2 text-sm text-stone-700 hover:bg-green-50 hover:text-green-700">Plastic</a>
                                </div>
                            </div>
                            <a href="{{ route('products.plants') }}"
                               class="block px-4 py-2.5 text-sm text-stone-700 hover:bg-green-50 hover:text-green-700 font-medium">
                                Plants
                            </a>
                        </div>
                    </div>

                    <a href="{{ route('contact') }}"
                       class="text-stone-600 hover:text-green-700 hover:bg-green-50 px-3 py-2 rounded-lg text-sm font-medium transition">
                        Contact
                    </a>
                </div>

                {{-- ---- Desktop right: cart + login ---- --}}
                <div class="hidden md:flex items-center gap-3">
                    <button x-data @click="$dispatch('open-cart')"
                            class="relative text-stone-500 hover:text-green-700 transition p-2 rounded-lg hover:bg-green-50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.5 6h13M7 13L5.4 5M10 21a1 1 0 100-2 1 1 0 000 2zm7 0a1 1 0 100-2 1 1 0 000 2z"/>
                        </svg>
                        <span x-data x-text="$store.cart.count"
                              class="absolute -top-0.5 -right-0.5 bg-green-600 text-white text-[10px] rounded-full h-4 w-4 flex items-center justify-center font-bold">
                            0
                        </span>
                    </button>
                    <a href="{{ route('login') }}"
                       class="bg-green-700 hover:bg-green-800 text-white px-5 py-2 rounded-lg text-sm font-semibold transition shadow-sm">
                        Login
                    </a>
                </div>

                {{-- ---- Mobile: cart + hamburger ---- --}}
                <div class="md:hidden flex items-center gap-2">
                    <button x-data @click="$dispatch('open-cart')" class="relative text-stone-500 p-1.5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.5 6h13M7 13L5.4 5M10 21a1 1 0 100-2 1 1 0 000 2zm7 0a1 1 0 100-2 1 1 0 000 2z"/>
                        </svg>
                        <span x-data x-text="$store.cart.count"
                              class="absolute -top-0.5 -right-0.5 bg-green-600 text-white text-[10px] rounded-full h-4 w-4 flex items-center justify-center font-bold">
                            0
                        </span>
                    </button>
                    <button @click="mobileOpen = !mobileOpen" class="text-stone-600 hover:text-green-700 p-2 rounded-lg">
                        <svg x-show="!mobileOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <svg x-show="mobileOpen" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- ---- Mobile menu ---- --}}
        <div x-show="mobileOpen" x-cloak
             class="md:hidden bg-white border-t border-stone-100 px-4 pb-5 pt-2 space-y-1">
            <a href="{{ route('home') }}"
               class="block text-stone-700 hover:text-green-700 hover:bg-green-50 px-3 py-2.5 rounded-lg text-sm font-medium">
                Home
            </a>
            <a href="{{ route('about') }}"
               class="block text-stone-700 hover:text-green-700 hover:bg-green-50 px-3 py-2.5 rounded-lg text-sm font-medium">
                About
            </a>
            <a href="{{ route('services') }}"
               class="block text-stone-700 hover:text-green-700 hover:bg-green-50 px-3 py-2.5 rounded-lg text-sm font-medium">
                Services
            </a>

            <div x-data="{ open: false }">
                <button @click="open = !open"
                        class="w-full text-left text-stone-700 hover:text-green-700 hover:bg-green-50 px-3 py-2.5 rounded-lg text-sm font-medium flex justify-between items-center">
                    Products
                    <svg class="w-3.5 h-3.5 transition-transform" :class="open ? 'rotate-180' : ''"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open" x-cloak class="pl-3 mt-1 space-y-0.5 border-l-2 border-green-100 ml-3">
                    <a href="{{ route('products.pots') }}"
                       class="block text-stone-600 hover:text-green-700 px-3 py-2 text-sm font-medium">
                        All Pots
                    </a>
                    <a href="{{ route('products.ceramics') }}"
                       class="block text-stone-500 hover:text-green-700 px-3 py-1.5 text-sm">
                        — Ceramics
                    </a>
                    <a href="{{ route('products.cement') }}"
                       class="block text-stone-500 hover:text-green-700 px-3 py-1.5 text-sm">
                        — Cement
                    </a>
                    <a href="{{ route('products.mud') }}"
                       class="block text-stone-500 hover:text-green-700 px-3 py-1.5 text-sm">
                        — Mud
                    </a>
                    <a href="{{ route('products.plastic') }}"
                       class="block text-stone-500 hover:text-green-700 px-3 py-1.5 text-sm">
                        — Plastic
                    </a>
                    <a href="{{ route('products.plants') }}"
                       class="block text-stone-600 hover:text-green-700 px-3 py-2 text-sm font-medium">
                        Plants
                    </a>
                </div>
            </div>

            <a href="{{ route('contact') }}"
               class="block text-stone-700 hover:text-green-700 hover:bg-green-50 px-3 py-2.5 rounded-lg text-sm font-medium">
                Contact
            </a>
            <div class="pt-2">
                <a href="{{ route('login') }}"
                   class="block bg-green-700 hover:bg-green-800 text-white px-4 py-2.5 rounded-lg text-sm font-semibold text-center transition">
                    Login
                </a>
            </div>
        </div>
    </nav>

    {{-- ============================================================
         MAIN CONTENT
    ============================================================ --}}
    <main>
        @yield('content')
    </main>

    {{-- ============================================================
         FOOTER
    ============================================================ --}}
    <footer class="bg-stone-900 text-stone-300 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-10">

                {{-- Brand --}}
                <div class="sm:col-span-2 md:col-span-1">
                    <div class="flex items-center gap-3 mb-4">
                        <svg width="40" height="40" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="48" height="48" rx="13" fill="#15803d"/>
                            <path d="M14 30L16.5 42H31.5L34 30Z" fill="#f59e0b"/>
                            <rect x="12" y="27" width="24" height="5" rx="2.5" fill="#d97706"/>
                            <ellipse cx="24" cy="29.5" rx="9" ry="1.8" fill="#92400e"/>
                            <rect x="22.2" y="17" width="3.6" height="13" rx="1.8" fill="#86efac"/>
                            <path d="M23 22 C19 17 11 18 12 24 C16 22 20 21 23 22Z" fill="#4ade80"/>
                            <path d="M25 22 C29 17 37 18 36 24 C32 22 28 21 25 22Z" fill="#86efac"/>
                            <circle cx="24" cy="10"   r="3.2" fill="#fde68a"/>
                            <circle cx="29.8" cy="12.6" r="3.2" fill="#fde68a"/>
                            <circle cx="18.2" cy="12.6" r="3.2" fill="#fde68a"/>
                            <circle cx="27.8" cy="18.2" r="3.2" fill="#fde68a"/>
                            <circle cx="20.2" cy="18.2" r="3.2" fill="#fde68a"/>
                            <circle cx="24" cy="14.5" r="5"   fill="#f59e0b"/>
                            <circle cx="24" cy="14.5" r="2.8" fill="#fbbf24"/>
                        </svg>
                        <div class="leading-none">
                            <h3 class="brand-font text-white text-lg font-bold">
                                Flower<span class="text-amber-400">Pot</span>
                            </h3>
                            <span class="text-stone-500 text-xs tracking-wider">Plants &amp; Pots</span>
                        </div>
                    </div>
                    <p class="text-stone-400 text-sm leading-relaxed">
                        Bringing nature's beauty to your doorstep. Quality pots and plants for every home and garden.
                    </p>
                    <div class="flex space-x-3 mt-5">
                        <a href="#" class="text-stone-500 hover:text-amber-400 transition w-8 h-8 bg-stone-800 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-stone-500 hover:text-amber-400 transition w-8 h-8 bg-stone-800 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-stone-500 hover:text-amber-400 transition w-8 h-8 bg-stone-800 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.69a8.28 8.28 0 004.83 1.54V6.78a4.85 4.85 0 01-1.06-.09z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- Quick Links --}}
                <div>
                    <h4 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Quick Links</h4>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ route('home') }}"     class="text-stone-400 hover:text-amber-400 transition">Home</a></li>
                        <li><a href="{{ route('about') }}"    class="text-stone-400 hover:text-amber-400 transition">About Us</a></li>
                        <li><a href="{{ route('services') }}" class="text-stone-400 hover:text-amber-400 transition">Services</a></li>
                        <li><a href="{{ route('contact') }}"  class="text-stone-400 hover:text-amber-400 transition">Contact</a></li>
                    </ul>
                </div>

                {{-- Products --}}
                <div>
                    <h4 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Products</h4>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ route('products.ceramics') }}" class="text-stone-400 hover:text-amber-400 transition">Ceramic Pots</a></li>
                        <li><a href="{{ route('products.cement') }}"   class="text-stone-400 hover:text-amber-400 transition">Cement Pots</a></li>
                        <li><a href="{{ route('products.mud') }}"      class="text-stone-400 hover:text-amber-400 transition">Mud Pots</a></li>
                        <li><a href="{{ route('products.plastic') }}"  class="text-stone-400 hover:text-amber-400 transition">Plastic Pots</a></li>
                        <li><a href="{{ route('products.plants') }}"   class="text-stone-400 hover:text-amber-400 transition">Indoor Plants</a></li>
                    </ul>
                </div>

                {{-- Contact --}}
                <div>
                    <h4 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Contact Us</h4>
                    <ul class="space-y-3 text-sm text-stone-400">
                        <li class="flex items-start gap-2.5">
                            <svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            123 Garden Street, Lahore, Pakistan
                        </li>
                        <li class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 flex-shrink-0 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            +92 300 1234567
                        </li>
                        <li class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 flex-shrink-0 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            info@flowerpot.pk
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-stone-800 mt-10 pt-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-stone-500 text-sm">
                <p>&copy; {{ date('Y') }} FlowerPot. All rights reserved.</p>
                <p>Made with 🌿 for plant lovers.</p>
            </div>
        </div>
    </footer>

    {{-- ============================================================
         CART SLIDE-OUT DRAWER
    ============================================================ --}}
    <div x-data="{ open: false }" @open-cart.window="open = true">
        {{-- Backdrop --}}
        <div x-show="open" x-cloak
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
             @click="open = false"
             class="fixed inset-0 bg-black/60 z-40 backdrop-blur-sm"></div>

        {{-- Drawer --}}
        <div x-show="open" x-cloak
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"
             class="fixed right-0 top-0 h-full w-80 sm:w-96 bg-white shadow-2xl z-50 flex flex-col">

            {{-- Header --}}
            <div class="flex items-center justify-between px-5 py-4 border-b bg-stone-900 text-white">
                <h2 class="text-base font-bold flex items-center gap-2">
                    <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.5 6h13M7 13L5.4 5M10 21a1 1 0 100-2 1 1 0 000 2zm7 0a1 1 0 100-2 1 1 0 000 2z"/>
                    </svg>
                    Your Cart
                    <span x-text="'(' + $store.cart.count + ')'" class="text-stone-400 font-normal text-sm"></span>
                </h2>
                <button @click="open = false"
                        class="text-stone-400 hover:text-white transition text-2xl leading-none w-8 h-8 flex items-center justify-center rounded-lg hover:bg-stone-800">
                    &times;
                </button>
            </div>

            {{-- Items --}}
            <div class="flex-1 overflow-y-auto p-4">
                <template x-if="$store.cart.items.length === 0">
                    <div class="text-center py-20">
                        <div class="w-20 h-20 bg-stone-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-stone-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.5 6h13M7 13L5.4 5M10 21a1 1 0 100-2 1 1 0 000 2zm7 0a1 1 0 100-2 1 1 0 000 2z"/>
                            </svg>
                        </div>
                        <p class="text-stone-500 font-semibold">Your cart is empty</p>
                        <p class="text-stone-400 text-sm mt-1">Browse our collection and add some plants or pots!</p>
                    </div>
                </template>
                <template x-for="item in $store.cart.items" :key="item.name">
                    <div class="flex items-center gap-3 mb-3 p-3 bg-stone-50 rounded-xl border border-stone-100">
                        <img :src="item.image" :alt="item.name" class="w-14 h-14 object-cover rounded-lg flex-shrink-0">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-stone-800 truncate" x-text="item.name"></p>
                            <p class="text-xs text-stone-400 mt-0.5">Qty: <span x-text="item.qty"></span></p>
                            <p class="text-green-700 font-bold text-sm">Rs. <span x-text="(item.price * item.qty).toLocaleString()"></span></p>
                        </div>
                        <button @click="$store.cart.remove(item.name)"
                                class="text-stone-300 hover:text-red-500 transition text-xl leading-none flex-shrink-0 w-7 h-7 flex items-center justify-center rounded-lg hover:bg-red-50">
                            &times;
                        </button>
                    </div>
                </template>
            </div>

            {{-- Footer --}}
            <div x-show="$store.cart.items.length > 0" class="border-t p-4 bg-white">
                <div class="flex justify-between items-center mb-4">
                    <span class="font-semibold text-stone-700">Total</span>
                    <span class="font-extrabold text-green-700 text-xl">
                        Rs. <span x-text="$store.cart.total.toLocaleString()"></span>
                    </span>
                </div>
                <button class="w-full bg-green-700 hover:bg-green-800 text-white py-3 rounded-xl font-semibold transition shadow mb-2 text-sm">
                    Proceed to Checkout
                </button>
                <button @click="$store.cart.clear()" class="w-full text-stone-400 hover:text-red-500 text-sm py-2 transition font-medium">
                    Clear Cart
                </button>
            </div>
        </div>
    </div>

</body>
</html>
