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

                        {{-- Product Image --}}
                        <img src="{{ asset($item->product->image) }}"
                             alt="{{ $item->product->name }}"
                             class="w-20 h-20 object-cover rounded-xl flex-shrink-0">

                        {{-- Product Info --}}
                        <div class="flex-1">
                            <h3 class="font-bold text-stone-800">{{ $item->product->name }}</h3>
                            <p class="text-green-700 font-semibold text-sm mt-1">
                                Rs. {{ number_format($item->product->price, 2) }} each
                            </p>
                            @if($item->product->size)
                                <span class="text-xs text-stone-400 capitalize">{{ $item->product->size }}</span>
                            @endif
                        </div>

                        {{-- Quantity Controls with +/- buttons --}}
                        <div style="display:flex; align-items:center; gap:6px;">
                            <button type="button"
                                    onclick="changeQty({{ $item->id }}, -1, {{ $item->product->price }}, {{ $item->product->stock }})"
                                    style="width:30px; height:30px; border-radius:50%;
                                           border:1.5px solid #d6d3d1; background:white;
                                           cursor:pointer; font-size:1.1rem; font-weight:700;
                                           display:flex; align-items:center; justify-content:center;
                                           color:#44403c; transition:all 0.2s;"
                                    onmouseover="this.style.background='#f5f5f4'"
                                    onmouseout="this.style.background='white'">
                                −
                            </button>

                            <span id="qty-{{ $item->id }}"
                                  style="width:36px; text-align:center;
                                         font-weight:700; font-size:0.95rem;
                                         color:#1c1917;">
                                {{ $item->quantity }}
                            </span>

                            <button type="button"
                                    onclick="changeQty({{ $item->id }}, 1, {{ $item->product->price }}, {{ $item->product->stock }})"
                                    style="width:30px; height:30px; border-radius:50%;
                                           border:1.5px solid #d6d3d1; background:white;
                                           cursor:pointer; font-size:1.1rem; font-weight:700;
                                           display:flex; align-items:center; justify-content:center;
                                           color:#44403c; transition:all 0.2s;"
                                    onmouseover="this.style.background='#f5f5f4'"
                                    onmouseout="this.style.background='white'">
                                +
                            </button>

                            {{-- Hidden form to save quantity to DB --}}
                            <form method="POST" action="{{ route('cart.update', $item) }}"
                                  id="form-{{ $item->id }}" style="margin-left:4px;">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="quantity"
                                       id="input-{{ $item->id }}"
                                       value="{{ $item->quantity }}">
                                <button type="submit"
                                        style="font-size:0.72rem; background:#f0fdf4;
                                               color:#15803d; font-weight:600;
                                               padding:0.3rem 0.65rem; border-radius:0.5rem;
                                               border:1px solid #86efac; cursor:pointer;"
                                        onmouseover="this.style.background='#dcfce7'"
                                        onmouseout="this.style.background='#f0fdf4'">
                                    Save
                                </button>
                            </form>
                        </div>

                        {{-- Live Subtotal --}}
                        <div style="text-align:right; flex-shrink:0; min-width:90px;">
                            <p id="subtotal-{{ $item->id }}"
                               style="font-weight:700; color:#1c1917; font-size:0.9rem;">
                                Rs. {{ number_format($item->product->price * $item->quantity, 2) }}
                            </p>
                            <p style="font-size:0.68rem; color:#a8a29e; margin-top:2px;">subtotal</p>
                        </div>

                        {{-- Remove Button --}}
                        <form method="POST" action="{{ route('cart.remove', $item) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    style="color:#f87171; background:none; border:none;
                                           cursor:pointer; transition:color 0.2s;"
                                    onmouseover="this.style.color='#dc2626'"
                                    onmouseout="this.style.color='#f87171'"
                                    title="Remove item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
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
                            <span id="summary-subtotal">Rs. {{ number_format($total, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-stone-600">
                            <span>Delivery</span>
                            <span class="text-green-600 font-medium">Limited Charge</span>
                        </div>
                        <div class="border-t border-stone-100 pt-3 flex justify-between font-bold text-stone-800 text-base">
                            <span>Total</span>
                            <span id="cart-total">Rs. {{ number_format($total, 2) }}</span>
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

<script>
    // Store all item data
    const itemPrices = {
        @foreach($cartItems as $item)
        {{ $item->id }}: {
            price: {{ $item->product->price }},
            qty:   {{ $item->quantity }},
            max:   {{ $item->product->stock }}
        },
        @endforeach
    };

    function changeQty(itemId, delta, price, maxStock) {
        const current = itemPrices[itemId].qty;
        const newQty  = current + delta;

        // Enforce min = 1 and max = stock
        if (newQty < 1 || newQty > maxStock) return;

        // Update stored qty
        itemPrices[itemId].qty = newQty;

        // Update quantity display
        document.getElementById('qty-' + itemId).textContent = newQty;

        // Update hidden form input
        document.getElementById('input-' + itemId).value = newQty;

        // Update item subtotal display
        const itemSubtotal = price * newQty;
        document.getElementById('subtotal-' + itemId).textContent =
            'Rs. ' + formatNum(itemSubtotal);

        // Recalculate and update cart total
        let newTotal = 0;
        for (const id in itemPrices) {
            newTotal += itemPrices[id].price * itemPrices[id].qty;
        }
        document.getElementById('cart-total').textContent    = 'Rs. ' + formatNum(newTotal);
        document.getElementById('summary-subtotal').textContent = 'Rs. ' + formatNum(newTotal);
    }

    function formatNum(num) {
        return num.toLocaleString('en-IN', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }
</script>

@endsection