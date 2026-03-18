@extends('layouts.app')
@section('title', $product->name)
@section('content')

<section class="py-12 px-4 bg-stone-50 min-h-screen">
    <div class="max-w-5xl mx-auto">

        {{-- Breadcrumb --}}
        <div class="text-sm text-stone-500 mb-6 flex items-center gap-2">
            <a href="{{ route('products.index') }}" class="hover:text-green-700">Products</a>
            <span>›</span>
            <a href="{{ route('products.' . $product->category) }}" class="hover:text-green-700 capitalize">{{ $product->category }}</a>
            <span>›</span>
            <span class="text-stone-700 font-medium">{{ $product->name }}</span>
        </div>

        {{-- Success message --}}
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-3xl shadow-lg overflow-hidden grid grid-cols-1 md:grid-cols-2">

            {{-- Image --}}
            <div class="relative">
                <img src="{{ asset($product->image) }}"
                     alt="{{ $product->name }}"
                     class="w-full h-96 md:h-full object-cover">
                @if($product->badge)
                    <span class="absolute top-4 left-4 bg-green-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase">
                        {{ $product->badge }}
                    </span>
                @endif
            </div>

            {{-- Details --}}
            <div class="p-8 flex flex-col justify-between">
                <div>
                    <span class="text-xs font-semibold uppercase tracking-widest text-green-600">{{ $product->category }}</span>
                    <h1 class="text-3xl font-bold text-stone-800 mt-2 mb-4">{{ $product->name }}</h1>

                    {{-- Price --}}
                    <div class="text-4xl font-extrabold text-green-700 mb-6">
                        Rs. {{ number_format($product->price, 2) }}
                    </div>

                    {{-- Details Table --}}
                    <div class="space-y-3 mb-6">
                        @if($product->size)
                        <div class="flex justify-between py-2 border-b border-stone-100">
                            <span class="text-stone-500 font-medium">Size</span>
                            <span class="text-stone-800 font-semibold capitalize">{{ $product->size }}</span>
                        </div>
                        @endif
                        <div class="flex justify-between py-2 border-b border-stone-100">
                            <span class="text-stone-500 font-medium">Quantity per item</span>
                            <span class="text-stone-800 font-semibold">{{ $product->quantity }}</span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-stone-100">
                            <span class="text-stone-500 font-medium">Stock</span>
                            @if($product->stock > 0)
                                <span class="text-green-600 font-semibold">{{ $product->stock }} available</span>
                            @else
                                <span class="text-red-500 font-semibold">Out of Stock</span>
                            @endif
                        </div>
                        <div class="flex justify-between py-2">
                            <span class="text-stone-500 font-medium">Category</span>
                            <span class="text-stone-800 font-semibold capitalize">{{ $product->category }}</span>
                        </div>
                    </div>
                </div>

                {{-- Add to Cart --}}
                @if($product->stock > 0)
                    <form method="POST" action="{{ route('cart.add', $product) }}">
                        @csrf
                        <button type="submit"
                                class="w-full bg-green-700 hover:bg-green-800 text-white font-bold
                                       py-3.5 rounded-xl transition shadow-md hover:-translate-y-0.5 text-base">
                            🛒 Add to Cart
                        </button>
                    </form>
                @else
                    <button disabled
                            class="w-full bg-stone-300 text-stone-500 font-bold py-3.5 rounded-xl cursor-not-allowed">
                        Out of Stock
                    </button>
                @endif

                <a href="{{ route('products.' . $product->category) }}"
                   class="mt-4 text-center text-sm text-green-700 hover:text-green-900 font-medium block">
                    ← Back to {{ ucfirst($product->category) }}
                </a>
            </div>
        </div>
    </div>
</section>

@endsection