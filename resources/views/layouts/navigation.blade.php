<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
    .logo-font {
        font-family: 'Cinzel Decorative', serif;
        background: linear-gradient(135deg, #166534, #15803d, #a16207);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-size: 1.15rem;
        letter-spacing: 0.03em;
        line-height: 1;
    }
    .logo-tagline {
        font-family: 'DM Sans', sans-serif;
        font-size: 0.55rem;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: #a16207;
        line-height: 1;
    }
    @keyframes pulse-avatar {
        0%, 100% { box-shadow: 0 0 0 0 rgba(21,128,61,0.4); }
        50%       { box-shadow: 0 0 0 6px rgba(21,128,61,0); }
    }
</style>

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">

                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 shrink-0">
                    <x-application-logo class="h-11 w-11 drop-shadow-sm" />
                    <div class="flex flex-col justify-center">
                        <span class="logo-font">FlowerPot</span>
                        <span class="logo-tagline">Kathmandu, Nepal</span>
                    </div>
                </a>

                <!-- Nav Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('home')"           :active="request()->routeIs('home')">Home</x-nav-link>
                    <x-nav-link :href="route('about')"          :active="request()->routeIs('about')">About</x-nav-link>
                    <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">Products</x-nav-link>
                    <x-nav-link :href="route('services')"       :active="request()->routeIs('services')">Services</x-nav-link>
                    <x-nav-link :href="route('contact')"        :active="request()->routeIs('contact')">Contact</x-nav-link>
                </div>
            </div>

            <!-- Auth Desktop -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-3">

                @auth
                    <!-- Cart Icon -->
                    <a href="{{ route('cart.index') }}" class="relative text-stone-500 hover:text-green-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        @php $cartCount = \App\Models\CartItem::where('user_id', Auth::id())->sum('quantity'); @endphp
                        @if($cartCount > 0)
                            <span class="absolute -top-2 -right-2 bg-amber-400 text-stone-900 text-xs font-bold
                                         w-5 h-5 rounded-full flex items-center justify-center shadow">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>

                    <!-- User Dropdown -->
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div class="flex items-center gap-2">

                                    {{-- ✅ DESKTOP AVATAR --}}
                                    <div class="w-9 h-9 rounded-full overflow-hidden shadow-md transition-transform hover:scale-110"
                                         style="animation:pulse-avatar 2s ease-in-out infinite;">
                                        <x-avatar :avatar="Auth::user()->avatar" :size="36" />
                                    </div>

                                    <span>{{ Auth::user()->name }}</span>
                                </div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>

                @else
                    <a href="{{ route('login') }}"
                       class="text-sm font-semibold text-gray-500 hover:text-green-700 me-4 transition">
                        Log in
                    </a>
                    <a href="{{ route('register') }}"
                       class="text-sm font-semibold bg-green-700 text-white px-4 py-2 rounded-lg hover:bg-green-800 transition shadow-sm">
                        Register
                    </a>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400
                               hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')"           :active="request()->routeIs('home')">Home</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('about')"          :active="request()->routeIs('about')">About</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">Products</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('services')"       :active="request()->routeIs('services')">Services</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('contact')"        :active="request()->routeIs('contact')">Contact</x-responsive-nav-link>
        </div>

        @auth
        <div class="pt-4 pb-1 border-t border-gray-200">

            <!-- Mobile Cart Link -->
            <div class="px-4 mb-2">
                <a href="{{ route('cart.index') }}"
                   class="flex items-center gap-2 text-sm font-medium text-stone-600 hover:text-green-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    My Cart
                    @php $cartCount = \App\Models\CartItem::where('user_id', Auth::id())->sum('quantity'); @endphp
                    @if($cartCount > 0)
                        <span class="bg-amber-400 text-stone-900 text-xs font-bold px-1.5 py-0.5 rounded-full">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>
            </div>

            <div class="px-4 flex items-center gap-3">

                {{-- ✅ MOBILE AVATAR --}}
                <div class="w-9 h-9 rounded-full overflow-hidden shadow-sm">
                    <x-avatar :avatar="Auth::user()->avatar" :size="36" />
                </div>

                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">Profile</x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        Log Out
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>

        @else
        <div class="pt-4 pb-3 border-t border-gray-200 px-4 flex gap-3">
            <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600">Log in</a>
            <a href="{{ route('register') }}" class="text-sm font-medium text-green-700">Register</a>
        </div>
        @endauth
    </div>
</nav>