@extends('layouts.app')
@section('title', 'My Cart')
@section('content')

<section class="py-12 px-4 bg-stone-50 min-h-screen">
    <div class="max-w-5xl mx-auto">

        <h1 class="text-3xl font-bold text-stone-800 mb-8">🛒 My Cart</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if($cartItems->isEmpty())
            <div class="bg-white rounded-3xl shadow p-16 text-center">
                <div class="text-6xl mb-4">🛒</div>
                <h2 class="text-xl font-bold text-stone-700 mb-2">Your cart is empty</h2>
                <p class="text-stone-500 mb-6">Browse our products and add something you love!</p>
                <a href="{{ route('products.index') }}"
                   class="inline-block bg-green-700 hover:bg-green-800 text-white font-bold px-8 py-3 rounded-xl transition">
                    Browse Products
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- Cart Items --}}
                <div class="lg:col-span-2 space-y-4">
                    @foreach($cartItems as $item)
                    <div class="bg-white rounded-2xl shadow-sm p-4 flex gap-4 items-center">
                        <img src="{{ asset($item->product->image) }}"
                             alt="{{ $item->product->name }}"
                             class="w-20 h-20 object-cover rounded-xl flex-shrink-0">
                        <div class="flex-1">
                            <h3 class="font-bold text-stone-800">{{ $item->product->name }}</h3>
                            <p class="text-green-700 font-semibold text-sm mt-1">
                                Rs. {{ number_format($item->product->price, 2) }}
                            </p>
                            @if($item->product->size)
                                <span class="text-xs text-stone-400 capitalize">{{ $item->product->size }}</span>
                            @endif
                        </div>

                        {{-- Quantity --}}
                        <form method="POST" action="{{ route('cart.update', $item) }}" class="flex items-center gap-2">
                            @csrf
                            @method('PATCH')
                            <input type="number" name="quantity" value="{{ $item->quantity }}"
                                   min="1" max="{{ $item->product->stock }}"
                                   class="w-16 border border-stone-300 rounded-lg px-2 py-1 text-sm text-center focus:outline-none focus:ring-2 focus:ring-green-500">
                            <button type="submit"
                                    class="text-xs bg-stone-100 hover:bg-stone-200 text-stone-700 px-2 py-1 rounded-lg transition">
                                Update
                            </button>
                        </form>

                        {{-- Subtotal --}}
                        <div class="text-right flex-shrink-0">
                            <p class="font-bold text-stone-800">
                                Rs. {{ number_format($item->product->price * $item->quantity, 2) }}
                            </p>
                        </div>

                        {{-- Remove --}}
                        <form method="POST" action="{{ route('cart.remove', $item) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-600 transition ml-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                    @endforeach
                </div>

                {{-- Order Summary --}}
                <div class="bg-white rounded-2xl shadow-sm p-6 h-fit">
                    <h2 class="text-lg font-bold text-stone-800 mb-4">Order Summary</h2>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between text-stone-600">
                            <span>Items ({{ $cartItems->count() }})</span>
                            <span>Rs. {{ number_format($total, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-stone-600">
                            <span>Delivery</span>
                            <span class="text-green-600 font-medium">Limited Charge</span>
                        </div>
                        <div class="border-t border-stone-100 pt-3 flex justify-between font-bold text-stone-800 text-base">
                            <span>Total</span>
                            <span>Rs. {{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                    <a href="{{ route('orders.create') }}"
   class="block w-full mt-6 bg-amber-400 hover:bg-amber-300 text-stone-900
          font-bold py-3 rounded-xl transition shadow-md text-center">
    Proceed to Checkout →
</a>
<a href="{{ route('orders.index') }}"
   class="block text-center mt-3 text-sm text-green-700 hover:text-green-900 font-medium">
    📦 View My Orders
</a>
                    <a href="{{ route('products.index') }}"
                       class="block text-center mt-3 text-sm text-green-700 hover:text-green-900 font-medium">
                        ← Continue Shopping
                    </a>
                </div>
            </div>
        @endif
    </div>
</section>

@endsection