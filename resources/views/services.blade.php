@extends('layouts.app')

@section('title', 'Services')

@section('content')

{{-- Hero --}}
<section class="relative text-white py-20 px-4 text-center overflow-hidden">
    <div class="absolute inset-0">
        <img src="{{ asset('images/Plants/spider_plant2.webp') }}"
             class="w-full h-full object-cover" alt="Our Services">
        <div class="absolute inset-0 bg-green-900/75"></div>
    </div>
    <div class="relative z-10 max-w-3xl mx-auto">
        <p class="text-green-300 uppercase tracking-widest text-xs mb-3 font-semibold">What We Offer</p>
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4">Our Services</h1>
        <p class="text-green-100 text-lg max-w-2xl mx-auto">From delivery to custom designs, we go the extra mile for your green lifestyle.</p>
    </div>
</section>

{{-- Services Grid --}}
<section class="py-16 px-4 bg-gray-50">
    <div class="max-w-6xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            {{-- Home Delivery --}}
            <div class="bg-white rounded-2xl overflow-hidden shadow hover:shadow-xl transition-shadow duration-300 group">
                <div class="h-48 overflow-hidden">
                    <img src="{{ asset('images/ceramics/ceramics-large-pot3.webp') }}"
                         alt="Home Delivery"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">Delivery</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Home Delivery</h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4">We deliver your plants and pots directly to your doorstep, anywhere in Pakistan. Free delivery on orders above Rs. 1500. Same-day delivery available in major cities.</p>
                    <ul class="space-y-1 text-sm text-gray-500">
                        <li class="flex items-center gap-2"><span class="text-green-500 font-bold">✓</span> Free delivery on Rs. 1500+</li>
                        <li class="flex items-center gap-2"><span class="text-green-500 font-bold">✓</span> Same-day delivery in major cities</li>
                        <li class="flex items-center gap-2"><span class="text-green-500 font-bold">✓</span> Careful packaging guaranteed</li>
                    </ul>
                </div>
            </div>

            {{-- Custom Pots --}}
            <div class="bg-white rounded-2xl overflow-hidden shadow hover:shadow-xl transition-shadow duration-300 group">
                <div class="h-48 overflow-hidden">
                    <img src="{{ asset('images/ceramics/ceramics-medium-pot3.webp') }}"
                         alt="Custom Pots"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="bg-amber-100 text-amber-700 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">Custom</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Custom Pots</h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4">Want something unique? We craft custom pots in any size, shape, or color. Perfect for special occasions, corporate gifts, or personalized décor.</p>
                    <ul class="space-y-1 text-sm text-gray-500">
                        <li class="flex items-center gap-2"><span class="text-green-500 font-bold">✓</span> Any size & shape</li>
                        <li class="flex items-center gap-2"><span class="text-green-500 font-bold">✓</span> Custom colors & engravings</li>
                        <li class="flex items-center gap-2"><span class="text-green-500 font-bold">✓</span> 7–14 day turnaround</li>
                    </ul>
                </div>
            </div>

            {{-- Plant Consultation --}}
            <div class="bg-white rounded-2xl overflow-hidden shadow hover:shadow-xl transition-shadow duration-300 group">
                <div class="h-48 overflow-hidden">
                    <img src="{{ asset('images/Plants/snake_plant.webp') }}"
                         alt="Plant Consultation"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="bg-blue-100 text-blue-700 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">Consultation</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Plant Consultation</h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4">Not sure which plant suits your space? Our expert horticulturists provide free consultations to help you pick the right plants based on light, humidity, and space.</p>
                    <ul class="space-y-1 text-sm text-gray-500">
                        <li class="flex items-center gap-2"><span class="text-green-500 font-bold">✓</span> Free 30-minute consultation</li>
                        <li class="flex items-center gap-2"><span class="text-green-500 font-bold">✓</span> Personalized recommendations</li>
                        <li class="flex items-center gap-2"><span class="text-green-500 font-bold">✓</span> Care guides included</li>
                    </ul>
                </div>
            </div>

            {{-- Gift Wrapping --}}
            <div class="bg-white rounded-2xl overflow-hidden shadow hover:shadow-xl transition-shadow duration-300 group">
                <div class="h-48 overflow-hidden">
                    <img src="{{ asset('images/Plants/Boston_Fern.webp') }}"
                         alt="Gift Wrapping"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="bg-pink-100 text-pink-700 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">Gifting</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Gift Wrapping</h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4">Make your gift extra special with our beautiful gift wrapping service. We use eco-friendly materials and can add personal message cards.</p>
                    <ul class="space-y-1 text-sm text-gray-500">
                        <li class="flex items-center gap-2"><span class="text-green-500 font-bold">✓</span> Eco-friendly materials</li>
                        <li class="flex items-center gap-2"><span class="text-green-500 font-bold">✓</span> Custom message cards</li>
                        <li class="flex items-center gap-2"><span class="text-green-500 font-bold">✓</span> Available for all orders</li>
                    </ul>
                </div>
            </div>

            {{-- Landscaping --}}
            <div class="bg-white rounded-2xl overflow-hidden shadow hover:shadow-xl transition-shadow duration-300 group">
                <div class="h-48 overflow-hidden">
                    <img src="{{ asset('images/Plants/spider_plant.webp') }}"
                         alt="Landscaping"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="bg-purple-100 text-purple-700 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">Landscaping</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Landscaping</h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4">Transform your outdoor spaces with our professional landscaping service. Our team designs and installs beautiful gardens, terraces, and balcony setups.</p>
                    <ul class="space-y-1 text-sm text-gray-500">
                        <li class="flex items-center gap-2"><span class="text-green-500 font-bold">✓</span> Professional design team</li>
                        <li class="flex items-center gap-2"><span class="text-green-500 font-bold">✓</span> Maintenance packages available</li>
                        <li class="flex items-center gap-2"><span class="text-green-500 font-bold">✓</span> Free site visit & quote</li>
                    </ul>
                </div>
            </div>

            {{-- Bulk Orders --}}
            <div class="bg-white rounded-2xl overflow-hidden shadow hover:shadow-xl transition-shadow duration-300 group">
                <div class="h-48 overflow-hidden">
                    <img src="{{ asset('images/cement/cement-large-pot2.webp') }}"
                         alt="Bulk Orders"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="bg-yellow-100 text-yellow-700 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">Bulk</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Bulk Orders</h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4">Need pots or plants in large quantities for events, offices, or hotels? We offer special discounts on bulk orders with a dedicated account manager.</p>
                    <ul class="space-y-1 text-sm text-gray-500">
                        <li class="flex items-center gap-2"><span class="text-green-500 font-bold">✓</span> Special bulk discounts</li>
                        <li class="flex items-center gap-2"><span class="text-green-500 font-bold">✓</span> Custom branding available</li>
                        <li class="flex items-center gap-2"><span class="text-green-500 font-bold">✓</span> Dedicated account manager</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- CTA --}}
<section class="py-16 px-4 bg-green-700 text-white text-center">
    <h2 class="text-3xl font-bold mb-4">Ready to Get Started?</h2>
    <p class="text-green-200 mb-8 text-lg">Contact us today and let's create something beautiful together.</p>
    <a href="{{ route('contact') }}" class="bg-white text-green-800 hover:bg-green-50 font-bold px-8 py-3 rounded-full text-lg transition shadow">
        Contact Us →
    </a>
</section>

@endsection
