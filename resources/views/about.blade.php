@extends('layouts.app')

@section('title', 'About Us')

@section('content')

{{-- Hero --}}
<section class="bg-gradient-to-r from-green-800 to-green-600 text-white py-16 px-4 text-center">
    <h1 class="text-4xl md:text-5xl font-extrabold mb-4">About FlowerPot</h1>
    <p class="text-green-200 text-lg max-w-2xl mx-auto">Our passion is plants, and our mission is to bring the beauty of nature into every home.</p>
</section>

{{-- Mission --}}
<section class="py-16 px-4 bg-white">
    <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <div>
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Our Story</h2>
            <p class="text-gray-600 leading-relaxed mb-4">
                FlowerPot was founded in 2015 with a simple dream — to make it easy for everyone to bring nature indoors. What started as a small shop in Lahore has grown into Pakistan's most loved online plant and pot store.
            </p>
            <p class="text-gray-600 leading-relaxed mb-4">
                We source the finest ceramics, handcraft our cement pots, and grow our plants with care. Every product in our store is chosen with love for greenery and quality.
            </p>
            <p class="text-gray-600 leading-relaxed">
                Our team of horticulturists and designers work together to curate collections that are not just beautiful but also easy to care for — perfect for beginners and plant enthusiasts alike.
            </p>
        </div>
        <div class="bg-green-50 rounded-2xl p-8 text-center">
            <div class="text-8xl mb-4">🌸</div>
            <div class="grid grid-cols-2 gap-6 mt-6">
                <div>
                    <p class="text-3xl font-extrabold text-green-700">500+</p>
                    <p class="text-gray-500 text-sm">Products</p>
                </div>
                <div>
                    <p class="text-3xl font-extrabold text-green-700">10k+</p>
                    <p class="text-gray-500 text-sm">Happy Customers</p>
                </div>
                <div>
                    <p class="text-3xl font-extrabold text-green-700">8+</p>
                    <p class="text-gray-500 text-sm">Years Experience</p>
                </div>
                <div>
                    <p class="text-3xl font-extrabold text-green-700">50+</p>
                    <p class="text-gray-500 text-sm">Cities Delivered</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Mission & Vision --}}
<section class="py-16 px-4 bg-green-50">
    <div class="max-w-5xl mx-auto">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800">Our Mission & Values</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-2xl p-6 shadow text-center">
                <div class="text-4xl mb-3">🎯</div>
                <h3 class="font-bold text-gray-800 mb-2">Our Mission</h3>
                <p class="text-gray-500 text-sm">To make quality plants and pots accessible to every household across Pakistan, fostering a love for nature.</p>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow text-center">
                <div class="text-4xl mb-3">👁️</div>
                <h3 class="font-bold text-gray-800 mb-2">Our Vision</h3>
                <p class="text-gray-500 text-sm">To become the leading green lifestyle brand in South Asia, inspiring millions to live closer to nature.</p>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow text-center">
                <div class="text-4xl mb-3">💚</div>
                <h3 class="font-bold text-gray-800 mb-2">Our Values</h3>
                <p class="text-gray-500 text-sm">Sustainability, quality, and customer joy guide every decision we make — from sourcing to doorstep delivery.</p>
            </div>
        </div>
    </div>
</section>

{{-- Team --}}
<section class="py-16 px-4 bg-white">
    <div class="max-w-5xl mx-auto">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800">Meet Our Team</h2>
            <p class="text-gray-500 mt-2">The passionate people behind FlowerPot</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach([
                ['name' => 'Ayesha Khan', 'role' => 'Founder & CEO', 'emoji' => '👩‍💼'],
                ['name' => 'Usman Ali', 'role' => 'Head Horticulturist', 'emoji' => '👨‍🌾'],
                ['name' => 'Sara Ahmed', 'role' => 'Creative Director', 'emoji' => '👩‍🎨'],
                ['name' => 'Bilal Hassan', 'role' => 'Operations Manager', 'emoji' => '👨‍💻'],
            ] as $member)
            <div class="text-center p-6 bg-green-50 rounded-2xl">
                <div class="text-5xl mb-3">{{ $member['emoji'] }}</div>
                <h3 class="font-bold text-gray-800">{{ $member['name'] }}</h3>
                <p class="text-green-600 text-sm mt-1">{{ $member['role'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
