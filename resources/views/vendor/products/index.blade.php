@extends('layouts.vendor')
@section('title', 'My Products')

@section('content')
<div class="max-w-6xl mx-auto">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-extrabold text-[#1B3B2F]">My Products</h1>
            <p class="text-sm text-stone-500 mt-1">Manage your listings — new or edited items are re-reviewed by admin before going live.</p>
        </div>
        <a href="{{ route('vendor.products.create') }}"
           class="bg-[#1B3B2F] hover:bg-[#12281F] text-white text-sm font-bold px-4 py-2.5 rounded-xl whitespace-nowrap">
            + Add Product
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 text-sm rounded-xl p-4 mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if ($products->isEmpty())
        <div class="bg-white rounded-2xl shadow-sm p-16 text-center text-stone-400">
            You haven't listed any products yet.
            <a href="{{ route('vendor.products.create') }}" class="text-[#2F6B4F] font-semibold underline">Add your first one</a>.
        </div>
    @else
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach ($products as $product)
                <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                    <div class="aspect-square bg-stone-100 relative">
                        <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover">

                        <span class="absolute top-2 left-2 text-[10px] font-bold uppercase px-2 py-0.5 rounded-full
                            {{ match(true) {
                                ! $product->is_hidden => 'bg-green-100 text-green-700',
                                $product->is_hidden && $product->hidden_reason => 'bg-red-100 text-red-600',
                                default => 'bg-amber-100 text-amber-700',
                            } }}">
                            {{ match(true) {
                                ! $product->is_hidden => 'Live',
                                $product->is_hidden && $product->hidden_reason => 'Hidden',
                                default => 'Pending Review',
                            } }}
                        </span>
                    </div>

                    <div class="p-4">
                        <h3 class="font-bold text-stone-800 text-sm leading-tight">{{ $product->name }}</h3>
                        <p class="text-xs text-stone-400 capitalize">{{ $product->category }}@if($product->size) — {{ $product->size }}@endif</p>
                        <p class="text-lg font-extrabold text-[#1B3B2F] mt-2">Rs. {{ number_format($product->price, 2) }}</p>
                        <p class="text-xs {{ $product->stock <= 5 ? 'text-red-500 font-semibold' : 'text-stone-500' }}">
                            {{ $product->stock }} in stock
                        </p>

                        @if ($product->is_hidden && $product->hidden_reason)
                            <div class="bg-red-50 border border-red-100 text-red-600 text-xs rounded-lg p-2 mt-2">
                                {{ $product->hidden_reason }}
                            </div>
                        @endif

                        <div class="flex items-center gap-2 mt-4 pt-3 border-t border-stone-100">
                            <a href="{{ route('vendor.products.edit', $product) }}"
                               class="flex-1 text-center bg-stone-100 hover:bg-stone-200 text-stone-700 text-xs font-bold py-2 rounded-lg">
                                Edit
                            </a>
                            <form action="{{ route('vendor.products.destroy', $product) }}" method="POST" class="flex-1"
                                  onsubmit="return confirm('Remove this product? This can\'t be undone.');">
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