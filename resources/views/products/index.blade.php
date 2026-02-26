@extends('layouts.app')

@section('title', 'Products')

@section('content')

<section class="bg-gradient-to-r from-green-800 to-green-600 text-white py-16 px-4 text-center">
    <h1 class="text-4xl md:text-5xl font-extrabold mb-4">Our Products</h1>
    <p class="text-green-200 text-lg max-w-2xl mx-auto">Explore our wide collection of beautiful pots and vibrant plants.</p>
</section>

<section class="py-16 px-4 bg-white">
    <div class="max-w-4xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

            {{-- Pots Card --}}
            <a href="{{ route('products.pots') }}" class="group block bg-gradient-to-br from-amber-50 to-amber-100 rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center justify-center h-56 bg-amber-100 text-8xl group-hover:scale-110 transition-transform duration-300">
                    🏺
                </div>
                <div class="p-8">
                    <h2 class="text-2xl font-extrabold text-gray-800 mb-3">Pots</h2>
                    <p class="text-gray-600 mb-4">Discover our stunning range of pots — from elegant ceramics to rustic mud, durable cement to practical plastic. Perfect for indoors and outdoors.</p>
                    <div class="flex flex-wrap gap-2 mb-6">
                        <span class="bg-amber-200 text-amber-800 text-xs font-medium px-3 py-1 rounded-full">Ceramics</span>
                        <span class="bg-gray-200 text-gray-700 text-xs font-medium px-3 py-1 rounded-full">Cement</span>
                        <span class="bg-yellow-200 text-yellow-800 text-xs font-medium px-3 py-1 rounded-full">Mud</span>
                        <span class="bg-blue-200 text-blue-700 text-xs font-medium px-3 py-1 rounded-full">Plastic</span>
                    </div>
                    <span class="inline-block bg-green-700 text-white font-semibold px-6 py-2.5 rounded-full group-hover:bg-green-800 transition">
                        Explore Pots →
                    </span>
                </div>
            </a>

            {{-- Plants Card --}}
            <a href="{{ route('products.plants') }}" class="group block bg-gradient-to-br from-green-50 to-green-100 rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center justify-center h-56 bg-green-100 text-8xl group-hover:scale-110 transition-transform duration-300">
                    🌿
                </div>
                <div class="p-8">
                    <h2 class="text-2xl font-extrabold text-gray-800 mb-3">Plants</h2>
                    <p class="text-gray-600 mb-4">Bring life to your spaces with our curated selection of indoor plants. From air-purifying snake plants to cheerful money plants — we have it all.</p>
                    <div class="flex flex-wrap gap-2 mb-6">
                        <span class="bg-green-200 text-green-800 text-xs font-medium px-3 py-1 rounded-full">Aloe Vera</span>
                        <span class="bg-green-200 text-green-800 text-xs font-medium px-3 py-1 rounded-full">Snake Plant</span>
                        <span class="bg-green-200 text-green-800 text-xs font-medium px-3 py-1 rounded-full">Money Plant</span>
                        <span class="bg-green-200 text-green-800 text-xs font-medium px-3 py-1 rounded-full">& More</span>
                    </div>
                    <span class="inline-block bg-green-700 text-white font-semibold px-6 py-2.5 rounded-full group-hover:bg-green-800 transition">
                        Explore Plants →
                    </span>
                </div>
            </a>

        </div>
    </div>
</section>

@endsection
