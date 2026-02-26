<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FlowerPot') | FlowerPot</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50 font-sans">

    <!-- Navbar -->
    <nav class="bg-green-800 shadow-lg" x-data="{ mobileOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="{{ route('home') }}" class="text-white text-2xl font-bold tracking-wide">
                        🌸 FlowerPot
                    </a>
                </div>

                <!-- Desktop Nav -->
                <div class="hidden md:flex items-center space-x-1">
                    <a href="{{ route('home') }}" class="text-green-100 hover:text-white hover:bg-green-700 px-3 py-2 rounded-md text-sm font-medium transition">Home</a>
                    <a href="{{ route('about') }}" class="text-green-100 hover:text-white hover:bg-green-700 px-3 py-2 rounded-md text-sm font-medium transition">About</a>
                    <a href="{{ route('services') }}" class="text-green-100 hover:text-white hover:bg-green-700 px-3 py-2 rounded-md text-sm font-medium transition">Services</a>

                    <!-- Products Dropdown -->
                    <div class="relative" x-data="{ productsOpen: false }" @mouseenter="productsOpen = true" @mouseleave="productsOpen = false">
                        <button class="text-green-100 hover:text-white hover:bg-green-700 px-3 py-2 rounded-md text-sm font-medium transition flex items-center gap-1">
                            Products
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="productsOpen" x-cloak class="absolute left-0 mt-0 w-48 bg-white rounded-md shadow-lg z-50 py-1">
                            <!-- Pots sub-menu -->
                            <div class="relative" x-data="{ potsOpen: false }" @mouseenter="potsOpen = true" @mouseleave="potsOpen = false">
                                <a href="{{ route('products.pots') }}" class="flex items-center justify-between px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700">
                                    🏺 Pots
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                                <div x-show="potsOpen" x-cloak class="absolute left-full top-0 w-40 bg-white rounded-md shadow-lg z-50 py-1">
                                    <a href="{{ route('products.ceramics') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700">🪴 Ceramics</a>
                                    <a href="{{ route('products.cement') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700">🪨 Cement</a>
                                    <a href="{{ route('products.mud') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700">🌿 Mud</a>
                                    <a href="{{ route('products.plastic') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700">♻️ Plastic</a>
                                </div>
                            </div>
                            <a href="{{ route('products.plants') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700">🌱 Plants</a>
                        </div>
                    </div>

                    <a href="{{ route('contact') }}" class="text-green-100 hover:text-white hover:bg-green-700 px-3 py-2 rounded-md text-sm font-medium transition">Contact Us</a>
                </div>

                <!-- Right side: Login + Cart -->
                <div class="hidden md:flex items-center space-x-3">
                    <!-- Cart -->
                    <button class="relative text-green-100 hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.5 6h13M7 13L5.4 5M10 21a1 1 0 100-2 1 1 0 000 2zm7 0a1 1 0 100-2 1 1 0 000 2z"/>
                        </svg>
                        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold">0</span>
                    </button>
                    <a href="{{ route('login') }}" class="bg-white text-green-800 hover:bg-green-100 px-4 py-2 rounded-md text-sm font-semibold transition">Login</a>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center space-x-2">
                    <button class="relative text-green-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.5 6h13M7 13L5.4 5M10 21a1 1 0 100-2 1 1 0 000 2zm7 0a1 1 0 100-2 1 1 0 000 2z"/>
                        </svg>
                        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold">0</span>
                    </button>
                    <button @click="mobileOpen = !mobileOpen" class="text-green-100 hover:text-white p-2">
                        <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <svg x-show="mobileOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileOpen" x-cloak class="md:hidden bg-green-900 px-4 pb-4 space-y-1">
            <a href="{{ route('home') }}" class="block text-green-100 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Home</a>
            <a href="{{ route('about') }}" class="block text-green-100 hover:text-white px-3 py-2 rounded-md text-sm font-medium">About</a>
            <a href="{{ route('services') }}" class="block text-green-100 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Services</a>
            <div x-data="{ open: false }">
                <button @click="open = !open" class="w-full text-left text-green-100 hover:text-white px-3 py-2 rounded-md text-sm font-medium flex justify-between">
                    Products
                    <svg class="w-4 h-4 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="open" x-cloak class="pl-4 space-y-1">
                    <a href="{{ route('products.pots') }}" class="block text-green-200 hover:text-white px-3 py-1.5 text-sm">🏺 Pots</a>
                    <a href="{{ route('products.ceramics') }}" class="block text-green-200 hover:text-white px-6 py-1 text-sm">- Ceramics</a>
                    <a href="{{ route('products.cement') }}" class="block text-green-200 hover:text-white px-6 py-1 text-sm">- Cement</a>
                    <a href="{{ route('products.mud') }}" class="block text-green-200 hover:text-white px-6 py-1 text-sm">- Mud</a>
                    <a href="{{ route('products.plastic') }}" class="block text-green-200 hover:text-white px-6 py-1 text-sm">- Plastic</a>
                    <a href="{{ route('products.plants') }}" class="block text-green-200 hover:text-white px-3 py-1.5 text-sm">🌱 Plants</a>
                </div>
            </div>
            <a href="{{ route('contact') }}" class="block text-green-100 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Contact Us</a>
            <a href="{{ route('login') }}" class="block bg-white text-green-800 px-3 py-2 rounded-md text-sm font-semibold text-center mt-2">Login</a>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-green-900 text-green-100 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Brand -->
                <div>
                    <h3 class="text-white text-xl font-bold mb-3">🌸 FlowerPot</h3>
                    <p class="text-green-300 text-sm leading-relaxed">Bringing nature's beauty to your doorstep. Quality pots and plants for every home.</p>
                    <div class="flex space-x-3 mt-4">
                        <a href="#" class="text-green-300 hover:text-white transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="text-green-300 hover:text-white transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                        <a href="#" class="text-green-300 hover:text-white transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.69a8.28 8.28 0 004.83 1.54V6.78a4.85 4.85 0 01-1.06-.09z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-white font-semibold mb-3">Quick Links</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('home') }}" class="text-green-300 hover:text-white transition">Home</a></li>
                        <li><a href="{{ route('about') }}" class="text-green-300 hover:text-white transition">About Us</a></li>
                        <li><a href="{{ route('services') }}" class="text-green-300 hover:text-white transition">Services</a></li>
                        <li><a href="{{ route('contact') }}" class="text-green-300 hover:text-white transition">Contact</a></li>
                    </ul>
                </div>

                <!-- Products -->
                <div>
                    <h4 class="text-white font-semibold mb-3">Products</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('products.ceramics') }}" class="text-green-300 hover:text-white transition">Ceramic Pots</a></li>
                        <li><a href="{{ route('products.cement') }}" class="text-green-300 hover:text-white transition">Cement Pots</a></li>
                        <li><a href="{{ route('products.mud') }}" class="text-green-300 hover:text-white transition">Mud Pots</a></li>
                        <li><a href="{{ route('products.plastic') }}" class="text-green-300 hover:text-white transition">Plastic Pots</a></li>
                        <li><a href="{{ route('products.plants') }}" class="text-green-300 hover:text-white transition">Plants</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="text-white font-semibold mb-3">Contact Us</h4>
                    <ul class="space-y-2 text-sm text-green-300">
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            123 Garden Street, Green City
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            +92 300 1234567
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            info@flowerpot.pk
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-green-700 mt-8 pt-6 text-center text-green-400 text-sm">
                <p>&copy; {{ date('Y') }} FlowerPot. All rights reserved. Made with 🌿 for plant lovers.</p>
            </div>
        </div>
    </footer>

</body>
</html>
