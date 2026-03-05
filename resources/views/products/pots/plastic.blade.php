@extends('layouts.app')

@section('title', 'Cement Pots')

@section('content')

<section class="relative text-white py-20 px-4 text-center overflow-hidden">
    <div class="absolute inset-0">
        <img src="{{ asset('images/cement/cement-large-pot2.webp') }}"
             class="w-full h-full object-cover" alt="Cement Pots">
        <div class="absolute inset-0 bg-green-900/75"></div>
    </div>
    <div class="relative z-10 max-w-3xl mx-auto">
        <p class="text-green-300 uppercase tracking-widest text-xs mb-3 font-semibold">Our Products / Pots</p>
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4">Cement Pots</h1>
        <p class="text-green-100 text-lg max-w-2xl mx-auto">Durable and stylish cement pots available in Small, Medium, and Large sizes.</p>
    </div>
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
            @if(count($products['small']) > 0)
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                    @foreach($products['small'] as $item)
                        <x-product-card :image="$item['image']" :name="$item['name']" />
                    @endforeach
                </div>
            @else
                <p class="text-center text-stone-400 py-16">No small plastic pots available yet.</p>
            @endif
        </div>

        {{-- Medium Pots --}}
        <div x-show="activeSize === 'medium'" x-transition>
            @if(count($products['medium']) > 0)
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                    @foreach($products['medium'] as $item)
                        <x-product-card :image="$item['image']" :name="$item['name']" />
                    @endforeach
                </div>
            @else
                <p class="text-center text-stone-400 py-16">No medium cement pots available yet.</p>
            @endif
        </div>

        {{-- Large Pots --}}
        <div x-show="activeSize === 'large'" x-transition>
            @if(count($products['large']) > 0)
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                    @foreach($products['large'] as $item)
                        <x-product-card :image="$item['image']" :name="$item['name']" />
                    @endforeach
                </div>
            @else
                <p class="text-center text-stone-400 py-16">No large cement pots available yet.</p>
            @endif
        </div>

    </div>
</section>

@endsection