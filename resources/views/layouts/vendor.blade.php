<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Vendor') — Biruwa</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'DM Sans', sans-serif; background:#F4F5F1; }
        .nav-link { color:rgba(255,255,255,.82); }
        .nav-link:hover { background:rgba(255,255,255,.10); color:#fff; }
        .nav-link.active { background:linear-gradient(135deg,#12281f,#0c1c15); color:#fff; font-weight:600; box-shadow: inset 0 0 0 1px rgba(216,185,104,.35); }
        .nav-icon svg { width:18px; height:18px; }
        .stat-card { transition: transform .15s, box-shadow .15s; }
        .stat-card:hover { transform: translateY(-3px); box-shadow: 0 14px 28px rgba(27,59,47,.10); }
        .icon-btn { position:relative; width:2.25rem; height:2.25rem; display:flex; align-items:center; justify-content:center; border-radius:0.65rem; color:#5A6B5C; transition:background .15s; }
        .icon-btn:hover { background:#F0F3EE; }
        .icon-btn svg { width:19px; height:19px; }
        .icon-badge { position:absolute; top:-2px; right:-2px; min-width:16px; height:16px; padding:0 3px; border-radius:999px; background:#D8462F; color:#fff; font-size:9px; font-weight:800; display:flex; align-items:center; justify-content:center; line-height:1; }

        .vendor-shell { display:flex; min-height:100vh; }
        #vendor-sidebar {
            width:16.5rem; flex-shrink:0;
            background: linear-gradient(180deg, #3E7A5A 0%, #24523C 100%);
            display:flex; flex-direction:column;
            position:relative; z-index:40;
        }
        .vendor-main { flex:1 1 0%; min-width:0; }

        @media (max-width: 1023px) {
            #vendor-sidebar { position:fixed; inset:0 auto 0 0; margin-left:-16.5rem; transition: margin-left .2s ease; }
            #vendor-sidebar.open { margin-left:0; }
            .vendor-main { width:100%; }
        }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen">

    <div id="sidebar-overlay" class="fixed inset-0 bg-black/40 z-30 hidden lg:hidden" onclick="toggleSidebar()"></div>

    <div class="vendor-shell">

        {{-- ═══ SIDEBAR ═══ --}}
        <aside id="vendor-sidebar">

            <div class="px-5 py-5 border-b border-white/15">
                <x-application-logo class="h-9 w-auto object-contain" />
                <span class="block text-[9px] font-bold tracking-[0.2em] uppercase text-[#F5E4B8] mt-2 ml-0.5">Vendor Panel</span>
            </div>

            <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-0.5">

                <a href="{{ route('vendor.dashboard') }}"
                   class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition {{ request()->routeIs('vendor.dashboard') ? 'active' : '' }}">
                    <span class="nav-icon opacity-90">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10.5 12 4l9 6.5M5 9.5V19a1 1 0 0 0 1 1h4v-5.5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1V20h4a1 1 0 0 0 1-1V9.5"/></svg>
                    </span>
                    Dashboard
                </a>

                <p class="px-3 text-[10px] font-bold tracking-[0.15em] uppercase text-white/60 mt-5 mb-1">Catalog</p>
                <a href="#" class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm opacity-50 cursor-not-allowed">
                    <span class="nav-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 2v4M8 5l1.5 2M16 5l-1.5 2"/><path stroke-linecap="round" stroke-linejoin="round" d="M7 10a5 5 0 0 1 10 0c0 3-2 5-2 8H9c0-3-2-5-2-8Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M9 18h6"/></svg>
                    </span>
                    My Products <span class="ml-auto text-[9px] bg-white/15 px-1.5 py-0.5 rounded">soon</span>
                </a>

                <p class="px-3 text-[10px] font-bold tracking-[0.15em] uppercase text-white/60 mt-5 mb-1">Sales</p>
                <a href="#" class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm opacity-50 cursor-not-allowed">
                    <span class="nav-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 3h6m-9 6h12a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 18 4.5H6a2.25 2.25 0 0 0-2.25 2.25v12A2.25 2.25 0 0 0 6 21Zm3.75-15h4.5v3.75h-4.5V6Z"/></svg>
                    </span>
                    My Orders <span class="ml-auto text-[9px] bg-white/15 px-1.5 py-0.5 rounded">soon</span>
                </a>
                <a href="#" class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm opacity-50 cursor-not-allowed">
                    <span class="nav-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z"/></svg>
                    </span>
                    Payouts <span class="ml-auto text-[9px] bg-white/15 px-1.5 py-0.5 rounded">soon</span>
                </a>
                <a href="{{ route('vendor.dashboard') }}#commission"
                   class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition">
                    <span class="nav-icon opacity-90">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                    </span>
                    Commission
                    @if($pendingFromAdmin ?? false)
                        <span class="ml-auto w-2 h-2 rounded-full bg-amber-400"></span>
                    @endif
                </a>

                <p class="px-3 text-[10px] font-bold tracking-[0.15em] uppercase text-white/60 mt-5 mb-1">Feedback</p>
                <a href="#" class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm opacity-50 cursor-not-allowed">
                    <span class="nav-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="m11.48 3.499 2.325 4.995 5.51.804a.563.563 0 0 1 .312.96l-3.987 3.89.941 5.483a.562.562 0 0 1-.816.592l-4.924-2.59-4.924 2.59a.562.562 0 0 1-.816-.592l.94-5.483-3.986-3.89a.563.563 0 0 1 .312-.96l5.51-.804 2.324-4.995a.563.563 0 0 1 1.018 0Z"/></svg>
                    </span>
                    Reviews <span class="ml-auto text-[9px] bg-white/15 px-1.5 py-0.5 rounded">soon</span>
                </a>

                <p class="px-3 text-[10px] font-bold tracking-[0.15em] uppercase text-white/60 mt-5 mb-1">Store</p>
                <a href="{{ route('vendor.settings') }}"
                   class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition {{ request()->routeIs('vendor.settings') ? 'active' : '' }}">
                    <span class="nav-icon opacity-90">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 0 1 0 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 0 1 0-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                    </span>
                    Store Settings
                </a>
            </nav>

            <div class="border-t border-white/15 p-4 flex items-center gap-2.5">
                <div class="w-9 h-9 rounded-full overflow-hidden flex-shrink-0 shadow-sm">
                    <x-avatar :avatar="auth()->user()->avatar" :size="36" />
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-semibold text-white truncate">{{ $vendor->business_name }}</p>
                    <p class="text-[10px] text-white/70 truncate">Vendor</p>
                </div>
                <button type="button" onclick="confirmVendorLogout()" class="text-white/70 hover:text-red-200 transition" title="Log out">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75"/></svg>
                </button>
            </div>
        </aside>

        {{-- ═══ MAIN ═══ --}}
        <div class="vendor-main">

            <header class="sticky top-0 z-20 bg-white/95 backdrop-blur border-b border-stone-100 px-4 lg:px-8 py-3 flex items-center gap-4">
                <button onclick="toggleSidebar()" class="text-stone-600 lg:hidden">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5"/></svg>
                </button>

                <div class="hidden md:flex items-center gap-2 bg-stone-50 border border-stone-200 rounded-xl px-4 py-2 flex-1 max-w-md">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="w-4 h-4 text-stone-400"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.34-4.34M19 11a8 8 0 1 1-16 0 8 8 0 0 1 16 0Z"/></svg>
                    <input type="text" placeholder="Search here..." class="bg-transparent outline-none text-sm w-full">
                </div>

                <div class="ml-auto flex items-center gap-1.5">

                    <a href="{{ route('vendor.dashboard') }}" class="icon-btn" title="Pending orders">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.85 23.85 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.26 24.26 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"/></svg>
                        @if(($stats['pending_orders'] ?? 0) > 0)
                            <span class="icon-badge">{{ $stats['pending_orders'] > 9 ? '9+' : $stats['pending_orders'] }}</span>
                        @endif
                    </a>

                    <x-dropdown align="right" width="52">
                        <x-slot name="trigger">
                            <button class="flex items-center gap-2 pl-3 ml-1 border-l border-stone-200 cursor-pointer">
                                <div class="w-8 h-8 rounded-full overflow-hidden flex-shrink-0 shadow-sm">
                                    <x-avatar :avatar="auth()->user()->avatar" :size="32" />
                                </div>
                                <div class="hidden sm:block text-left">
                                    <p class="text-xs font-bold text-stone-800 leading-tight">{{ auth()->user()->name }}</p>
                                    <p class="text-[10px] text-stone-400 leading-tight">{{ $vendor->business_name }}</p>
                                </div>
                                <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 text-stone-400 hidden sm:block"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('vendor.settings')">{{ __('Account Settings') }}</x-dropdown-link>

                            <form method="POST" action="{{ route('vendor.logout') }}" id="vendor-logout-form">
                                @csrf
                            </form>
                            <x-dropdown-link href="#" onclick="confirmVendorLogout()">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                </div>
            </header>

            <main class="p-4 lg:p-8">
                @if (session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-700 text-sm rounded-xl p-4 mb-6">
                        {{ session('success') }}
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function toggleSidebar() {
            document.getElementById('vendor-sidebar').classList.toggle('open');
            document.getElementById('sidebar-overlay').classList.toggle('hidden');
        }

        function confirmVendorLogout() {
            Swal.fire({
                title: 'Sign out of Vendor Panel?',
                text: 'You will need to sign in again next time.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, Log Out',
                cancelButtonText: 'Stay Here',
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#1B3B2F',
                customClass: { popup: 'rounded-2xl', confirmButton: 'rounded-xl', cancelButton: 'rounded-xl' }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('vendor-logout-form').submit();
                }
            });
        }
    </script>
    @stack('scripts')
</body>
</html>