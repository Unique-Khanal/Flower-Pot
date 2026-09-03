@extends('layouts.admin')
@section('title', 'Billing')

@section('content')
<div class="max-w-2xl mx-auto">

    <div class="mb-6">
        <h1 class="text-2xl font-extrabold text-[#1B3B2F]">Record a Sale</h1>
        <p class="text-sm text-stone-500 mt-1">Bill a vendor's product — saved to both your records and the vendor's account.</p>
    </div>

    <form action="{{ route('admin.billing.store') }}" method="POST" class="bg-white rounded-2xl shadow-sm p-6 space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-semibold text-stone-700 mb-1">Product</label>
            <select name="product_id" id="product_id" required onchange="updatePreview()"
                    class="w-full rounded-xl border-stone-300 focus:border-[#2F6B4F] focus:ring-[#2F6B4F]">
                <option value="">Select a product...</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}"
                            data-price="{{ $product->price }}"
                            data-stock="{{ $product->stock }}"
                            data-vendor="{{ $product->vendor->business_name }}"
                            {{ old('product_id') == $product->id ? 'selected' : '' }}>
                        {{ $product->name }} — Rs. {{ number_format($product->price, 2) }} ({{ $product->vendor->business_name }}) — {{ $product->stock }} in stock
                    </option>
                @endforeach
            </select>
            @error('product_id') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            @if ($products->isEmpty())
                <p class="text-xs text-amber-600 mt-1">No live, in-stock vendor products available to bill right now.</p>
            @endif
        </div>

        <div>
            <label class="block text-sm font-semibold text-stone-700 mb-1">Quantity</label>
            <input type="number" name="quantity" id="quantity" min="1" value="{{ old('quantity', 1) }}" required
                   oninput="updatePreview()"
                   class="w-full rounded-xl border-stone-300 focus:border-[#2F6B4F] focus:ring-[#2F6B4F]">
            @error('quantity') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div id="preview" class="hidden bg-stone-50 rounded-xl p-4 text-sm">
            <div class="flex justify-between text-stone-500"><span>Unit price</span><span id="preview-price">—</span></div>
            <div class="flex justify-between font-bold text-[#1B3B2F] mt-1"><span>Total</span><span id="preview-total">—</span></div>
        </div>

        <hr class="border-stone-100">

        <div>
            <label class="block text-sm font-semibold text-stone-700 mb-1">Buyer name</label>
            <input type="text" name="customer_name" value="{{ old('customer_name') }}" required
                   class="w-full rounded-xl border-stone-300 focus:border-[#2F6B4F] focus:ring-[#2F6B4F]">
            @error('customer_name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-stone-700 mb-1">Phone <span class="text-stone-400 font-normal">(optional)</span></label>
                <input type="text" name="phone_no" value="{{ old('phone_no') }}"
                       class="w-full rounded-xl border-stone-300 focus:border-[#2F6B4F] focus:ring-[#2F6B4F]">
            </div>
            <div>
                <label class="block text-sm font-semibold text-stone-700 mb-1">Email <span class="text-stone-400 font-normal">(optional)</span></label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="w-full rounded-xl border-stone-300 focus:border-[#2F6B4F] focus:ring-[#2F6B4F]">
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-stone-700 mb-1">Notes <span class="text-stone-400 font-normal">(optional)</span></label>
            <input type="text" name="address" value="{{ old('address') }}" placeholder="e.g. walk-in purchase, delivery address..."
                   class="w-full rounded-xl border-stone-300 focus:border-[#2F6B4F] focus:ring-[#2F6B4F]">
        </div>

        <button type="submit" class="bg-[#1B3B2F] hover:bg-[#12281F] text-white text-sm font-bold px-5 py-2.5 rounded-xl">
            Record Sale
        </button>
    </form>
</div>

<script>
    function updatePreview() {
        const select = document.getElementById('product_id');
        const opt = select.options[select.selectedIndex];
        const qty = parseInt(document.getElementById('quantity').value || '0', 10);
        const preview = document.getElementById('preview');

        if (!opt || !opt.value || qty < 1) { preview.classList.add('hidden'); return; }

        const price = parseFloat(opt.dataset.price);
        const stock = parseInt(opt.dataset.stock, 10);

        document.getElementById('preview-price').textContent = 'Rs. ' + price.toFixed(2);
        document.getElementById('preview-total').textContent = 'Rs. ' + (price * qty).toFixed(2) + (qty > stock ? '  ⚠ exceeds stock (' + stock + ')' : '');
        preview.classList.remove('hidden');
    }
</script>
@endsection