@extends('layouts.app')

@section('title', 'About Us')

@section('content')

{{-- Hero --}}
<section class="relative text-white py-20 px-4 text-center overflow-hidden">
    <div class="absolute inset-0">
        <img src="{{ asset('images/ceramics/ceramics-large-pot2.webp') }}"
             class="w-full h-full object-cover" alt="About FlowerPot">
        <div class="absolute inset-0 bg-green-900/75"></div>
    </div>
    <div class="relative z-10 max-w-3xl mx-auto">
        <p class="text-green-300 uppercase tracking-widest text-xs mb-3 font-semibold">Who We Are</p>
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4">About FlowerPot</h1>
        <p class="text-green-100 text-lg max-w-2xl mx-auto">A modern full-stack e-commerce platform crafted to bring the beauty of nature to every home.</p>
    </div>
</section>

{{-- About the Platform --}}
<section class="py-16 px-4 bg-white">
    <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <div>
            <h2 class="text-3xl font-bold text-gray-800 mb-4">What is FlowerPot?</h2>
            <p class="text-gray-600 leading-relaxed mb-4">
                FlowerPot is a full-stack e-commerce web application built with <strong>Laravel</strong> — designed to make browsing, discovering, and purchasing beautiful flower pots and plants simple and enjoyable.
            </p>
            <p class="text-gray-600 leading-relaxed mb-4">
                Our store features a curated catalogue of ceramic, cement, mud, and plastic pots alongside a handpicked selection of popular indoor plants — all managed in real-time through a dedicated <strong>admin dashboard</strong>.
            </p>
            <p class="text-gray-600 leading-relaxed">
                Every price, product listing, and category on this platform is fully controlled by the admin, ensuring customers always see accurate, up-to-date information and a seamless shopping experience from browse to checkout.
            </p>
        </div>
        <div class="rounded-2xl overflow-hidden shadow-lg">
            <img src="{{ asset('images/ceramics/ceramics-large-pot5.webp') }}"
                 alt="FlowerPot Products"
                 class="w-full h-72 object-cover">
            <div class="bg-green-50 grid grid-cols-2 gap-px">
                <div class="bg-white text-center py-5">
                    <p class="text-3xl font-extrabold text-green-700">500+</p>
                    <p class="text-gray-500 text-sm">Products</p>
                </div>
                <div class="bg-white text-center py-5">
                    <p class="text-3xl font-extrabold text-green-700">5</p>
                    <p class="text-gray-500 text-sm">Categories</p>
                </div>
                <div class="bg-white text-center py-5">
                    <p class="text-3xl font-extrabold text-green-700">3</p>
                    <p class="text-gray-500 text-sm">Pot Sizes</p>
                </div>
                <div class="bg-white text-center py-5">
                    <p class="text-3xl font-extrabold text-green-700">100%</p>
                    <p class="text-gray-500 text-sm">Admin Controlled</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Mission & Vision --}}
<section class="py-16 px-4 bg-green-50">
    <div class="max-w-5xl mx-auto">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800">Our Mission & Values</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-2xl overflow-hidden shadow hover:shadow-lg transition">
                <div class="h-44 overflow-hidden">
                    <img src="{{ asset('images/Plants/money_plant.webp') }}"
                         alt="Our Mission"
                         class="w-full h-full object-cover">
                </div>
                <div class="p-5 text-center">
                    <h3 class="font-bold text-gray-800 mb-2">Our Mission</h3>
                    <p class="text-gray-500 text-sm">To make quality plants and pots accessible to every household, fostering a love for nature through a seamless online experience.</p>
                </div>
            </div>
            <div class="bg-white rounded-2xl overflow-hidden shadow hover:shadow-lg transition">
                <div class="h-44 overflow-hidden">
                    <img src="{{ asset('images/ceramics/ceramics-medium-pot1.webp') }}"
                         alt="Our Vision"
                         class="w-full h-full object-cover">
                </div>
                <div class="p-5 text-center">
                    <h3 class="font-bold text-gray-800 mb-2">Our Vision</h3>
                    <p class="text-gray-500 text-sm">To become a leading full-stack green lifestyle platform — inspiring plant lovers with a modern, admin-driven e-commerce experience.</p>
                </div>
            </div>
            <div class="bg-white rounded-2xl overflow-hidden shadow hover:shadow-lg transition">
                <div class="h-44 overflow-hidden">
                    <img src="{{ asset('images/mud/mud-large-pot1.webp') }}"
                         alt="Our Values"
                         class="w-full h-full object-cover">
                </div>
                <div class="p-5 text-center">
                    <h3 class="font-bold text-gray-800 mb-2">Our Values</h3>
                    <p class="text-gray-500 text-sm">Quality, transparency, and customer satisfaction guide every feature we build — from product discovery to doorstep delivery.</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
