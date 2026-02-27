@extends('layouts.app')

@section('title', 'Home')

@section('content')

{{-- Hero Section --}}
<section class="bg-gradient-to-br from-green-700 via-green-600 to-emerald-500 text-white py-24 px-4">
    <div class="max-w-5xl mx-auto text-center">
        <p class="text-green-200 uppercase tracking-widest text-sm mb-3 font-medium">Welcome to FlowerPot</p>
        <h1 class="text-5xl md:text-6xl font-extrabold mb-6 leading-tight">
            Bring Nature <span class="text-yellow-300">Home</span>
        </h1>
        <p class="text-green-100 text-lg md:text-xl mb-10 max-w-2xl mx-auto">
            Discover our curated collection of beautiful pots and vibrant plants. Transform your living space into a green paradise.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('products.index') }}" class="bg-white text-green-800 hover:bg-green-50 font-bold px-8 py-3 rounded-full text-lg shadow-lg transition">
                🛍 Shop Now
            </a>
            <a href="{{ route('products.plants') }}" class="border-2 border-white text-white hover:bg-white hover:text-green-800 font-bold px-8 py-3 rounded-full text-lg transition">
                🌿 Explore Plants
            </a>
        </div>
    </div>
</section>

{{-- Featured Products --}}
<section class="py-16 px-4 bg-white">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-gray-800">Featured Products</h2>
            <p class="text-gray-500 mt-2">Handpicked favorites for your home & garden</p>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
            <x-product-card image="images/ceramics/ceramics-large-pot2.webp" name="Ceramic Large Pot" price="2500" badge="Popular" />
            <x-product-card image="images/ceramics/ceramics-medium-pot1.webp" name="Ceramic Medium Pot" price="1800" />
            <x-product-card image="images/cement/cement-large-pot1.jpg" name="Cement Large Pot" price="1800" badge="New" />
            <x-product-card image="images/plastic/plastic-large-pot1.jpg" name="Plastic Large Pot" price="800" />
            <x-product-card image="images/Plants/snake_plant.webp" name="Snake Plant" price="600" badge="Trending" />
            <x-product-card image="images/Plants/money_plant.webp" name="Money Plant" price="300" />
        </div>
        <div class="text-center mt-10">
            <a href="{{ route('products.index') }}" class="inline-block bg-green-700 hover:bg-green-800 text-white font-semibold px-8 py-3 rounded-full transition shadow">
                View All Products →
            </a>
        </div>
    </div>
</section>

{{-- Categories Showcase --}}
<section class="py-16 px-4 bg-green-50">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-gray-800">Shop by Category</h2>
            <p class="text-gray-500 mt-2">Find the perfect pot or plant for every corner</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <a href="{{ route('products.pots') }}" class="group bg-white rounded-2xl shadow hover:shadow-lg overflow-hidden transition">
                <div class="h-36 overflow-hidden">
                    <img src="{{ asset('images/ceramics/ceramics-large-pot5.webp') }}" alt="Pots"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                </div>
                <div class="p-4 text-center">
                    <h3 class="font-bold text-gray-800">Pots</h3>
                    <p class="text-gray-500 text-xs mt-1">Ceramic, Cement, Mud & More</p>
                </div>
            </a>
            <a href="{{ route('products.plants') }}" class="group bg-white rounded-2xl shadow hover:shadow-lg overflow-hidden transition">
                <div class="h-36 overflow-hidden">
                    <img src="{{ asset('images/Plants/snake_plant.webp') }}" alt="Plants"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                </div>
                <div class="p-4 text-center">
                    <h3 class="font-bold text-gray-800">Plants</h3>
                    <p class="text-gray-500 text-xs mt-1">Indoor & Outdoor Plants</p>
                </div>
            </a>
            <a href="{{ route('products.ceramics') }}" class="group bg-white rounded-2xl shadow hover:shadow-lg overflow-hidden transition">
                <div class="h-36 overflow-hidden">
                    <img src="{{ asset('images/ceramics/ceramics-medium-pot1.webp') }}" alt="Ceramics"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                </div>
                <div class="p-4 text-center">
                    <h3 class="font-bold text-gray-800">Ceramics</h3>
                    <p class="text-gray-500 text-xs mt-1">Elegant Glazed Pots</p>
                </div>
            </a>
            <a href="{{ route('products.cement') }}" class="group bg-white rounded-2xl shadow hover:shadow-lg overflow-hidden transition">
                <div class="h-36 overflow-hidden">
                    <img src="{{ asset('images/cement/cement-large-pot2.webp') }}" alt="Cement"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                </div>
                <div class="p-4 text-center">
                    <h3 class="font-bold text-gray-800">Cement</h3>
                    <p class="text-gray-500 text-xs mt-1">Durable & Stylish</p>
                </div>
            </a>
        </div>
    </div>
</section>

{{-- Why Choose Us --}}
<section class="py-16 px-4 bg-white">
    <div class="max-w-5xl mx-auto">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-gray-800">Why Choose Us?</h2>
            <p class="text-gray-500 mt-2">We're committed to bringing the best to your garden</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-green-50 rounded-2xl overflow-hidden shadow hover:shadow-md transition">
                <div class="h-40 overflow-hidden">
                    <img src="{{ asset('images/cement/cement-large-pot3.webp') }}" alt="Free Delivery"
                         class="w-full h-full object-cover">
                </div>
                <div class="p-5 text-center">
                    <h3 class="font-bold text-gray-800 text-lg mb-2">Free Delivery</h3>
                    <p class="text-gray-500 text-sm">Free home delivery on all orders above Rs. 1500. We deliver across Pakistan.</p>
                </div>
            </div>
            <div class="bg-green-50 rounded-2xl overflow-hidden shadow hover:shadow-md transition">
                <div class="h-40 overflow-hidden">
                    <img src="{{ asset('images/Plants/money_plant1.webp') }}" alt="100% Natural"
                         class="w-full h-full object-cover">
                </div>
                <div class="p-5 text-center">
                    <h3 class="font-bold text-gray-800 text-lg mb-2">100% Natural</h3>
                    <p class="text-gray-500 text-sm">All our plants are naturally grown. Healthy, vibrant, and ready for your home.</p>
                </div>
            </div>
            <div class="bg-green-50 rounded-2xl overflow-hidden shadow hover:shadow-md transition">
                <div class="h-40 overflow-hidden">
                    <img src="{{ asset('images/Plants/Boston_Fern2.webp') }}" alt="Gift Wrapping"
                         class="w-full h-full object-cover">
                </div>
                <div class="p-5 text-center">
                    <h3 class="font-bold text-gray-800 text-lg mb-2">Gift Wrapping</h3>
                    <p class="text-gray-500 text-sm">Special gift packaging available. Perfect for birthdays, anniversaries, and more.</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
