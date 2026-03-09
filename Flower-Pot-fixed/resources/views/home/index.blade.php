@extends('layouts.app')

@section('title', 'Home')

@section('content')

{{-- ============================================================
     HERO — full-height image with left-aligned text overlay
============================================================ --}}
<section class="relative min-h-[85vh] flex items-center overflow-hidden">
    <div class="absolute inset-0">
        <img src="{{ asset('images/Plants/Boston_Fern.webp') }}"
             alt="Hero background"
             class="w-full h-full object-cover object-center">
        <div class="absolute inset-0 bg-gradient-to-r from-green-950/90 via-green-900/70 to-transparent"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 w-full">
        <div class="max-w-xl">
            <span class="inline-block bg-amber-400/20 border border-amber-400/40 text-amber-300
                         text-xs font-semibold uppercase tracking-widest px-4 py-1.5 rounded-full mb-6">
                🌿 Welcome to FlowerPot
            </span>
            <h1 class="brand-font text-5xl sm:text-6xl lg:text-7xl font-bold text-white leading-tight mb-6">
                Bring <span class="text-amber-400">Nature</span><br>Into Your Home
            </h1>
            <p class="text-green-100 text-lg leading-relaxed mb-10 max-w-md">
                Discover our handpicked collection of beautiful pots and vibrant plants.
                Transform every corner of your home into a green paradise.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('products.index') }}"
                   class="bg-amber-400 hover:bg-amber-300 text-stone-900 font-bold px-8 py-3.5
                          rounded-xl text-sm shadow-lg transition hover:-translate-y-0.5">
                    Explore Collection
                </a>
                <a href="{{ route('products.plants') }}"
                   class="bg-white/10 hover:bg-white/20 border border-white/30 text-white font-semibold
                          px-8 py-3.5 rounded-xl text-sm transition backdrop-blur-sm">
                    View Plants →
                </a>
            </div>
        </div>
    </div>

    {{-- Scroll hint --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 text-white/50 animate-bounce hidden sm:block">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </div>
</section>

{{-- ============================================================
     STATS STRIP
============================================================ --}}
<section class="bg-green-800 text-white py-6">
    <div class="max-w-5xl mx-auto px-4 grid grid-cols-2 sm:grid-cols-4 gap-6 text-center">
        <div>
            <p class="text-2xl font-extrabold text-amber-400">200+</p>
            <p class="text-green-200 text-xs mt-0.5 uppercase tracking-wider font-medium">Products</p>
        </div>
        <div>
            <p class="text-2xl font-extrabold text-amber-400">5+</p>
            <p class="text-green-200 text-xs mt-0.5 uppercase tracking-wider font-medium">Categories</p>
        </div>
        <div>
            <p class="text-2xl font-extrabold text-amber-400">Fast</p>
            <p class="text-green-200 text-xs mt-0.5 uppercase tracking-wider font-medium">Delivery</p>
        </div>
        <div>
            <p class="text-2xl font-extrabold text-amber-400">100%</p>
            <p class="text-green-200 text-xs mt-0.5 uppercase tracking-wider font-medium">Natural Plants</p>
        </div>
    </div>
</section>

{{-- ============================================================
     CATEGORIES SHOWCASE — full-bleed image tiles
============================================================ --}}
<section class="py-20 px-4 bg-stone-50">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-12">
            <span class="text-green-600 font-semibold text-xs uppercase tracking-widest">Browse By Type</span>
            <h2 class="brand-font text-3xl sm:text-4xl font-bold text-stone-800 mt-2">Shop by Category</h2>
            <p class="text-stone-500 mt-3 max-w-lg mx-auto">
                Find the perfect pot or plant to breathe life into every corner of your home
            </p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4 sm:gap-5">
            <a href="{{ route('products.pots') }}"
               class="group relative rounded-2xl overflow-hidden aspect-square shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <img src="{{ asset('images/ceramics/ceramics-large-pot5.webp') }}" alt="Pots"
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-4">
                    <h3 class="font-bold text-white text-sm">All Pots</h3>
                    <p class="text-white/70 text-xs mt-0.5">All varieties →</p>
                </div>
            </a>

            <a href="{{ route('products.ceramics') }}"
               class="group relative rounded-2xl overflow-hidden aspect-square shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <img src="{{ asset('images/ceramics/ceramics-medium-pot1.webp') }}" alt="Ceramics"
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-4">
                    <h3 class="font-bold text-white text-sm">Ceramics</h3>
                    <p class="text-white/70 text-xs mt-0.5">Elegant glazed →</p>
                </div>
            </a>

            <a href="{{ route('products.cement') }}"
               class="group relative rounded-2xl overflow-hidden aspect-square shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <img src="{{ asset('images/cement/cement-large-pot2.webp') }}" alt="Cement"
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-4">
                    <h3 class="font-bold text-white text-sm">Cement</h3>
                    <p class="text-white/70 text-xs mt-0.5">Durable &amp; stylish →</p>
                </div>
            </a>

            <a href="{{ route('products.mud') }}"
               class="group relative rounded-2xl overflow-hidden aspect-square shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <img src="{{ asset('images/mud/mud-large-pot1.webp') }}" alt="Mud Pots"
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-4">
                    <h3 class="font-bold text-white text-sm">Mud Pots</h3>
                    <p class="text-white/70 text-xs mt-0.5">Earthy charm →</p>
                </div>
            </a>

            <a href="{{ route('products.plants') }}"
               class="group relative rounded-2xl overflow-hidden aspect-square shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1 col-span-2 sm:col-span-1">
                <img src="{{ asset('images/Plants/snake_plant.webp') }}" alt="Plants"
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-green-900/80 via-green-900/20 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-4">
                    <h3 class="font-bold text-white text-sm">Indoor Plants</h3>
                    <p class="text-white/70 text-xs mt-0.5">Breathe life in →</p>
                </div>
            </a>
        </div>
    </div>
</section>

{{-- ============================================================
     FEATURED PRODUCTS — image-only cards, no price displayed
============================================================ --}}
{{-- ============================================================
     FEATURED PRODUCTS — image-only cards, no price displayed
============================================================ --}}
<section class="py-20 px-4 bg-white">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-10">
            <div>
                <span class="text-green-600 font-semibold text-xs uppercase tracking-widest">Hand-picked for you</span>
                <h2 class="brand-font text-3xl sm:text-4xl font-bold text-stone-800 mt-1">Featured Products</h2>
            </div>
            <a href="{{ route('products.index') }}"
               class="text-green-700 hover:text-green-800 font-semibold text-sm flex items-center gap-1 whitespace-nowrap group">
                View all
                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4 justify-items-center">
            <x-product-card image="images/ceramics/ceramics-large-pot2.webp"  name="Ceramic Large Pot"  badge="Popular" />
            <x-product-card image="images/ceramics/ceramics-medium-pot1.webp" name="Ceramic Medium Pot" />
            <x-product-card image="images/cement/cement-large-pot1.jpg"       name="Cement Large Pot"   badge="New" />
            <x-product-card image="images/plastic/plastic-large-pot1.jpg"     name="Plastic Large Pot" />
            <x-product-card image="images/Plants/snake_plant.webp"            name="Snake Plant"        badge="Trending" />
            <x-product-card image="images/Plants/money_plant.webp"            name="Money Plant" />
        </div>
    </div>
</section>

{{-- ============================================================
     WHY CHOOSE US
============================================================ --}}
<section class="py-20 px-4 bg-stone-50">
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-12">
            <span class="text-green-600 font-semibold text-xs uppercase tracking-widest">Our Promise</span>
            <h2 class="brand-font text-3xl sm:text-4xl font-bold text-stone-800 mt-2">Why Choose Us?</h2>
            <p class="text-stone-500 mt-3 max-w-lg mx-auto">
                We're committed to bringing the best nature has to offer, right to your door
            </p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 group hover:-translate-y-1">
                <div class="h-52 overflow-hidden">
                    <img src="{{ asset('images/cement/cement-large-pot3.webp') }}" alt="Free Delivery"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <div class="p-6 text-center">
                    <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                        <svg class="w-5 h-5 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8l1.5 10.5A2 2 0 008.5 20h7a2 2 0 002-1.5L19 8"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-stone-800 text-base mb-2"> Delivery</h3>
                    <p class="text-stone-500 text-sm leading-relaxed">
                         home delivery on all orders. We deliver across Kathmandu Valley.
                    </p>
                </div>
            </div>

            <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 group hover:-translate-y-1">
                <div class="h-52 overflow-hidden">
                    <img src="{{ asset('images/Plants/money_plant1.webp') }}" alt="100% Natural"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <div class="p-6 text-center">
                    <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                        <svg class="w-5 h-5 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-stone-800 text-base mb-2">100% Natural</h3>
                    <p class="text-stone-500 text-sm leading-relaxed">
                        All our plants are naturally grown. Healthy, vibrant, and ready for your home.
                    </p>
                </div>
            </div>

            <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 group hover:-translate-y-1">
                <div class="h-52 overflow-hidden">
                    <img src="{{ asset('images/Plants/Boston_Fern2.webp') }}" alt="Gift Wrapping"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <div class="p-6 text-center">
                    <div class="w-10 h-10 bg-pink-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                        <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-stone-800 text-base mb-2">Gift Wrapping</h3>
                    <p class="text-stone-500 text-sm leading-relaxed">
                        Special gift packaging available. Perfect for birthdays, anniversaries, and more.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     CTA BANNER
============================================================ --}}
<section class="relative py-24 px-4 overflow-hidden">
    <div class="absolute inset-0">
        <img src="{{ asset('images/ceramics/ceramics-large-pot9.webp') }}"
             alt="Collection" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-green-950/80"></div>
    </div>
    <div class="relative z-10 max-w-2xl mx-auto text-center">
        <span class="inline-block text-amber-400 text-xs font-semibold uppercase tracking-widest mb-4">Explore More</span>
        <h2 class="brand-font text-4xl sm:text-5xl font-bold text-white mb-5">Ready to Go Green?</h2>
        <p class="text-green-200 text-lg mb-8">Browse our full collection of pots and plants to find your perfect match.</p>
        <a href="{{ route('products.index') }}"
           class="inline-block bg-amber-400 hover:bg-amber-300 text-stone-900 font-bold px-10 py-4
                  rounded-xl text-base shadow-xl transition hover:-translate-y-0.5">
            Shop the Collection
        </a>
    </div>
</section>

@endsection
