@extends('layouts.admin')
@section('title', 'Orders')

@section('content')
<div class="max-w-7xl mx-auto">

    <div class="flex items-center justify-between mb-6 flex-wrap gap-3">
        <div>
            <h1 class="text-2xl font-extrabold text-[#1B3B2F]">Orders</h1>
            <p class="text-sm text-stone-500 mt-1">Every order placed on the storefront.</p>
        </div>
        <form method="GET" class="flex gap-2">
            <input type="hidden" name="status" value="{{ $status }}">
            <input type="text" name="search" value="{{ $search }}" placeholder="Order #, invoice #, name, phone, email..."
                   class="text-sm rounded-lg border-stone-300 focus:border-[#2F6B4F] focus:ring-[#2F6B4F] w-72">
            <button type="submit" class="bg-stone-100 hover:bg-stone-200 text-stone-600 text-sm font-bold px-4 rounded-lg">Search</button>
        </form>
    </div>

    @if (session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 text-sm rounded-xl p-4 mb-6">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-50 border border-red-200 text-red-700 text-sm rounded-xl p-4 mb-6">
            {{ session('error') }}
        </div>
    @endif

    {{-- ── STAT ROW ── --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <div class="stat-card bg-white rounded-2xl shadow-sm p-5">
            <div class="w-11 h-11 rounded-full bg-green-100 flex items-center justify-center text-xl mb-3">💰</div>
            <div class="text-xs text-stone-400 mb-1">Total Revenue</div>
            <div class="text-xl font-extrabold text-[#1B3B2F]">Rs. {{ number_format($totalRevenue, 0) }}</div>
        </div>
        <div class="stat-card bg-white rounded-2xl shadow-sm p-5">
            <div class="w-11 h-11 rounded-full bg-blue-100 flex items-center justify-center text-xl mb-3">🧾</div>
            <div class="text-xs text-stone-400 mb-1">Total Orders</div>
            <div class="text-xl font-extrabold text-[#1B3B2F]">{{ $counts['all'] }}</div>
        </div>
        <a href="{{ route('admin.orders.index', ['status' => 'cod_pending']) }}" class="stat-card bg-white rounded-2xl shadow-sm p-5 block">
            <div class="w-11 h-11 rounded-full bg-amber-100 flex items-center justify-center text-xl mb-3">⏳</div>
            <div class="text-xs text-stone-400 mb-1">COD Awaiting Payment</div>
            <div class="text-xl font-extrabold text-[#1B3B2F]">{{ $counts['cod_pending'] }}</div>
        </a>
        <a href="{{ route('admin.orders.index', ['status' => 'refunded']) }}" class="stat-card bg-white rounded-2xl shadow-sm p-5 block">
            <div class="w-11 h-11 rounded-full bg-purple-100 flex items-center justify-center text-xl mb-3">↩️</div>
            <div class="text-xs text-stone-400 mb-1">Refunded</div>
            <div class="text-xl font-extrabold text-[#1B3B2F]">{{ $counts['refunded'] }}</div>
        </a>
    </div>

    {{-- ── FILTER TABS ── --}}
    <div class="flex gap-2 text-sm mb-6 flex-wrap">
        @foreach (['all' => 'All', 'pending' => 'Pending', 'confirmed' => 'Confirmed', 'delivered' => 'Delivered', 'cancelled' => 'Cancelled', 'refunded' => 'Refunded'] as $key => $label)
            <a href="{{ route('admin.orders.index', ['status' => $key, 'search' => $search]) }}"
               class="px-3 py-1.5 rounded-lg font-semibold
                      {{ $status === $key ? 'bg-[#1B3B2F] text-white' : 'bg-stone-100 text-stone-600 hover:bg-stone-200' }}">
                {{ $label }}
                @if ($counts[$key] > 0)
                    <span class="ml-1 {{ $status === $key ? 'bg-white/25' : 'bg-stone-400 text-white' }} text-[10px] px-1.5 py-0.5 rounded-full">{{ $counts[$key] }}</span>
                @endif
            </a>
        @endforeach
    </div>

    {{-- ── TABLE ── --}}
    <div class="bg-white rounded-2xl shadow-sm overflow-x-auto">
        <table class="w-full text-sm min-w-[1080px]">
            <thead>
                <tr class="border-b border-stone-100 text-left text-xs uppercase tracking-wide text-stone-400">
                    <th class="px-5 py-3 font-bold">Order</th>
                    <th class="px-5 py-3 font-bold">Customer</th>
                    <th class="px-5 py-3 font-bold">Product(s)</th>
                    <th class="px-5 py-3 font-bold">Total</th>
                    <th class="px-5 py-3 font-bold">Order Status</th>
                    <th class="px-5 py-3 font-bold">Payment</th>
                    <th class="px-5 py-3 font-bold">Invoice</th>
                    <th class="px-5 py-3 font-bold text-right">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr class="border-b border-stone-50 last:border-0 hover:bg-stone-50/60">
                        <td class="px-5 py-4">
                            <div class="font-semibold text-stone-800">#{{ $order->id }}</div>
                            <div class="text-xs text-stone-400">{{ $order->created_at->format('M j, Y') }}</div>
                        </td>
                        <td class="px-5 py-4">
                            <div class="text-stone-700">{{ $order->customer_name }}</div>
                            <div class="text-xs text-stone-400">{{ $order->phone_no ?: $order->email }}</div>
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-2">
                                @foreach ($order->items->take(3) as $item)
                                    <img src="{{ asset($item->product_image) }}" alt="{{ $item->product_name }}"
                                         title="{{ $item->product_name }} × {{ $item->quantity }}"
                                         class="w-9 h-9 rounded-lg object-cover bg-stone-100 border border-stone-100">
                                @endforeach
                                <div class="min-w-0">
                                    <div class="text-stone-700 text-xs leading-tight truncate max-w-[160px]">
                                        {{ $order->items->pluck('product_name')->implode(', ') }}
                                    </div>
                                    @if ($order->items->count() > 3)
                                        <div class="text-[10px] text-stone-400">+{{ $order->items->count() - 3 }} more</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-4 font-semibold text-stone-800">Rs. {{ number_format($order->total, 2) }}</td>
                        <td class="px-5 py-4">
                            <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-full
                                {{ match($order->status) {
                                    'delivered' => 'bg-green-100 text-green-700',
                                    'confirmed' => 'bg-blue-100 text-blue-700',
                                    'cancelled' => 'bg-red-100 text-red-700',
                                    default     => 'bg-amber-100 text-amber-700',
                                } }}">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-full
                                {{ match($order->payment_status) {
                                    'paid'     => 'bg-green-100 text-green-700',
                                    'refunded' => 'bg-purple-100 text-purple-700',
                                    'failed'   => 'bg-red-100 text-red-700',
                                    default    => 'bg-amber-100 text-amber-700',
                                } }}">
                                {{ $order->payment_method }} · {{ $order->payment_status }}
                            </span>
                        </td>
                        <td class="px-5 py-4 text-xs">
                            @if ($order->payment_status === 'paid' && $order->invoice_no)
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.orders.invoice', $order) }}" target="_blank"
                                       class="text-[#2F6B4F] font-semibold hover:underline underline-offset-2">
                                        {{ $order->invoice_no }}
                                    </a>
                                    <a href="{{ route('admin.orders.invoice.download', $order) }}"
                                       class="text-stone-400 hover:text-[#2F6B4F]" title="Download PDF">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                                    </a>
                                </div>
                            @else
                                <span class="text-stone-300">—</span>
                            @endif
                        </td>
                        <td class="px-5 py-4 text-right whitespace-nowrap">
                            @if ($order->status === 'pending')
                                <form method="POST" action="{{ route('admin.orders.confirm', $order) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="text-xs bg-[#3E9C6F] hover:bg-[#34875F] text-white font-bold px-3 py-1.5 rounded-lg">
                                        Confirm
                                    </button>
                                </form>
                                <button type="button"
                                        onclick="document.getElementById('cancel-form-{{ $order->id }}').classList.toggle('hidden')"
                                        class="text-xs bg-red-50 hover:bg-red-100 text-red-600 font-bold px-3 py-1.5 rounded-lg ml-1">
                                    Cancel
                                </button>
                                <form id="cancel-form-{{ $order->id }}" method="POST" action="{{ route('admin.orders.cancel', $order) }}" class="hidden mt-2 text-left">
                                    @csrf
                                    <textarea name="cancel_reason" rows="2" required placeholder="Reason for cancellation..."
                                              class="w-full text-xs rounded-lg border-stone-300 focus:border-red-500 focus:ring-red-500"></textarea>
                                    <button type="submit" class="mt-1.5 w-full bg-red-600 hover:bg-red-700 text-white text-xs font-bold py-1.5 rounded-lg">
                                        Confirm Cancellation
                                    </button>
                                </form>
                            @elseif ($order->status === 'confirmed')
                                <form method="POST" action="{{ route('admin.orders.deliver', $order) }}"
                                      onsubmit="return adminConfirm(this, {
                                          title: 'Mark order #{{ $order->id }} as delivered?',
                                          text: '{{ $order->payment_method === "cod"
                                                ? "This confirms cash was collected and will generate + email the invoice to the customer."
                                                : "This marks the order delivered." }}',
                                          icon: 'question', confirmText: 'Mark Delivered', confirmColor: '#216B39'
                                      });">
                                    @csrf
                                    <button type="submit" class="text-xs bg-[#2F6B4F] hover:bg-[#245A41] text-white font-bold px-3 py-1.5 rounded-lg">
                                        Mark Delivered
                                    </button>
                                </form>
                            @else
                                <span class="text-stone-300 text-xs">—</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-stone-400 py-16">No orders {{ $status !== 'all' ? "matching \"$status\"" : '' }} found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5">{{ $orders->links() }}</div>
</div>
@endsection