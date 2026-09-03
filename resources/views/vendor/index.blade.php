@extends('layouts.vendor')
@section('title', 'My Products')

@section('content')
<div class="max-w-6xl mx-auto">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-extrabold text-[#1B3B2F]">My Products</h1>
            <p class="text-sm text-stone-500 mt-1">Products you've listed for sale on Biruwa.</p>
        </div>
        <a href="{{ route('vendor.products.create') }}"
           class="bg-[#1B3B2F] hover:bg-[#12281F] text-white text-sm font-bold px-4 py-2.5 rounded-xl transition">
            + Add Product
        </a>
    </div>

    @if ($products->isEmpty())
        <div class="bg-white rounded-2xl shadow-sm p-16 text-center text-stone-400">
            You haven't listed any products yet.
        </div>
    @else
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach ($products as $product)
                <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                    <div class="aspect-square bg-stone-100">
                        <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <div class="flex items-start justify-between gap-2">
                            <h3 class="font-bold text-stone-800 text-sm leading-tight">{{ $product->name }}</h3>
                            @if ($product->is_hidden && ! $product->hidden_reason)
                                <span class="text-[9px] font-bold uppercase px-2 py-0.5 rounded-full bg-amber-100 text-amber-700 whitespace-nowrap">Pending review</span>
                            @elseif ($product->is_hidden && $product->hidden_reason)
                                <span class="text-[9px] font-bold uppercase px-2 py-0.5 rounded-full bg-red-100 text-red-700 whitespace-nowrap">Hidden by admin</span>
                            @else
                                <span class="text-[9px] font-bold uppercase px-2 py-0.5 rounded-full bg-green-100 text-green-700 whitespace-nowrap">Live</span>
                            @endif
                        </div>
                        <p class="text-xs text-stone-400 mt-0.5 capitalize">{{ $product->category }}@if($product->size) — {{ $product->size }}@endif</p>
                        <p class="text-lg font-extrabold text-[#1B3B2F] mt-2">Rs. {{ number_format($product->price, 2) }}</p>
                        <p class="text-xs text-stone-500">{{ $product->stock }} in stock</p>

                        @if ($product->hidden_reason)
                            <div class="mt-2 bg-red-50 border border-red-100 text-red-600 text-xs rounded-lg p-2">
                                {{ $product->hidden_reason }}
                            </div>
                        @endif

                        <div class="flex items-center gap-2 mt-4 pt-3 border-t border-stone-100">
                            <a href="{{ route('vendor.products.edit', $product) }}"
                               class="flex-1 text-center bg-stone-100 hover:bg-stone-200 text-stone-700 text-xs font-bold py-2 rounded-lg">
                                Edit
                            </a>
                            <form action="{{ route('vendor.products.destroy', $product) }}" method="POST" class="flex-1"
                                  onsubmit="return adminConfirm(this, { title: 'Delete {{ addslashes($product->name) }}?', text: 'This cannot be undone.', icon: 'warning', confirmText: 'Delete', confirmColor: '#dc2626' });">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full bg-red-50 hover:bg-red-100 text-red-600 text-xs font-bold py-2 rounded-lg">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection