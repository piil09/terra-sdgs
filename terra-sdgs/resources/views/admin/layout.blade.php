<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Terra SDGs</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        forest: {
                            50: '#F0FDF4',
                            100: '#DCFCE7',
                            200: '#BBF7D0',
                            500: '#22C55E',
                            600: '#16A34A',
                            700: '#15803D',
                            800: '#166534',
                            900: '#14532D',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #F8FAF9;
        }
    </style>
</head>
<body class="text-slate-800 antialiased min-h-screen flex bg-[#F8FAF9]">

    <!-- Sidebar Navigation -->
    <aside class="w-64 bg-white border-r border-slate-200/80 flex flex-col justify-between fixed inset-y-0 left-0 z-30 shadow-sm">
        <div>
            <!-- Brand Logo -->
            <div class="h-20 flex items-center px-6 border-b border-slate-100">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-forest-700 flex items-center justify-center text-white shadow-md shadow-forest-700/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </div>
                    <div>
                        <span class="text-lg font-bold tracking-tight text-slate-900 block leading-tight">Terra SDGs</span>
                        <span class="text-xs font-semibold text-forest-700 tracking-wider uppercase">Admin Portal</span>
                    </div>
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="px-4 py-6 space-y-1.5">
                <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider px-3 mb-2">Menu Utama</div>
                
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium text-sm transition-all {{ ($activeNav ?? '') === 'dashboard' ? 'bg-forest-50 text-forest-700 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <svg class="w-5 h-5 {{ ($activeNav ?? '') === 'dashboard' ? 'text-forest-700' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('admin.projects') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium text-sm transition-all {{ ($activeNav ?? '') === 'projects' ? 'bg-forest-50 text-forest-700 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <svg class="w-5 h-5 {{ ($activeNav ?? '') === 'projects' ? 'text-forest-700' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    <span>Proyek Konservasi</span>
                    <span class="ml-auto text-xs px-2 py-0.5 rounded-full bg-forest-100 text-forest-800 font-semibold">12</span>
                </a>

                <a href="{{ route('admin.donations') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium text-sm transition-all {{ ($activeNav ?? '') === 'donations' ? 'bg-forest-50 text-forest-700 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <svg class="w-5 h-5 {{ ($activeNav ?? '') === 'donations' ? 'text-forest-700' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Donasi & Transaksi</span>
                </a>

                <a href="{{ route('admin.users') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium text-sm transition-all {{ ($activeNav ?? '') === 'users' ? 'bg-forest-50 text-forest-700 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <svg class="w-5 h-5 {{ ($activeNav ?? '') === 'users' ? 'text-forest-700' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <span>Pengguna & Tim</span>
                </a>

                <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider px-3 pt-6 mb-2">Situs Publik</div>
                
                <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium text-sm text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-all">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                    <span>Lihat Website</span>
                </a>
            </div>
        </div>

        <!-- User Profile footer -->
        <div class="p-4 border-t border-slate-100">
            <div class="flex items-center gap-3 p-2 rounded-xl bg-slate-50/80 border border-slate-100">
                <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&auto=format&fit=crop&q=80" alt="Avatar" class="w-9 h-9 rounded-full object-cover">
                <div class="min-w-0 flex-1">
                    <div class="text-sm font-semibold text-slate-900 truncate">Gavril Ghazanfar</div>
                    <div class="text-xs text-slate-400 truncate">Administrator</div>
                </div>
                <a href="{{ route('login') }}" title="Logout" class="text-slate-400 hover:text-red-500 p-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                </a>
            </div>
        </div>
    </aside>

    <!-- Main Content wrapper -->
    <div class="flex-1 ml-64 flex flex-col min-h-screen">
        <!-- Top Header Bar -->
        <header class="h-20 bg-white border-b border-slate-200/80 px-8 flex items-center justify-between sticky top-0 z-20">
            <div class="flex items-center gap-4">
                <h1 class="text-xl font-bold text-slate-900">@yield('page_title', 'Dashboard')</h1>
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    Live System
                </span>
            </div>

            <!-- Header Actions -->
            <div class="flex items-center gap-4">
                <div class="relative">
                    <input type="text" placeholder="Cari proyek, donatur, atau artikel..." class="w-72 pl-10 pr-4 py-2 rounded-xl text-sm border border-slate-200 focus:outline-none focus:border-forest-600 focus:ring-1 focus:ring-forest-600 bg-slate-50/50">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>

                <button class="relative p-2 rounded-xl text-slate-500 hover:bg-slate-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                    <span class="absolute top-1.5 right-1.5 w-2 h-2 rounded-full bg-forest-600"></span>
                </button>
            </div>
        </header>

        <!-- Main Body Content -->
        <main class="p-8 flex-1">
            @if(session('success'))
                <div class="mb-6 p-4 rounded-xl bg-forest-50 border border-forest-200 text-forest-800 text-sm flex items-center gap-3">
                    <svg class="w-5 h-5 text-forest-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

</body>
</html>
