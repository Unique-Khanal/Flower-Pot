@extends('layouts.app')

@section('title', 'Search Results')

@section('content')

<section class="bg-gradient-to-br from-[#1B3B2F] to-[#2F6B4F] py-14 px-4">
    <div class="max-w-2xl mx-auto text-center">
        <h1 class="text-2xl sm:text-3xl font-extrabold text-white mb-6">Search our collection</h1>
        <form action="{{ route('products.search') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
            <div class="relative flex-1">
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-stone-400 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.34-4.34M19 11a8 8 0 1 1-16 0 8 8 0 0 1 16 0Z"/>
                </svg>
                <input type="text" name="q" value="{{ $q }}" autofocus
                       placeholder="Search for pots, plants, categories..."
                       class="w-full pl-14 pr-4 py-3.5 rounded-xl border-0 bg-white text-base leading-none text-stone-800 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-[#2F6B4F] shadow-lg">
            </div>
            <button type="submit"
                    class="bg-[#1B3B2F] hover:bg-[#12281F] text-white font-bold px-6 py-3.5 rounded-xl text-sm shadow-lg transition whitespace-nowrap">
                Search
            </button>
        </form>
    </div>
</section>

<section class="py-12 px-4 bg-white min-h-[40vh]">
    <div class="max-w-7xl mx-auto">
        @if ($q === '')
            <p class="text-center text-stone-400 py-16">Type something above to search our products.</p>
        @elseif ($products->isEmpty())
            <div class="text-center py-16">
                <p class="text-stone-500 text-lg font-semibold">No results for "{{ $q }}"</p>
                <p class="text-stone-400 text-sm mt-1">Try a different name, category, or check your spelling.</p>
            </div>
        @else
            <p class="text-sm text-stone-500 mb-6">{{ $products->count() }} result{{ $products->count() === 1 ? '' : 's' }} for "<span class="font-semibold text-stone-700">{{ $q }}</span>"</p>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                @foreach ($products as $item)
                    <x-product-card
                        :image="$item->image"
                        :name="$item->name"
                        :price="$item->price"
                        :badge="$item->badge"
                        :productId="$item->id"
                    />
                @endforeach
            </div>
        @endif
    </div>
</section>

@endsection