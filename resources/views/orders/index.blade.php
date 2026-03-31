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

                {{-- Card --}}
                <div id="order-{{ $order->id }}"
                     style="position:relative; border-radius:1rem; overflow:hidden;
                            box-shadow:0 1px 4px rgba(0,0,0,0.08);
                            {{ $order->status === 'cancelled' ? 'background:#fef2f2; border-left:4px solid #ef4444;' : 'background:white;' }}">

                    {{-- Cross dismiss button — cancelled only --}}
                    @if($order->status === 'cancelled')
                        <button onclick="dismissOrder('order-{{ $order->id }}')"
                                title="Dismiss"
                                onmouseover="this.style.background='#dc2626'"
                                onmouseout="this.style.background='#ef4444'"
                                style="position:absolute; top:10px; right:10px; z-index:50;
                                       width:26px; height:26px; background:#ef4444;
                                       border-radius:50%; border:none; cursor:pointer;
                                       display:flex; align-items:center; justify-content:center;
                                       box-shadow:0 2px 6px rgba(0,0,0,0.2);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                 fill="none" viewBox="0 0 24 24"
                                 stroke="white" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    @endif

                    {{-- Order Header --}}
                    <div style="padding:1rem 1.5rem; padding-right:2.5rem;
                                border-bottom:1px solid #f5f5f4;
                                display:flex; flex-wrap:wrap;
                                justify-content:space-between;
                                align-items:center; gap:0.75rem;">
                        <div>
                            <span style="font-size:0.75rem; color:#a8a29e; font-weight:500;">
                                Order #{{ $order->id }}
                            </span>
                            <p style="font-size:0.875rem; font-weight:700; color:#1c1917; margin-top:2px;">
                                {{ $order->created_at->format('d M Y, h:i A') }}
                            </p>
                        </div>
                        <div style="display:flex; align-items:center; gap:0.75rem;">
                            @php
                                $badgeStyles = [
                                    'pending'   => 'background:#fef3c7; color:#b45309;',
                                    'confirmed' => 'background:#dbeafe; color:#1d4ed8;',
                                    'delivered' => 'background:#dcfce7; color:#15803d;',
                                    'cancelled' => 'background:#fee2e2; color:#b91c1c;',
                                ];
                            @endphp
                            <span style="font-size:0.7rem; font-weight:700; padding:0.25rem 0.75rem;
                                         border-radius:999px; text-transform:uppercase;
                                         {{ $badgeStyles[$order->status] }}">
                                {{ $order->status }}
                            </span>
                            <span style="font-weight:700; color:#15803d;">
                                Rs. {{ number_format($order->total, 2) }}
                            </span>
                        </div>
                    </div>

                    {{-- Order Items --}}
                    <div style="padding:1rem 1.5rem;">
                        <div style="display:flex; flex-direction:column; gap:0.75rem;">
                            @foreach($order->items as $item)
                            <div style="display:flex; align-items:center; gap:0.75rem;">
                                <img src="{{ asset($item->product_image) }}"
                                     alt="{{ $item->product_name }}"
                                     style="width:48px; height:48px; object-fit:cover;
                                            border-radius:0.5rem; flex-shrink:0;">
                                <div style="flex:1;">
                                    <p style="font-size:0.875rem; font-weight:600; color:#1c1917;">
                                        {{ $item->product_name }}
                                    </p>
                                    <p style="font-size:0.75rem; color:#a8a29e;">
                                        Qty: {{ $item->quantity }} × Rs. {{ number_format($item->price, 2) }}
                                    </p>
                                </div>
                                <p style="font-weight:700; color:#44403c; font-size:0.875rem;">
                                    Rs. {{ number_format($item->subtotal, 2) }}
                                </p>
                            </div>
                            @endforeach
                        </div>

                        {{-- Delivery Info --}}
                        <div style="margin-top:1rem; padding-top:1rem;
                                    border-top:1px solid #f5f5f4;
                                    display:grid; grid-template-columns:1fr 1fr;
                                    gap:0.5rem; font-size:0.75rem; color:#78716c;">
                            <div><strong>Address:</strong> {{ $order->address }}</div>
                            <div><strong>Distance:</strong> {{ $order->distance_km }} km</div>
                            <div><strong>Delivery:</strong> Rs. {{ number_format($order->delivery_charge, 2) }}</div>
                            <div><strong>Phone:</strong> {{ $order->phone_no }}</div>
                        </div>

                        {{-- Cancellation Info --}}
                        @if($order->status === 'cancelled')
                            <div style="margin-top:0.75rem; background:#fef2f2;
                                        border:1px solid #fecaca; border-radius:0.75rem;
                                        padding:0.75rem; font-size:0.75rem; color:#b91c1c;">
                                <strong>Cancelled on:</strong>
                                {{ $order->cancelled_at->format('d M Y, h:i A') }}<br>
                                <strong>Reason:</strong> {{ $order->cancel_reason }}
                            </div>
                        @endif

                        {{-- Cancel Button — pending only --}}
                        @if($order->status === 'pending')
                            <div style="margin-top:1rem;">
                                <button onclick="showCancelModal({{ $order->id }})"
                                        style="font-size:0.875rem; background:#fef2f2;
                                               color:#dc2626; font-weight:600;
                                               padding:0.5rem 1rem; border-radius:0.75rem;
                                               border:1px solid #fecaca; cursor:pointer;
                                               transition:background 0.2s;"
                                        onmouseover="this.style.background='#fee2e2'"
                                        onmouseout="this.style.background='#fef2f2'">
                                    ✕ Cancel Order
                                </button>
                            </div>
                        @endif
                    </div>

                </div>
                {{-- Card ends --}}

                @endforeach
            </div>
        @endif
    </div>
