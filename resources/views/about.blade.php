@extends('layouts.app')

@section('title', 'About Us')

@section('content')

{{-- Hero --}}
<section class="relative text-white py-24 px-4 text-center overflow-hidden">
    <div class="absolute inset-0">
        <img src="{{ asset('images/ceramics/ceramics-large-pot2.webp') }}"
             class="w-full h-full object-cover" alt="About FlowerPot">
        <div class="absolute inset-0 bg-gradient-to-b from-green-900/80 via-green-900/70 to-green-900/90"></div>
    </div>
    <div class="relative z-10 max-w-3xl mx-auto">
        <span class="inline-block bg-green-500/30 border border-green-400/40 text-green-300 uppercase tracking-widest text-xs px-4 py-1.5 rounded-full mb-4 font-semibold">About This Project</span>
        <h1 class="text-4xl md:text-5xl font-extrabold mb-5 leading-tight">FlowerPot</h1>
        <p class="text-green-100 text-lg max-w-2xl mx-auto leading-relaxed">
            A full-stack e-commerce web application for flower pots &amp; plants — built with Laravel, powered by a real admin dashboard.
        </p>
    </div>
</section>

{{-- What is FlowerPot? --}}
<section class="py-20 px-4 bg-white">
    <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-14 items-center">
        <div>
            <span class="text-green-600 font-semibold text-sm uppercase tracking-widest">The Project</span>
            <h2 class="text-3xl font-extrabold text-gray-900 mt-2 mb-5">What is FlowerPot?</h2>
            <p class="text-gray-600 leading-relaxed mb-4">
                FlowerPot is a <strong>full-stack e-commerce web application</strong> built with <strong>Laravel 12</strong>.
                It allows customers to browse and purchase a wide range of flower pots and indoor plants completely online.
            </p>
            <p class="text-gray-600 leading-relaxed mb-4">
                The platform includes a <strong>dedicated admin dashboard</strong> where all product prices, names, images,
                and categories are managed in real time — so every change made by the admin is immediately visible to customers.
            </p>
            <p class="text-gray-600 leading-relaxed">
                Products are organised into clear categories: <strong>Ceramic</strong>, <strong>Cement</strong>,
                <strong>Mud</strong>, <strong>Plastic</strong> pots, and <strong>Indoor Plants</strong>.
                Each product page is dynamically rendered from the database.
            </p>
        </div>
        <div class="rounded-3xl overflow-hidden shadow-xl">
            <img src="{{ asset('images/ceramics/ceramics-large-pot5.webp') }}"
                 alt="FlowerPot Product"
                 class="w-full h-80 object-cover">
        </div>
    </div>
</section>

{{-- Tech Stack (photo cards instead of icons) --}}
<section class="py-20 px-4 bg-green-50">
    <div class="max-w-5xl mx-auto">
        <div class="text-center mb-12">
            <span class="text-green-600 font-semibold text-sm uppercase tracking-widest">Tech Stack</span>
            <h2 class="text-3xl font-extrabold text-gray-900 mt-2">Built With</h2>
            <p class="text-gray-500 mt-3 max-w-xl mx-auto">Modern technologies chosen for performance, simplicity, and a great developer experience.</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="bg-white rounded-2xl overflow-hidden shadow hover:shadow-lg transition group">
                <div class="h-36 overflow-hidden">
                    <img src="{{ asset('images/ceramics/ceramics-medium-pot1.webp') }}"
                         alt="Laravel" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <div class="p-4 text-center">
                    <p class="font-bold text-gray-800">Laravel 12</p>
                    <p class="text-gray-400 text-xs mt-1">Backend Framework</p>
                </div>
            </div>
            <div class="bg-white rounded-2xl overflow-hidden shadow hover:shadow-lg transition group">
                <div class="h-36 overflow-hidden">
                    <img src="{{ asset('images/Plants/snake_plant.webp') }}"
                         alt="Tailwind CSS" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <div class="p-4 text-center">
                    <p class="font-bold text-gray-800">Tailwind CSS</p>
                    <p class="text-gray-400 text-xs mt-1">Utility-First Styling</p>
                </div>
            </div>
            <div class="bg-white rounded-2xl overflow-hidden shadow hover:shadow-lg transition group">
                <div class="h-36 overflow-hidden">
                    <img src="{{ asset('images/mud/mud-large-pot1.webp') }}"
                         alt="Alpine.js" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <div class="p-4 text-center">
                    <p class="font-bold text-gray-800">Alpine.js</p>
                    <p class="text-gray-400 text-xs mt-1">Lightweight Interactivity</p>
                </div>
            </div>
            <div class="bg-white rounded-2xl overflow-hidden shadow hover:shadow-lg transition group">
                <div class="h-36 overflow-hidden">
                    <img src="{{ asset('images/Plants/money_plant.webp') }}"
                         alt="Vite" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <div class="p-4 text-center">
                    <p class="font-bold text-gray-800">Vite</p>
                    <p class="text-gray-400 text-xs mt-1">Fast Asset Bundler</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- What the platform offers (photo cards) --}}
<section class="py-20 px-4 bg-white">
    <div class="max-w-5xl mx-auto">
        <div class="text-center mb-12">
            <span class="text-green-600 font-semibold text-sm uppercase tracking-widest">Features</span>
            <h2 class="text-3xl font-extrabold text-gray-900 mt-2">What This Platform Offers</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="rounded-2xl overflow-hidden shadow hover:shadow-xl transition group">
                <div class="h-52 overflow-hidden">
                    <img src="{{ asset('images/ceramics/ceramics-large-pot7.webp') }}"
                         alt="Product Catalogue"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <div class="p-6 bg-white">
                    <h3 class="font-bold text-gray-800 text-lg mb-2">Product Catalogue</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Browse pots (ceramic, cement, mud, plastic) and indoor plants, each with real photos and live prices from the database.</p>
                </div>
            </div>
            <div class="rounded-2xl overflow-hidden shadow hover:shadow-xl transition group">
                <div class="h-52 overflow-hidden">
                    <img src="{{ asset('images/Plants/Boston_Fern.webp') }}"
                         alt="Shopping Cart"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <div class="p-6 bg-white">
                    <h3 class="font-bold text-gray-800 text-lg mb-2">Shopping Cart</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">A live slide-out cart powered by Alpine.js — add items, see running totals, and proceed to checkout without a page reload.</p>
                </div>
            </div>
            <div class="rounded-2xl overflow-hidden shadow hover:shadow-xl transition group">
                <div class="h-52 overflow-hidden">
                    <img src="{{ asset('images/cement/cement-large-pot2.webp') }}"
                         alt="Admin Dashboard"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <div class="p-6 bg-white">
                    <h3 class="font-bold text-gray-800 text-lg mb-2">Admin Dashboard</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Admins control every product price, name, image, and category directly from the dashboard — changes reflect instantly for customers.</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

