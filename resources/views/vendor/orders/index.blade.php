@extends('layouts.vendor')
@section('title', 'My Orders')

@section('content')
<div class="max-w-6xl mx-auto">

    <div class="mb-6">
        <h1 class="text-2xl font-extrabold text-[#1B3B2F]">My Orders</h1>
        <p class="text-sm text-stone-500 mt-1">Every customer purchase of your products, tracked per item.</p>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-5 text-sm">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="bg-red-50 border border-red-300 text-red-700 px-4 py-3 rounded-xl mb-5 text-sm">{{ session('error') }}</div>
    @endif

    <div class="flex gap-2 text-sm mb-6 flex-wrap">
        @foreach (['all' => 'All', 'pending' => 'Pending', 'processing' => 'Processing', 'shipped' => 'Shipped', 'delivered' => 'Delivered', 'cancelled' => 'Cancelled'] as $key => $label)
            <a href="{{ route('vendor.orders.index', ['status' => $key]) }}"
               class="px-3 py-1.5 rounded-lg font-semibold
                      {{ $status === $key ? 'bg-green-700 text-white' : 'bg-stone-100 text-stone-600 hover:bg-stone-200' }}">
                {{ $label }}
                @if ($counts[$key] > 0)
                    <span class="ml-1 {{ $status === $key ? 'bg-white/25' : 'bg-stone-400 text-white' }} text-[10px] px-1.5 py-0.5 rounded-full">{{ $counts[$key] }}</span>
                @endif
            </a>
        @endforeach
    </div>

    @if ($items->isEmpty())
        <div class="bg-white rounded-2xl shadow-sm p-16 text-center text-stone-400">
            No {{ $status === 'all' ? '' : $status . ' ' }}orders yet.
        </div>
    @else
        <div class="space-y-4">
            @foreach ($items as $item)
                @php
                    $step = $item->trackingStep($item->order);
                    $steps = [1 => 'Placed', 2 => 'Confirmed', 3 => 'Preparing', 4 => 'Shipped', 5 => 'Delivered'];
                @endphp
                <div class="bg-white rounded-2xl shadow-sm p-5">
                    <div class="flex flex-wrap items-start justify-between gap-3 mb-4">
                        <div class="flex items-center gap-3">
                            <img src="{{ asset($item->product_image) }}" class="w-14 h-14 rounded-xl object-cover bg-stone-100">
                            <div>
                                <p class="font-bold text-stone-800">{{ $item->product_name }}</p>
                                <p class="text-xs text-stone-400">Order #{{ $item->order_id }} · Qty {{ $item->quantity }} · Rs. {{ number_format($item->subtotal, 2) }}</p>
                                <p class="text-xs text-stone-400">Placed {{ $item->created_at->format('d M Y, h:i A') }}</p>
                            </div>
                        </div>

                        @if ($step === 0)
                            <span class="text-xs font-bold bg-red-50 text-red-600 px-3 py-1.5 rounded-full uppercase">Cancelled</span>
                        @else
                            <span class="text-xs font-bold bg-stone-100 text-stone-600 px-3 py-1.5 rounded-full uppercase">{{ $steps[$step] }}</span>
                        @endif
                    </div>

                    {{-- Tracker --}}
                    @if ($step > 0)
                        <div class="flex items-center mb-4">
                            @foreach ($steps as $n => $label)
                                <div class="flex items-center flex-1 last:flex-none">
                                    <div class="flex flex-col items-center">
                                        <div class="w-6 h-6 rounded-full flex items-center justify-center text-[10px] font-bold
                                                    {{ $n <= $step ? 'bg-green-700 text-white' : 'bg-stone-200 text-stone-400' }}">
                                            {{ $n <= $step ? '✓' : $n }}
                                        </div>
                                        <span class="text-[10px] mt-1 {{ $n <= $step ? 'text-green-700 font-semibold' : 'text-stone-400' }}">{{ $label }}</span>
                                    </div>
                                    @if ($n < 5)
                                        <div class="flex-1 h-0.5 mx-1 {{ $n < $step ? 'bg-green-700' : 'bg-stone-200' }}"></div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif

                    {{-- Vendor action --}}
                    @if ($item->order->status === 'pending')
                        <p class="text-xs text-amber-600 bg-amber-50 border border-amber-100 rounded-lg px-3 py-2">
                            Waiting for admin to confirm this order before you can prepare it.
                        </p>
                    @elseif ($item->vendor_status === 'pending' && $item->order->status !== 'cancelled')
                        <form action="{{ route('vendor.orders.status', $item) }}" method="POST">
                            @csrf
                            <input type="hidden" name="status" value="processing">
                            <button class="bg-[#1B3B2F] hover:bg-[#12281F] text-white text-xs font-bold px-4 py-2 rounded-lg">
                                Start Preparing
                            </button>
                        </form>
                    @elseif ($item->vendor_status === 'processing')
                        <form action="{{ route('vendor.orders.status', $item) }}" method="POST">
                            @csrf
                            <input type="hidden" name="status" value="shipped">
                            <button class="bg-[#1B3B2F] hover:bg-[#12281F] text-white text-xs font-bold px-4 py-2 rounded-lg">
                                Mark Shipped
                            </button>
                        </form>
                    @elseif ($item->vendor_status === 'shipped')
                        <p class="text-xs text-blue-600 bg-blue-50 border border-blue-100 rounded-lg px-3 py-2">
                            Shipped — delivery will be confirmed by the admin.
                        </p>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="mt-8">{{ $items->links() }}</div>
    @endif
</div>
@endsection