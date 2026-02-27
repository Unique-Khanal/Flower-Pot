@props(['image', 'name', 'price', 'badge' => null])

<div class="bg-white rounded-2xl shadow hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col group">
    {{-- Image --}}
    <div class="relative overflow-hidden">
        <img src="{{ asset($image) }}"
             alt="{{ $name }}"
             class="w-full h-52 object-cover group-hover:scale-105 transition-transform duration-500">
        @if($badge)
            <span class="absolute top-2 left-2 bg-green-600 text-white text-xs font-bold px-2.5 py-1 rounded-full shadow">
                {{ $badge }}
            </span>
        @endif
        {{-- Overlay on hover --}}
        <div class="absolute inset-0 bg-black/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
    </div>

    {{-- Info --}}
    <div class="p-4 flex flex-col flex-1">
        <h3 class="text-gray-800 font-semibold text-sm mb-2 leading-snug flex-1">{{ $name }}</h3>

        {{-- Price — driven dynamically by admin --}}
        <div class="flex items-baseline gap-1 mb-3">
            <span class="text-xs text-gray-400 font-medium">Rs.</span>
            <span class="text-green-700 font-extrabold text-xl">{{ number_format($price) }}</span>
        </div>

        {{-- Action buttons --}}
        <div class="flex gap-2">
            <button class="flex-1 border-2 border-green-600 text-green-700 hover:bg-green-600 hover:text-white text-xs font-semibold py-2 rounded-xl transition-colors duration-200">
                🛒 Cart
            </button>
            <button class="flex-1 bg-green-700 hover:bg-green-800 text-white text-xs font-semibold py-2 rounded-xl transition-colors duration-200 shadow-sm">
                Buy Now
            </button>
        </div>
    </div>
</div>
