@props(['image', 'name', 'price' => null, 'badge' => null, 'productId' => null, 'vendorName' => null])

<div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col group">

    {{-- Image --}}
    <div class="relative overflow-hidden aspect-square">
        <img src="{{ asset($image) }}"
             alt="{{ $name }}"
             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent
                    opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

        @if($badge)
            <span class="absolute top-2.5 left-2.5 bg-green-600 text-white text-[10px] font-bold
                         px-2 py-0.5 rounded-full shadow tracking-wide uppercase">
                {{ $badge }}
            </span>
        @endif
    </div>

    {{-- Info --}}
    <div class="px-3 py-2.5 flex flex-col gap-1.5">
        <h3 class="text-stone-700 font-semibold text-xs leading-snug line-clamp-2 text-center">
            {{ $name }}
        </h3>

        @if($price)
            <p class="text-green-700 font-bold text-sm text-center">Rs. {{ number_format($price, 2) }}</p>
        @endif

        {{-- Vendor attribution --}}
        <p class="text-stone-400 text-[10px] text-center -mt-0.5">
            Sold by {{ $vendorName ?? 'Biruwa' }}
        </p>

        @if($productId)
            <a href="{{ route('products.show', $productId) }}"
               class="mt-1 bg-green-700 hover:bg-green-800 text-white text-xs font-bold
                      py-1.5 rounded-lg text-center transition">
                View Details
            </a>
        @endif
    </div>
</div>