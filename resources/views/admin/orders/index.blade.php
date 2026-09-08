@extends('layouts.admin')
@section('title', 'Orders')

@section('content')
<div class="max-w-7xl mx-auto">
    <h1 class="text-2xl font-extrabold text-[#1B3B2F] mb-6">All Orders</h1>

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

    <div class="bg-white rounded-2xl overflow-hidden" style="border:1px solid #EDE7D6;">
        <table class="w-full text-sm">
            <thead style="background:#F7F3E8;">
                <tr>
                    <th class="text-left px-4 py-3 text-xs font-bold text-[#2F6B4F] uppercase">Order</th>
                    <th class="text-left px-4 py-3 text-xs font-bold text-[#2F6B4F] uppercase">Customer</th>
                    <th class="text-left px-4 py-3 text-xs font-bold text-[#2F6B4F] uppercase">Total</th>
                    <th class="text-left px-4 py-3 text-xs font-bold text-[#2F6B4F] uppercase">Payment</th>
                    <th class="text-left px-4 py-3 text-xs font-bold text-[#2F6B4F] uppercase">Invoice</th>
                    <th class="text-left px-4 py-3 text-xs font-bold text-[#2F6B4F] uppercase">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr style="border-bottom:1px solid #F5F1E4;">
                        <td class="px-4 py-3 font-semibold text-stone-800">#{{ $order->id }}</td>
                        <td class="px-4 py-3 text-stone-600">{{ $order->customer_name }}</td>
                        <td class="px-4 py-3 text-stone-800 font-semibold">Rs. {{ number_format($order->total, 2) }}</td>
                        <td class="px-4 py-3">
                            <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-full
                                {{ $order->payment_status === 'paid' ? 'bg-green-100 text-green-700' :
                                   ($order->payment_status === 'failed' ? 'bg-red-100 text-red-700' : 'bg-amber-100 text-amber-700') }}">
                                {{ $order->payment_method }} · {{ $order->payment_status }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-xs">
                            @if ($order->payment_status === 'paid' && $order->invoice_no)
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.orders.invoice', $order) }}" target="_blank"
                                       class="text-[#2F6B4F] font-semibold underline underline-offset-2">
                                        {{ $order->invoice_no }}
                                    </a>
                                    <a href="{{ route('admin.orders.invoice.download', $order) }}"
                                       class="text-stone-400 hover:text-[#2F6B4F]" title="Download PDF">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                                    </a>
                                </div>
                            @else
                                <span class="text-stone-400">—</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            @if($order->payment_method === 'cod' && $order->payment_status !== 'paid')
                                <form method="POST" action="{{ route('admin.orders.markCodPaid', $order) }}"
                                      onsubmit="return adminConfirm(this, { title: 'Mark order #{{ $order->id }} as paid?', text: 'This confirms cash-on-delivery payment was received and issues an invoice.', icon: 'question', confirmText: 'Mark Paid', confirmColor: '#216B39' });">
                                    @csrf
                                    <button type="submit" class="text-xs bg-[#2F6B4F] text-white font-semibold px-3 py-1.5 rounded-lg">
                                        Mark Paid
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $orders->links() }}</div>
</div>
@endsection