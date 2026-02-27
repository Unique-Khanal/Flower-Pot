@extends('layouts.app')

@section('title', 'Pots')

@section('content')

<section class="bg-gradient-to-r from-green-800 to-green-600 text-white py-16 px-4 text-center">
    <h1 class="text-4xl md:text-5xl font-extrabold mb-4">🏺 Pots</h1>
    <p class="text-green-200 text-lg max-w-2xl mx-auto">Choose from our diverse range of pot materials, each with its own charm and character.</p>
</section>

<section class="py-16 px-4 bg-white">
    <div class="max-w-6xl mx-auto">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

            <a href="{{ route('products.ceramics') }}" class="group bg-white border border-gray-100 rounded-2xl overflow-hidden shadow hover:shadow-xl transition hover:-translate-y-1">
                <div class="h-44 overflow-hidden">
                    <img src="{{ asset('images/ceramics/ceramics-large-pot2.webp') }}" alt="Ceramic Pots"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                </div>
                <div class="p-5 text-center">
                    <h3 class="text-lg font-bold text-gray-800">Ceramics</h3>
                    <p class="text-gray-500 text-xs mt-1 mb-4">Elegant glazed pottery in various sizes</p>
                    <span class="inline-block bg-green-700 text-white text-xs font-semibold px-4 py-2 rounded-full group-hover:bg-green-800 transition">
                        View Collection →
                    </span>
                </div>
            </a>

            <a href="{{ route('products.cement') }}" class="group bg-white border border-gray-100 rounded-2xl overflow-hidden shadow hover:shadow-xl transition hover:-translate-y-1">
                <div class="h-44 overflow-hidden">
                    <img src="{{ asset('images/cement/cement-large-pot1.jpg') }}" alt="Cement Pots"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                </div>
                <div class="p-5 text-center">
                    <h3 class="text-lg font-bold text-gray-800">Cement</h3>
                    <p class="text-gray-500 text-xs mt-1 mb-4">Sturdy, modern pots for indoors & outdoors</p>
                    <span class="inline-block bg-green-700 text-white text-xs font-semibold px-4 py-2 rounded-full group-hover:bg-green-800 transition">
                        View Collection →
                    </span>
                </div>
            </a>

            <a href="{{ route('products.mud') }}" class="group bg-white border border-gray-100 rounded-2xl overflow-hidden shadow hover:shadow-xl transition hover:-translate-y-1">
                <div class="h-44 overflow-hidden">
                    <img src="{{ asset('images/mud/mud-large-pot1.webp') }}" alt="Mud Pots"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                </div>
                <div class="p-5 text-center">
                    <h3 class="text-lg font-bold text-gray-800">Mud</h3>
                    <p class="text-gray-500 text-xs mt-1 mb-4">Traditional clay pots, naturally breathable</p>
                    <span class="inline-block bg-green-700 text-white text-xs font-semibold px-4 py-2 rounded-full group-hover:bg-green-800 transition">
                        View Collection →
                    </span>
                </div>
            </a>

            <a href="{{ route('products.plastic') }}" class="group bg-white border border-gray-100 rounded-2xl overflow-hidden shadow hover:shadow-xl transition hover:-translate-y-1">
                <div class="h-44 overflow-hidden">
                    <img src="{{ asset('images/plastic/plastic-large-pot1.jpg') }}" alt="Plastic Pots"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                </div>
                <div class="p-5 text-center">
                    <h3 class="text-lg font-bold text-gray-800">Plastic</h3>
                    <p class="text-gray-500 text-xs mt-1 mb-4">Lightweight, durable, and affordable pots</p>
                    <span class="inline-block bg-green-700 text-white text-xs font-semibold px-4 py-2 rounded-full group-hover:bg-green-800 transition">
                        View Collection →
                    </span>
                </div>
            </a>

        </div>
    </div>
</section>

@endsection
