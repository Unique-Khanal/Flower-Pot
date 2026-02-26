@extends('layouts.app')

@section('title', 'Services')

@section('content')

{{-- Hero --}}
<section class="bg-gradient-to-r from-green-800 to-green-600 text-white py-16 px-4 text-center">
    <h1 class="text-4xl md:text-5xl font-extrabold mb-4">Our Services</h1>
    <p class="text-green-200 text-lg max-w-2xl mx-auto">From delivery to custom designs, we go the extra mile for your green lifestyle.</p>
</section>

{{-- Services Grid --}}
<section class="py-16 px-4 bg-white">
    <div class="max-w-6xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            <div class="bg-green-50 rounded-2xl p-8 hover:shadow-lg transition group">
                <div class="text-5xl mb-4 group-hover:scale-110 transition-transform">🚚</div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Home Delivery</h3>
                <p class="text-gray-600 leading-relaxed">We deliver your plants and pots directly to your doorstep, anywhere in Pakistan. Free delivery on orders above Rs. 1500. Same-day delivery available in Lahore, Karachi, and Islamabad.</p>
                <ul class="mt-4 space-y-1 text-sm text-gray-500">
                    <li>✅ Free delivery on Rs. 1500+</li>
                    <li>✅ Same-day delivery in major cities</li>
                    <li>✅ Careful packaging guaranteed</li>
                </ul>
            </div>

            <div class="bg-amber-50 rounded-2xl p-8 hover:shadow-lg transition group">
                <div class="text-5xl mb-4 group-hover:scale-110 transition-transform">🎨</div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Custom Pots</h3>
                <p class="text-gray-600 leading-relaxed">Want something unique? We craft custom pots in any size, shape, or color. Perfect for special occasions, corporate gifts, or personalized décor. Share your design and we'll bring it to life.</p>
                <ul class="mt-4 space-y-1 text-sm text-gray-500">
                    <li>✅ Any size & shape</li>
                    <li>✅ Custom colors & engravings</li>
                    <li>✅ 7–14 day turnaround</li>
                </ul>
            </div>

            <div class="bg-blue-50 rounded-2xl p-8 hover:shadow-lg transition group">
                <div class="text-5xl mb-4 group-hover:scale-110 transition-transform">🌿</div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Plant Consultation</h3>
                <p class="text-gray-600 leading-relaxed">Not sure which plant suits your space? Our expert horticulturists provide free consultations to help you pick the right plants for your home, office, or garden based on light, humidity, and space.</p>
                <ul class="mt-4 space-y-1 text-sm text-gray-500">
                    <li>✅ Free 30-minute consultation</li>
                    <li>✅ Personalized recommendations</li>
                    <li>✅ Care guides included</li>
                </ul>
            </div>

            <div class="bg-pink-50 rounded-2xl p-8 hover:shadow-lg transition group">
                <div class="text-5xl mb-4 group-hover:scale-110 transition-transform">🎁</div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Gift Wrapping</h3>
                <p class="text-gray-600 leading-relaxed">Make your gift extra special with our beautiful gift wrapping service. We use eco-friendly materials and can add personal messages. Perfect for birthdays, weddings, and celebrations.</p>
                <ul class="mt-4 space-y-1 text-sm text-gray-500">
                    <li>✅ Eco-friendly materials</li>
                    <li>✅ Custom message cards</li>
                    <li>✅ Available for all orders</li>
                </ul>
            </div>

            <div class="bg-purple-50 rounded-2xl p-8 hover:shadow-lg transition group">
                <div class="text-5xl mb-4 group-hover:scale-110 transition-transform">🏡</div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Landscaping</h3>
                <p class="text-gray-600 leading-relaxed">Transform your outdoor spaces with our professional landscaping service. Our team designs and installs beautiful gardens, terraces, and balcony setups. Available in Lahore, Karachi, and Islamabad.</p>
                <ul class="mt-4 space-y-1 text-sm text-gray-500">
                    <li>✅ Professional design team</li>
                    <li>✅ Maintenance packages available</li>
                    <li>✅ Free site visit & quote</li>
                </ul>
            </div>

            <div class="bg-yellow-50 rounded-2xl p-8 hover:shadow-lg transition group">
                <div class="text-5xl mb-4 group-hover:scale-110 transition-transform">📦</div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Bulk Orders</h3>
                <p class="text-gray-600 leading-relaxed">Need pots or plants in large quantities for events, offices, or hotels? We offer special discounts on bulk orders. Get in touch to discuss your requirements and get a custom quote.</p>
                <ul class="mt-4 space-y-1 text-sm text-gray-500">
                    <li>✅ Special bulk discounts</li>
                    <li>✅ Custom branding available</li>
                    <li>✅ Dedicated account manager</li>
                </ul>
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