</section>

{{-- Cancel Modal --}}
<div id="cancelModal"
     style="display:none; position:fixed; inset:0; z-index:50;
            background:rgba(0,0,0,0.5);
            align-items:center; justify-content:center;">
    <div style="background:white; border-radius:1rem;
                box-shadow:0 20px 60px rgba(0,0,0,0.15);
                padding:1.5rem; max-width:28rem; width:100%; margin:0 1rem;">

        <h3 style="font-size:1.1rem; font-weight:700; color:#1c1917; margin-bottom:0.5rem;">
            Cancel Order
        </h3>
        <p style="color:#78716c; font-size:0.875rem; margin-bottom:1rem;">
            Please tell us why you want to cancel this order.
        </p>

        <form method="POST" id="cancelForm">
            @csrf
            <textarea name="cancel_reason" rows="4"
                      placeholder="Reason for cancellation (min 10 characters)..."
                      style="width:100%; border:1px solid #d6d3d1; border-radius:0.75rem;
                             padding:0.75rem 1rem; font-size:0.875rem;
                             font-family:inherit; resize:none; outline:none;
                             margin-bottom:1rem; box-sizing:border-box;"
                      onfocus="this.style.borderColor='#15803d';this.style.boxShadow='0 0 0 3px rgba(21,128,61,0.1)'"
                      onblur="this.style.borderColor='#d6d3d1';this.style.boxShadow='none'"
                      required minlength="10"></textarea>

            <div style="display:flex; gap:0.75rem;">
                <button type="button" onclick="closeCancelModal()"
                        style="flex:1; background:#f5f5f4; color:#44403c;
                               font-weight:600; padding:0.75rem;
                               border-radius:0.75rem; border:none;
                               cursor:pointer; font-size:0.875rem;"
                        onmouseover="this.style.background='#e7e5e0'"
                        onmouseout="this.style.background='#f5f5f4'">
                    Keep Order
                </button>
                <button type="submit"
                        style="flex:1; background:#dc2626; color:white;
                               font-weight:600; padding:0.75rem;
                               border-radius:0.75rem; border:none;
                               cursor:pointer; font-size:0.875rem;"
                        onmouseover="this.style.background='#b91c1c'"
                        onmouseout="this.style.background='#dc2626'">
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

    function dismissOrder(cardId) {
        const card = document.getElementById(cardId);
        card.style.transition = 'all 0.4s ease';
        card.style.opacity = '0';
        card.style.transform = 'translateX(40px)';
        setTimeout(() => card.remove(), 400);
    }
</script>

@endsection