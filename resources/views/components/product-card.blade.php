@props(['image', 'name', 'price', 'badge' => null])

<div x-data="{ added: false, item: {{ Illuminate\Support\Js::from(['name' => $name, 'price' => (float)$price, 'image' => asset($image)]) }} }"
     class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col group cursor-pointer">

    {{-- Image --}}
    <div class="relative overflow-hidden">
        <img src="{{ asset($image) }}"
             alt="{{ $name }}"
             class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-500">

        {{-- Gradient overlay on hover --}}
        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

        {{-- Badge --}}
        @if($badge)
            <span class="absolute top-3 left-3 bg-green-600 text-white text-xs font-bold px-2.5 py-1 rounded-full shadow-md tracking-wide">
                {{ $badge }}
            </span>
        @endif
    </div>

    {{-- Info --}}
    <div class="p-4 flex flex-col flex-1">
        {{-- Name --}}
        <h3 class="text-gray-800 font-semibold text-sm mb-3 leading-snug flex-1 line-clamp-2">{{ $name }}</h3>

        {{-- Price --}}
        <div class="flex items-baseline gap-1 mb-4">
            <span class="text-gray-400 text-xs font-medium">Rs.</span>
            <span class="text-green-700 font-extrabold text-2xl leading-none">{{ number_format($price) }}</span>
        </div>

        {{-- Buttons --}}
        <div class="flex gap-2">
            <button
                @click="$store.cart.add(item); added = true; setTimeout(() => added = false, 1500)"
                class="flex-1 text-xs font-bold py-2.5 rounded-xl border-2 transition-all duration-200"
                :class="added
                    ? 'border-green-500 bg-green-500 text-white scale-95'
                    : 'border-green-600 text-green-700 hover:bg-green-600 hover:text-white hover:scale-95'">
                <span x-show="!added">🛒 Add to Cart</span>
                <span x-show="added" x-cloak>✓ Added!</span>
            </button>
            <button
                @click="$store.cart.add(item); $dispatch('open-cart')"
                class="flex-1 bg-green-700 hover:bg-green-800 active:scale-95 text-white text-xs font-bold py-2.5 rounded-xl transition-all duration-200 shadow-sm">
                Buy Now
            </button>
        </div>
    </div>
</div>

