@extends('layouts.app')
@section('title', 'My Orders')
@section('content')

<section class="py-12 px-4 bg-stone-50 min-h-screen">
    <div class="max-w-5xl mx-auto">

        <h1 class="text-3xl font-bold text-stone-800 mb-8">📦 My Orders</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-6">
                {{ session('error') }}
            </div>
        @endif

        @if($orders->isEmpty())
            <div class="bg-white rounded-3xl shadow p-16 text-center">
                <div class="text-6xl mb-4">📦</div>
                <h2 class="text-xl font-bold text-stone-700 mb-2">No orders yet</h2>
                <p class="text-stone-500 mb-6">You haven't placed any orders yet.</p>
                <a href="{{ route('products.index') }}"
                   class="inline-block bg-green-700 hover:bg-green-800 text-white font-bold px-8 py-3 rounded-xl transition">
                    Browse Products
                </a>
            </div>
        @else
            <div class="space-y-6">
                @foreach($orders as $order)
                <div class="bg-white rounded-2xl shadow-sm overflow-hidden">

                    {{-- Order Header --}}
                    <div class="px-6 py-4 border-b border-stone-100 flex flex-wrap justify-between items-center gap-3">
                        <div>
                            <span class="text-xs text-stone-400 font-medium">Order #{{ $order->id }}</span>
                            <p class="text-sm font-bold text-stone-800 mt-0.5">
                                {{ $order->created_at->format('d M Y, h:i A') }}
                            </p>
                        </div>
                        <div class="flex items-center gap-3">
                            {{-- Status Badge --}}
                            @php
                                $colors = [
                                    'pending'   => 'bg-amber-100 text-amber-700',
                                    'confirmed' => 'bg-blue-100 text-blue-700',
                                    'delivered' => 'bg-green-100 text-green-700',
                                    'cancelled' => 'bg-red-100 text-red-700',
                                ];
                            @endphp
                            <span class="text-xs font-bold px-3 py-1 rounded-full uppercase {{ $colors[$order->status] }}">
                                {{ $order->status }}
                            </span>
                            <span class="font-bold text-green-700">Rs. {{ number_format($order->total, 2) }}</span>
                        </div>
                    </div>

                    {{-- Order Items --}}
                    <div class="px-6 py-4">
                        <div class="space-y-3">
                            @foreach($order->items as $item)
                            <div class="flex items-center gap-3">
                                <img src="{{ asset($item->product_image) }}"
                                     alt="{{ $item->product_name }}"
                                     class="w-12 h-12 object-cover rounded-lg flex-shrink-0">
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-stone-800">{{ $item->product_name }}</p>
                                    <p class="text-xs text-stone-400">Qty: {{ $item->quantity }} × Rs. {{ number_format($item->price, 2) }}</p>
                                </div>
                                <p class="font-bold text-stone-700 text-sm">Rs. {{ number_format($item->subtotal, 2) }}</p>
                            </div>
                            @endforeach
                        </div>

                        {{-- Delivery Info --}}
                        <div class="mt-4 pt-4 border-t border-stone-100 grid grid-cols-2 gap-2 text-xs text-stone-500">
                            <div><span class="font-medium">Address:</span> {{ $order->address }}</div>
                            <div><span class="font-medium">Distance:</span> {{ $order->distance_km }} km</div>
                            <div><span class="font-medium">Delivery:</span> Rs. {{ number_format($order->delivery_charge, 2) }}</div>
                            <div><span class="font-medium">Phone:</span> {{ $order->phone_no }}</div>
                        </div>

                        {{-- Cancellation info --}}
                        @if($order->status === 'cancelled')
                            <div class="mt-3 bg-red-50 border border-red-200 rounded-xl p-3 text-xs text-red-600">
                                <strong>Cancelled on:</strong> {{ $order->cancelled_at->format('d M Y, h:i A') }}<br>
                                <strong>Reason:</strong> {{ $order->cancel_reason }}
                            </div>
                        @endif

                        {{-- Cancel Button --}}
                        @if($order->status === 'pending')
                            <div class="mt-4">
                                <button onclick="showCancelModal({{ $order->id }})"
                                        class="text-sm bg-red-50 hover:bg-red-100 text-red-600 font-semibold
                                               px-4 py-2 rounded-xl transition border border-red-200">
                                    ✕ Cancel Order
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

{{-- Cancel Modal --}}
<div id="cancelModal" class="fixed inset-0 z-50 hidden items-center justify-center"
     style="background:rgba(0,0,0,0.5);">
    <div class="bg-white rounded-2xl shadow-xl p-6 max-w-md w-full mx-4">
        <h3 class="text-lg font-bold text-stone-800 mb-2">Cancel Order</h3>
        <p class="text-stone-500 text-sm mb-4">Please tell us why you want to cancel this order.</p>

        <form method="POST" id="cancelForm">
            @csrf
            <textarea name="cancel_reason" rows="4"
                      placeholder="Reason for cancellation (min 10 characters)..."
                      class="w-full border border-stone-300 rounded-xl px-4 py-2.5 text-sm
                             focus:outline-none focus:ring-2 focus:ring-red-400 resize-none mb-4"
                      required minlength="10"></textarea>

            <div class="flex gap-3">
                <button type="button" onclick="closeCancelModal()"
                        class="flex-1 bg-stone-100 hover:bg-stone-200 text-stone-700 font-semibold
                               py-2.5 rounded-xl transition text-sm">
                    Keep Order
                </button>
                <button type="submit"
                        class="flex-1 bg-red-600 hover:bg-red-700 text-white font-semibold
                               py-2.5 rounded-xl transition text-sm">
                    Confirm Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function showCancelModal(orderId) {
        document.getElementById('cancelForm').action = `/orders/${orderId}/cancel`;
        document.getElementById('cancelModal').style.display = 'flex';
    }
    function closeCancelModal() {
        document.getElementById('cancelModal').style.display = 'none';
    }
</script>

@endsection