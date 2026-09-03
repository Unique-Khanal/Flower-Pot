<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — Biruwa</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'DM Sans', sans-serif; background:#FBFAF6; }
        /* Nav text/icon colors reworked for the lighter sidebar green — the old
           #9FB3A6 had ~1.7–2.7:1 contrast against it (looks "blurry"/washed
           out). Near-white text + higher-opacity icons keep contrast >4:1. */
        .nav-link { color:rgba(255,255,255,.82); }
        .nav-link:hover { background:rgba(255,255,255,.10); color:#fff; }
        .nav-link.active { background:linear-gradient(135deg,#1B3B2F,#12281F); color:#fff; font-weight:600; box-shadow: inset 0 0 0 1px rgba(216,185,104,.35); }
        .nav-link.active .nav-icon { opacity:1; }
        .nav-icon { opacity:.85; }
        .nav-icon svg { width:18px; height:18px; }
        .stat-card { transition: transform .15s, box-shadow .15s; }
        .stat-card:hover { transform: translateY(-3px); box-shadow: 0 14px 28px rgba(27,59,47,.10); }
        .icon-btn { position:relative; width:2.25rem; height:2.25rem; display:flex; align-items:center; justify-content:center; border-radius:0.65rem; color:#5A6B5C; transition:background .15s; }
        .icon-btn:hover { background:#F3EEE0; }
        .icon-btn svg { width:19px; height:19px; }
        .icon-badge { position:absolute; top:-2px; right:-2px; min-width:16px; height:16px; padding:0 3px; border-radius:999px; background:#D8462F; color:#fff; font-size:9px; font-weight:800; display:flex; align-items:center; justify-content:center; line-height:1; }


        /* Robust two-column shell: flex, not fixed+padding — sidebar width and
           content offset can never desync at any viewport width. */
        .admin-shell { display:flex; min-height:100vh; }
        #admin-sidebar {
            width:16.5rem; flex-shrink:0;
            /* Deep-dived on this: sampled the logo's actual pixel colors
               (near-black wordmark ~#0A0701, gold accents ~#BE8A15, dark
               green leaves ~#216B39, orange pot ~#EF8E31) and ran a
               contrast-ratio search against candidate greens. Two things
               were fighting each other: black text wants a LIGHTER
               background, but the leaf graphic is the same hue as the
               sidebar so it only gets legible once the background is
               noticeably lighter than it (leaf luminance contrast <1.8 on
               anything darker). A light-to-dark gradient resolves both:
               the top (where the logo sits) is light sage so wordmark +
               leaf + gold + orange all read clearly; it deepens toward the
               bottom for a premium, grounded sidebar feel behind the nav. */
            background: linear-gradient(180deg, #75BC99 0%, #3F6B54 55%, #2E5442 100%);
            display:flex; flex-direction:column;
            position:relative; z-index:40;
            transition: margin-left .2s ease;
        }
        .admin-main { flex:1 1 0%; min-width:0; }

        @media (max-width: 1023px) {
            #admin-sidebar { position:fixed; inset:0 auto 0 0; width:16.5rem; margin-left:-16.5rem; }
            #admin-sidebar.open { margin-left:0; }
            .admin-main { width:100%; }
        }

        @media (max-width: 480px) {
            #admin-sidebar { width:85vw; margin-left:-85vw; }
        }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen">

    <div id="sidebar-overlay" class="fixed inset-0 bg-black/40 z-30 hidden lg:hidden" onclick="toggleSidebar()"></div>

    <div class="admin-shell">

        {{-- ═══ SIDEBAR ═══ --}}
        <aside id="admin-sidebar">

            <div class="px-5 py-5 border-b border-white/5">
                <x-application-logo class="h-9 w-auto object-contain" />
                <span class="block text-[9px] font-bold tracking-[0.2em] uppercase text-[#12281F] mt-2 ml-0.5">Admin Panel</span>
            </div>

            <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-0.5">

                <a href="{{ route('admin.dashboard') }}"
                   class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span class="nav-icon opacity-70">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10.5 12 4l9 6.5M5 9.5V19a1 1 0 0 0 1 1h4v-5.5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1V20h4a1 1 0 0 0 1-1V9.5"/></svg>
                    </span>
                    Dashboard
                </a>

                <p class="px-3 text-[10px] font-bold tracking-[0.15em] uppercase text-white/55 mt-5 mb-1">Vendor Management</p>
                <a href="{{ route('admin.vendors.index') }}"
                   class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition {{ request()->routeIs('admin.vendors.index') ? 'active' : '' }}">
                    <span class="nav-icon opacity-70">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="m9 12 2 2 4-4M7.835 4.697a3.42 3.42 0 0 0 1.976-.83 3.42 3.42 0 0 1 4.378 0 3.42 3.42 0 0 0 1.976.83 3.42 3.42 0 0 1 3.096 3.096 3.42 3.42 0 0 0 .83 1.976 3.42 3.42 0 0 1 0 4.378 3.42 3.42 0 0 0-.83 1.976 3.42 3.42 0 0 1-3.096 3.096 3.42 3.42 0 0 0-1.976.83 3.42 3.42 0 0 1-4.378 0 3.42 3.42 0 0 0-1.976-.83 3.42 3.42 0 0 1-3.096-3.096 3.42 3.42 0 0 0-.83-1.976 3.42 3.42 0 0 1 0-4.378 3.42 3.42 0 0 0 .83-1.976 3.42 3.42 0 0 1 3.096-3.096Z"/></svg>
                    </span>
                    Applications
                </a>
                <a href="{{ route('admin.vendors.directory') }}"
                   class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition {{ request()->routeIs('admin.vendors.directory') ? 'active' : '' }}">
                    <span class="nav-icon opacity-70">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5 5.25 4.5h13.5L21 7.5m-18 0v10.875c0 .621.504 1.125 1.125 1.125h15.75c.621 0 1.125-.504 1.125-1.125V7.5m-18 0h18M9 11.25h6"/></svg>
                    </span>
                    Vendor Directory
                </a>
                <a href="{{ route('admin.commission-negotiations.index') }}"
                   class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition {{ request()->routeIs('admin.commission-negotiations.*') ? 'active' : '' }}">
                    <span class="nav-icon opacity-70">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                    </span>
                    Commission Mgmt
                </a>

                <p class="px-3 text-[10px] font-bold tracking-[0.15em] uppercase text-white/55 mt-5 mb-1">Product Oversight</p>
                <a href="{{ route('admin.products.index') }}"
                   class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <span class="nav-icon opacity-70">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5 12 3 3 7.5m18 0-9 4.5m9-4.5v9L12 21m0-9L3 7.5m9 4.5v9m-9-9v9l9 4.5"/></svg>
                    </span>
                    Platform Products
                    @if($navPendingProducts > 0)
                        <span class="ml-auto text-[10px] font-bold bg-white/15 text-white px-1.5 py-0.5 rounded-full">{{ $navPendingProducts }}</span>
                    @endif
                </a>
                <a href="#" class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm opacity-60 cursor-not-allowed">
                    <span class="nav-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5v9a2.25 2.25 0 0 1-2.25 2.25h-12a2.25 2.25 0 0 1-2.25-2.25v-9M3.75 7.5 5.106 4.79A1.5 1.5 0 0 1 6.447 4h11.106a1.5 1.5 0 0 1 1.341.79L20.25 7.5m-16.5 0h16.5M9.75 11.25h4.5"/></svg>
                    </span>
                    Stock Oversight <span class="ml-auto text-[9px] bg-white/10 px-1.5 py-0.5 rounded">soon</span>
                </a>

                <p class="px-3 text-[10px] font-bold tracking-[0.15em] uppercase text-white/55 mt-5 mb-1">Orders &amp; Billing</p>
                <a href="{{ route('admin.billing.create') }}"
                   class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition {{ request()->routeIs('admin.billing.*') ? 'active' : '' }}">
                    <span class="nav-icon opacity-70">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 3h6m-9 6h12a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 18 4.5H6a2.25 2.25 0 0 0-2.25 2.25v12A2.25 2.25 0 0 0 6 21Zm3.75-15h4.5v3.75h-4.5V6Z"/></svg>
                    </span>
                    Billing
                </a>
                <a href="#" class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm opacity-60 cursor-not-allowed">
                    <span class="nav-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z"/></svg>
                    </span>
                    Vendor Payouts <span class="ml-auto text-[9px] bg-white/10 px-1.5 py-0.5 rounded">soon</span>
                </a>

                <p class="px-3 text-[10px] font-bold tracking-[0.15em] uppercase text-white/55 mt-5 mb-1">People &amp; Access</p>
                <a href="{{ route('admin.users.index') }}"
                   class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <span class="nav-icon opacity-70">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/></svg>
                    </span>
                    Users &amp; Roles
                </a>

                <p class="px-3 text-[10px] font-bold tracking-[0.15em] uppercase text-white/55 mt-5 mb-1">Content &amp; Support</p>
                <a href="#" class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm opacity-60 cursor-not-allowed">
                    <span class="nav-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/></svg>
                    </span>
                    Contact Messages <span class="ml-auto text-[9px] bg-white/10 px-1.5 py-0.5 rounded">soon</span>
                </a>
            </nav>

            <div class="border-t border-white/5 p-4 flex items-center gap-2.5">
                <div class="w-9 h-9 rounded-full overflow-hidden flex-shrink-0 shadow-sm">
                    <x-avatar :avatar="auth()->user()->avatar" :size="36" />
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-semibold text-white truncate">{{ auth()->user()->name ?? '' }}</p>
                    <p class="text-[10px] text-white/70 truncate">Administrator</p>
                </div>
                <button type="button" onclick="confirmAdminLogout()" class="text-white/70 hover:text-red-300 transition" title="Log out">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75"/></svg>
                </button>
            </div>
        </aside>

        {{-- ═══ MAIN ═══ --}}
        <div class="admin-main">

            <header class="sticky top-0 z-20 bg-white/95 backdrop-blur border-b border-stone-100 px-4 lg:px-8 py-3 flex items-center gap-4">
                <button onclick="toggleSidebar()" class="text-stone-600 lg:hidden">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5"/></svg>
                </button>

                <div class="hidden md:flex items-center gap-2 bg-stone-50 border border-stone-200 rounded-xl px-4 py-2 flex-1 max-w-md">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="w-4 h-4 text-stone-400"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.34-4.34M19 11a8 8 0 1 1-16 0 8 8 0 0 1 16 0Z"/></svg>
                    <input type="text" placeholder="Search here..." class="bg-transparent outline-none text-sm w-full">
                </div>

                <div class="ml-auto flex items-center gap-1.5">

                    <a href="{{ route('admin.vendors.index') }}" class="icon-btn" title="{{ $navAlertCount }} pending vendor/commission items">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.85 23.85 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.26 24.26 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"/></svg>
                        @if($navAlertCount > 0)
                            <span class="icon-badge">{{ $navAlertCount > 9 ? '9+' : $navAlertCount }}</span>
                        @endif
                    </a>

                    <span class="icon-btn opacity-50 cursor-not-allowed" title="Contact messages inbox — coming soon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/></svg>
                        @if($navUnreadContacts > 0)
                            <span class="icon-badge">{{ $navUnreadContacts > 9 ? '9+' : $navUnreadContacts }}</span>
                        @endif
                    </span>

                    <x-dropdown align="right" width="52">
                        <x-slot name="trigger">
                            <button class="flex items-center gap-2 pl-3 ml-1 border-l border-stone-200 cursor-pointer">
                                <div class="w-8 h-8 rounded-full overflow-hidden flex-shrink-0 shadow-sm">
                                    <x-avatar :avatar="auth()->user()->avatar" :size="32" />
                                </div>
                                <div class="hidden sm:block text-left">
                                    <p class="text-xs font-bold text-stone-800 leading-tight">{{ auth()->user()->name ?? '' }}</p>
                                    <p class="text-[10px] text-stone-400 leading-tight">Admin</p>
                                </div>
                                <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 text-stone-400 hidden sm:block"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('admin.settings')">{{ __('Profile') }}</x-dropdown-link>

                            <form method="POST" action="{{ route('admin.logout') }}" id="admin-logout-form">
                                @csrf
                            </form>
                            <x-dropdown-link href="#" onclick="confirmAdminLogout()">
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
            document.getElementById('admin-sidebar').classList.toggle('open');
            document.getElementById('sidebar-overlay').classList.toggle('hidden');
        }

        function confirmAdminLogout(formId = 'admin-logout-form') {
            Swal.fire({
                title: 'Sign out of Admin Panel? 🛠️',
                text: 'You will need to sign in and verify with OTP again next time.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, Log Out',
                cancelButtonText: 'Stay Here',
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#1B3B2F',
                borderRadius: '1rem',
                customClass: {
                    popup:         'rounded-2xl',
                    confirmButton: 'rounded-xl',
                    cancelButton:  'rounded-xl',
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        }

        /**
         * Shared confirmation dialog for admin actions that change state
         * (suspend, reactivate, role changes, commission decisions).
         * Call from a form's onsubmit: event.preventDefault(); adminConfirm(this, {...}); return false;
         */
        function adminConfirm(form, opts) {
            Swal.fire({
                title: opts.title,
                text: opts.text || '',
                icon: opts.icon || 'warning',
                showCancelButton: true,
                confirmButtonText: opts.confirmText || 'Confirm',
                cancelButtonText: 'Cancel',
                confirmButtonColor: opts.confirmColor || '#EF8E31',
                cancelButtonColor: '#3F6B54',
                customClass: {
                    popup:         'rounded-2xl',
                    confirmButton: 'rounded-xl',
                    cancelButton:  'rounded-xl',
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
            return false;
        }
    </script>
    @stack('scripts')
</body>
</html>