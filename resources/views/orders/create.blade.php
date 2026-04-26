@extends('layouts.app')
@section('title', 'Place Order')
@section('content')

<section class="py-12 px-4 bg-stone-50 min-h-screen">
    <div class="max-w-5xl mx-auto">

        <h1 class="text-3xl font-bold text-stone-800 mb-8">📦 Place Your Order</h1>

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-6">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            {{-- Order Form --}}
            <div class="bg-white rounded-2xl shadow-sm p-6">
                <h2 class="text-lg font-bold text-stone-800 mb-5">Delivery Details</h2>

                <form method="POST" action="{{ route('orders.store') }}" id="orderForm" class="space-y-4">
                    @csrf

                    <input type="hidden" name="latitude"        id="latitude">
                    <input type="hidden" name="longitude"       id="longitude">
                    <input type="hidden" name="distance_km"     id="distance_km">
                    <input type="hidden" name="delivery_charge" id="delivery_charge_input">

                    {{-- Name --}}
                    <div>
                        <label class="block text-sm font-semibold text-stone-700 mb-1">Full Name</label>
                        <input type="text" name="customer_name"
                               value="{{ Auth::user()->name }}"
                               class="w-full border border-stone-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                               required>
                        <x-input-error :messages="$errors->get('customer_name')" class="mt-1" />
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block text-sm font-semibold text-stone-700 mb-1">Email</label>
                        <input type="email" name="email"
                               value="{{ Auth::user()->email }}"
                               class="w-full border border-stone-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                               required>
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    {{-- Phone --}}
                    <div>
                        <label class="block text-sm font-semibold text-stone-700 mb-1">Phone Number</label>
                        <input type="tel" name="phone_no"
                               placeholder="+977 "
                               class="w-full border border-stone-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                               required>
                        <x-input-error :messages="$errors->get('phone_no')" class="mt-1" />
                    </div>

                    {{-- Address with search --}}
                    <div>
                        <label class="block text-sm font-semibold text-stone-700 mb-1">
                            Delivery Address
                            <span class="text-xs text-stone-400 font-normal ml-1">(type to search)</span>
                        </label>
                        <input type="text" name="address" id="address-search"
                               placeholder="Search your address..."
                               class="w-full border border-stone-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                               autocomplete="off" required>
                        <div id="suggestions"
                             class="hidden absolute z-50 bg-white border border-stone-200 rounded-xl shadow-lg mt-1 max-h-48 overflow-y-auto w-full max-w-md">
                        </div>
                        <x-input-error :messages="$errors->get('address')" class="mt-1" />
                    </div>

                    {{-- Delivery Info --}}
                    <div id="delivery-info" class="hidden bg-green-50 border border-green-200 rounded-xl p-4 space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-stone-600 font-medium">Distance from factory:</span>
                            <span id="distance-display" class="font-bold text-green-700"></span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-stone-600 font-medium">Delivery Charge:</span>
                            <span id="delivery-charge-display" class="font-bold text-amber-600"></span>
                        </div>
                    </div>

                    {{-- Order Summary --}}
                    <div class="bg-stone-50 rounded-xl p-4 space-y-2 border border-stone-100">
                        <div class="flex justify-between text-sm text-stone-600">
                            <span>Subtotal</span>
                            <span>Rs. {{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-sm text-stone-600">
                            <span>Delivery</span>
                            <span id="delivery-summary">Rs. 0.00</span>
                        </div>
                        <div class="flex justify-between font-bold text-stone-800 text-base pt-2 border-t border-stone-200">
                            <span>Total</span>
                            <span id="total-summary">Rs. {{ number_format($subtotal, 2) }}</span>
                        </div>
                    </div>

                    <button type="submit" id="submit-btn"
                            class="w-full bg-green-700 hover:bg-green-800 text-white font-bold
                                   py-3.5 rounded-xl transition shadow-md text-base disabled:opacity-50 disabled:cursor-not-allowed"
                            disabled>
                        ✅ Confirm Order
                    </button>

                </form>
            </div>

            {{-- Map --}}
            <div class="bg-white rounded-2xl shadow-sm p-4">
                <h2 class="text-lg font-bold text-stone-800 mb-3"> Delivery Location</h2>
                <div id="map" class="w-full rounded-xl" style="height:420px;"></div>
                <p class="text-xs text-stone-400 mt-2 text-center">
                    📍 Red pin = Your location &nbsp;|&nbsp; 🟢 Green pin = FlowerPot Factory
                </p>
            </div>

        </div>

        {{-- Cart Items Summary --}}
        <div class="bg-white rounded-2xl shadow-sm p-6 mt-8">
            <h2 class="text-lg font-bold text-stone-800 mb-4">🛒 Items in this Order</h2>
            <div class="space-y-3">
                @foreach($cartItems as $item)
                <div class="flex items-center gap-4 py-2 border-b border-stone-100 last:border-0">
                    <img src="{{ asset($item->product->image) }}"
                         alt="{{ $item->product->name }}"
                         class="w-14 h-14 object-cover rounded-xl flex-shrink-0">
                    <div class="flex-1">
                        <p class="font-semibold text-stone-800 text-sm">{{ $item->product->name }}</p>
                        <p class="text-xs text-stone-400">Qty: {{ $item->quantity }}</p>
                    </div>
                    <p class="font-bold text-green-700 text-sm">
                        Rs. {{ number_format($item->product->price * $item->quantity, 2) }}
                    </p>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</section>

{{-- Leaflet CSS --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    // Factory location
    const FACTORY_LAT  = {{ env('FACTORY_LATITUDE', 27.7172) }};
    const FACTORY_LNG  = {{ env('FACTORY_LONGITUDE', 85.3240) }};
    const SUBTOTAL     = {{ $subtotal }};
    const ORS_API_KEY  = '{{ env('ORS_API_KEY') }}';

    // Delivery charge table
    function getDeliveryCharge(km) {
        if (km <= 5)  return 50;
        if (km <= 10) return 100;
        if (km <= 20) return 150;
        if (km <= 30) return 200;
        return 300;
    }

    // Init map centered on Kathmandu
    const map = L.map('map').setView([FACTORY_LAT, FACTORY_LNG], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Factory marker (green)
    const factoryIcon = L.divIcon({
    html: `
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32" height="32">
            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"
                  fill="#15803d" stroke="white" stroke-width="1.5"/>
            <circle cx="12" cy="9" r="2.5" fill="white"/>
        </svg>`,
    iconSize: [32, 32],
    iconAnchor: [16, 32],
    popupAnchor: [0, -32]
});
    L.marker([FACTORY_LAT, FACTORY_LNG], { icon: factoryIcon })
     .addTo(map)
     .bindPopup('<b>🌿 FlowerPot Factory</b><br>Your order ships from here')
     .openPopup();

    // Customer marker (red)
    const customerIcon = L.divIcon({
    html: `
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32" height="32">
            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"
                  fill="#dc2626" stroke="white" stroke-width="1.5"/>
            <circle cx="12" cy="9" r="2.5" fill="white"/>
        </svg>`,
    iconSize: [32, 32],
    iconAnchor: [16, 32],
    popupAnchor: [0, -32]
});

    let customerMarker = null;
    let routeLine = null;

    // Haversine distance formula
    function haversineDistance(lat1, lng1, lat2, lng2) {
        const R = 6371;
        const dLat = (lat2 - lat1) * Math.PI / 180;
        const dLng = (lng2 - lng1) * Math.PI / 180;
        const a = Math.sin(dLat/2) * Math.sin(dLat/2) +
                  Math.cos(lat1 * Math.PI/180) * Math.cos(lat2 * Math.PI/180) *
                  Math.sin(dLng/2) * Math.sin(dLng/2);
        return R * 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    }

    function updateLocation(lat, lng, displayName) {
        // Update hidden inputs
        document.getElementById('latitude').value    = lat;
        document.getElementById('longitude').value   = lng;
        document.getElementById('address-search').value = displayName;

        // Calculate distance
        const distKm = haversineDistance(FACTORY_LAT, FACTORY_LNG, lat, lng);
        const charge  = getDeliveryCharge(distKm);

        document.getElementById('distance_km').value      = distKm.toFixed(2);
        document.getElementById('delivery_charge_input').value = charge;

        // Update UI
        document.getElementById('distance-display').textContent      = distKm.toFixed(2) + ' km';
        document.getElementById('delivery-charge-display').textContent = 'Rs. ' + charge;
        document.getElementById('delivery-summary').textContent       = 'Rs. ' + charge.toFixed(2);
        document.getElementById('total-summary').textContent          = 'Rs. ' + (SUBTOTAL + charge).toFixed(2);
        document.getElementById('delivery-info').classList.remove('hidden');
        document.getElementById('submit-btn').disabled = false;

        // Update marker
        if (customerMarker) map.removeLayer(customerMarker);
        customerMarker = L.marker([lat, lng], { icon: customerIcon })
            .addTo(map)
            .bindPopup('<b>📍 Your Location</b><br>' + displayName)
            .openPopup();

        // Draw line between factory and customer
        if (routeLine) map.removeLayer(routeLine);
        routeLine = L.polyline([
            [FACTORY_LAT, FACTORY_LNG],
            [lat, lng]
        ], { color: '#15803d', weight: 3, dashArray: '8 6', opacity: 0.7 }).addTo(map);

        // Fit map to show both points
        map.fitBounds([
            [FACTORY_LAT, FACTORY_LNG],
            [lat, lng]
        ], { padding: [40, 40] });
    }

    // Address search using Nominatim (free)
    let searchTimeout;
    document.getElementById('address-search').addEventListener('input', function() {
        clearTimeout(searchTimeout);
        const query = this.value.trim();
        if (query.length < 3) {
            document.getElementById('suggestions').classList.add('hidden');
            return;
        }

        searchTimeout = setTimeout(() => {
            fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&limit=5&countrycodes=np`)
                .then(r => r.json())
                .then(results => {
                    const box = document.getElementById('suggestions');
                    if (!results.length) { box.classList.add('hidden'); return; }

                    box.innerHTML = results.map(r => `
                        <div class="px-4 py-2.5 hover:bg-green-50 cursor-pointer text-sm text-stone-700 border-b border-stone-100 last:border-0"
                             onclick="selectAddress('${r.display_name.replace(/'/g,"\\'")}', ${r.lat}, ${r.lon})">
                            📍 ${r.display_name}
                        </div>
                    `).join('');
                    box.classList.remove('hidden');
                });
        }, 400);
    });

    function selectAddress(name, lat, lng) {
        document.getElementById('suggestions').classList.add('hidden');
        updateLocation(parseFloat(lat), parseFloat(lng), name);
    }

    // Click on map to set location
    map.on('click', function(e) {
        const { lat, lng } = e.latlng;
        fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
            .then(r => r.json())
            .then(data => {
                updateLocation(lat, lng, data.display_name || `${lat.toFixed(4)}, ${lng.toFixed(4)}`);
            });
    });

    // Close suggestions on outside click
    document.addEventListener('click', function(e) {
        if (!e.target.closest('#address-search') && !e.target.closest('#suggestions')) {
            document.getElementById('suggestions').classList.add('hidden');
        }
    });
</script>

@endsection