{{-- Load Cinzel Decorative (natural, earthy, elegant) from Google Fonts --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@700&family=Lato:wght@400;600&display=swap" rel="stylesheet">

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
        font-family: 'Lato', sans-serif;
        font-size: 0.55rem;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: #a16207;
        line-height: 1;
    }
    <style>
    @keyframes pulse-avatar {
        0%, 100% { box-shadow: 0 0 0 0 rgba(21,128,61,0.4); }
        50%       { box-shadow: 0 0 0 6px rgba(21,128,61,0); }
    }
</style>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
    .logo-font {
        font-family: 'Cinzel Decorative', serif;
        background: linear-gradient(135deg, #166534, #15803d, #a16207);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .logo-tagline {
        font-size: 0.55rem;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: #a16207;
        line-height: 1;
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
                    <x-nav-link :href="route('home')"            :active="request()->routeIs('home')">Home</x-nav-link>
                    <x-nav-link :href="route('about')"           :active="request()->routeIs('about')">About</x-nav-link>
                    <x-nav-link :href="route('products.index')"  :active="request()->routeIs('products.*')">Products</x-nav-link>
                    <x-nav-link :href="route('services')"        :active="request()->routeIs('services')">Services</x-nav-link>
                    <x-nav-link :href="route('contact')"         :active="request()->routeIs('contact')">Contact</x-nav-link>
                </div>
            </div>

            <!-- Auth Desktop -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div class="flex items-center gap-2">
                                    @if(Auth::user()->gender === 'female')
                                        <div class="w-9 h-9 rounded-full overflow-hidden shadow-md transition-transform hover:scale-110" style="animation:pulse-avatar 2s ease-in-out infinite;">
                                            <svg viewBox="0 0 100 100" width="36" height="36" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="50" cy="50" r="48" fill="#be185d"/>
                                                <ellipse cx="50" cy="62" rx="32" ry="38" fill="#7c2d12"/>
                                                <circle cx="50" cy="46" r="26" fill="#fde68a"/>
                                                <ellipse cx="24" cy="50" rx="8" ry="22" fill="#7c2d12"/>
                                                <ellipse cx="76" cy="50" rx="8" ry="22" fill="#7c2d12"/>
                                                <path d="M24 38 Q24 14 50 14 Q76 14 76 38" fill="#7c2d12"/>
                                                <ellipse cx="24" cy="46" rx="3.5" ry="5" fill="#fde68a"/>
                                                <ellipse cx="76" cy="46" rx="3.5" ry="5" fill="#fde68a"/>
                                                <circle cx="24" cy="52" r="2.5" fill="#fbbf24"/>
                                                <circle cx="76" cy="52" r="2.5" fill="#fbbf24"/>
                                                <path d="M36 34 Q42 30 47 34" stroke="#92400e" stroke-width="1.8" fill="none" stroke-linecap="round"/>
                                                <path d="M53 34 Q58 30 64 34" stroke="#92400e" stroke-width="1.8" fill="none" stroke-linecap="round"/>
                                                <ellipse cx="42" cy="42" rx="4.5" ry="4" fill="white"/>
                                                <ellipse cx="58" cy="42" rx="4.5" ry="4" fill="white"/>
                                                <circle cx="42" cy="43" r="2.8" fill="#be185d"/>
                                                <circle cx="58" cy="43" r="2.8" fill="#be185d"/>
                                                <circle cx="43" cy="42" r="1" fill="white"/>
                                                <circle cx="59" cy="42" r="1" fill="white"/>
                                                <path d="M48 47 Q50 52 52 47" stroke="#d97706" stroke-width="1" fill="none" stroke-linecap="round"/>
                                                <path d="M43 56 Q50 62 57 56" stroke="#e11d48" stroke-width="2.2" fill="none" stroke-linecap="round"/>
                                                <circle cx="37" cy="50" r="5" fill="#fca5a5" opacity="0.4"/>
                                                <circle cx="63" cy="50" r="5" fill="#fca5a5" opacity="0.4"/>
                                                <path d="M22 98 Q22 76 50 76 Q78 76 78 98" fill="#db2777"/>
                                            </svg>
                                        </div>
                                    @else
                                        <div class="w-9 h-9 rounded-full overflow-hidden shadow-md transition-transform hover:scale-110" style="animation:pulse-avatar 2s ease-in-out infinite;">
                                            <svg viewBox="0 0 100 100" width="36" height="36" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="50" cy="50" r="48" fill="#1e40af"/>
                                                <rect x="41" y="68" width="18" height="12" rx="4" fill="#fbbf24"/>
                                                <path d="M22 44 Q22 18 50 18 Q78 18 78 44" fill="#92400e"/>
                                                <rect x="22" y="40" width="56" height="8" rx="4" fill="#92400e"/>
                                                <circle cx="50" cy="48" r="26" fill="#fde68a"/>
                                                <rect x="36" y="35" width="12" height="3" rx="1.5" fill="#92400e"/>
                                                <rect x="52" y="35" width="12" height="3" rx="1.5" fill="#92400e"/>
                                                <ellipse cx="42" cy="43" rx="4" ry="4" fill="white"/>
                                                <ellipse cx="58" cy="43" rx="4" ry="4" fill="white"/>
                                                <circle cx="42" cy="44" r="2.5" fill="#1e3a5f"/>
                                                <circle cx="58" cy="44" r="2.5" fill="#1e3a5f"/>
                                                <circle cx="43" cy="43" r="1" fill="white"/>
                                                <circle cx="59" cy="43" r="1" fill="white"/>
                                                <path d="M48 48 Q50 54 52 48" stroke="#d97706" stroke-width="1.2" fill="none" stroke-linecap="round"/>
                                                <path d="M42 57 Q50 63 58 57" stroke="#1c1917" stroke-width="1.8" fill="none" stroke-linecap="round"/>
                                                <ellipse cx="24" cy="48" rx="4" ry="6" fill="#fde68a"/>
                                                <ellipse cx="76" cy="48" rx="4" ry="6" fill="#fde68a"/>
                                                <path d="M20 98 Q20 76 50 76 Q80 76 80 98" fill="#1d4ed8"/>
                                                <path d="M44 76 L50 84 L56 76" stroke="white" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                    @endif
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
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-500 hover:text-green-700 me-4 transition">Log in</a>
                    <a href="{{ route('register') }}" class="text-sm font-semibold bg-green-700 text-white px-4 py-2 rounded-lg hover:bg-green-800 transition shadow-sm">Register</a>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
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
            <div class="px-4 flex items-center gap-3">
                @if(Auth::user()->gender === 'female')
                    <div class="w-9 h-9 rounded-full overflow-hidden shadow-sm">
                        <svg viewBox="0 0 100 100" width="36" height="36" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="50" cy="50" r="48" fill="#be185d"/>
                            <ellipse cx="50" cy="62" rx="32" ry="38" fill="#7c2d12"/>
                            <circle cx="50" cy="46" r="26" fill="#fde68a"/>
                            <ellipse cx="24" cy="50" rx="8" ry="22" fill="#7c2d12"/>
                            <ellipse cx="76" cy="50" rx="8" ry="22" fill="#7c2d12"/>
                            <path d="M24 38 Q24 14 50 14 Q76 14 76 38" fill="#7c2d12"/>
                            <path d="M43 56 Q50 62 57 56" stroke="#e11d48" stroke-width="2.2" fill="none" stroke-linecap="round"/>
                            <path d="M22 98 Q22 76 50 76 Q78 76 78 98" fill="#db2777"/>
                        </svg>
                    </div>
                @else
                    <div class="w-9 h-9 rounded-full overflow-hidden shadow-sm">
                        <svg viewBox="0 0 100 100" width="36" height="36" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="50" cy="50" r="48" fill="#1e40af"/>
                            <path d="M22 44 Q22 18 50 18 Q78 18 78 44" fill="#92400e"/>
                            <circle cx="50" cy="48" r="26" fill="#fde68a"/>
                            <path d="M42 57 Q50 63 58 57" stroke="#1c1917" stroke-width="1.8" fill="none" stroke-linecap="round"/>
                            <path d="M20 98 Q20 76 50 76 Q80 76 80 98" fill="#1d4ed8"/>
                        </svg>
                    </div>
                @endif
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
                        onclick="event.preventDefault(); this.closest('form').submit();">Log Out</x-responsive-nav-link>
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
