@extends('layouts.app')

@section('title', 'Plastic Pots')

@section('content')

<section class="bg-gradient-to-r from-green-800 to-green-600 text-white py-16 px-4 text-center">
    <h1 class="text-4xl md:text-5xl font-extrabold mb-4">♻️ Plastic Pots</h1>
    <p class="text-green-200 text-lg max-w-2xl mx-auto">Lightweight, durable, and affordable plastic pots in Small, Medium, and Large sizes.</p>
</section>

<section class="py-12 px-4 bg-white" x-data="{ activeSize: 'large' }">
    <div class="max-w-7xl mx-auto">

        {{-- Size Filter Tabs --}}
        <div class="flex justify-center gap-3 mb-10">
            <button
                @click="activeSize = 'small'"
                :class="activeSize === 'small' ? 'bg-green-700 text-white shadow-md' : 'bg-white text-gray-600 border border-gray-300 hover:border-green-500 hover:text-green-700'"
                class="px-6 py-2.5 rounded-full font-semibold text-sm transition">
                Small
            </button>
            <button
                @click="activeSize = 'medium'"
                :class="activeSize === 'medium' ? 'bg-green-700 text-white shadow-md' : 'bg-white text-gray-600 border border-gray-300 hover:border-green-500 hover:text-green-700'"
                class="px-6 py-2.5 rounded-full font-semibold text-sm transition">
                Medium
            </button>
            <button
                @click="activeSize = 'large'"
                :class="activeSize === 'large' ? 'bg-green-700 text-white shadow-md' : 'bg-white text-gray-600 border border-gray-300 hover:border-green-500 hover:text-green-700'"
                class="px-6 py-2.5 rounded-full font-semibold text-sm transition">
                Large
            </button>
        </div>

        {{-- Small Pots --}}
        <div x-show="activeSize === 'small'" x-transition>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                @foreach($products['small'] as $item)
                    <x-product-card :image="$item['image']" :name="$item['name']" :price="$item['price']" />
                @endforeach
            </div>
        </div>

        {{-- Medium Pots --}}
        <div x-show="activeSize === 'medium'" x-transition>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                @foreach($products['medium'] as $item)
                    <x-product-card :image="$item['image']" :name="$item['name']" :price="$item['price']" />
                @endforeach
            </div>
        </div>

        {{-- Large Pots --}}
        <div x-show="activeSize === 'large'" x-transition>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                @foreach($products['large'] as $item)
                    <x-product-card :image="$item['image']" :name="$item['name']" :price="$item['price']" />
                @endforeach
            </div>
        </div>

    </div>
</section>

@endsection
