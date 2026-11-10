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

    <!-- Sidebar Navigation (Exact Figma Frame: Navigasi admin w=224) -->
    <aside class="w-56 bg-white border-r border-slate-200/80 flex flex-col justify-between fixed inset-y-0 left-0 z-30 shadow-sm">
        <div>
            <!-- Brand Logo (Terra identity) -->
            <div class="h-20 flex items-center px-6 border-b border-slate-100">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-forest-700 flex items-center justify-center text-white shadow-md shadow-forest-700/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </div>
                    <div>
                        <span class="text-base font-bold tracking-tight text-slate-900 block leading-tight">Terra</span>
                        <span class="text-[10px] font-semibold text-forest-700 tracking-wider uppercase">Admin Portal</span>
                    </div>
                </a>
            </div>

            <!-- Workspace label / badge -->
            <div class="px-5 py-4 border-b border-slate-100 bg-slate-50/50">
                <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Workspace</div>
                <div class="text-xs font-semibold text-slate-700 mt-0.5 truncate">Terra Environment ID</div>
            </div>

            <!-- Navigation Menu Items (Exact Figma Navigation) -->
            <div class="px-3 py-6 space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium text-xs transition-all {{ ($activeNav ?? '') === 'dashboard' ? 'bg-forest-50 text-forest-700 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <svg class="w-4 h-4 {{ ($activeNav ?? '') === 'dashboard' ? 'text-forest-700' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('admin.events') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium text-xs transition-all {{ ($activeNav ?? '') === 'events' ? 'bg-forest-50 text-forest-700 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <svg class="w-4 h-4 {{ ($activeNav ?? '') === 'events' ? 'text-forest-700' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span>Event</span>
                </a>

                <a href="{{ route('admin.participants') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium text-xs transition-all {{ ($activeNav ?? '') === 'participants' ? 'bg-forest-50 text-forest-700 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <svg class="w-4 h-4 {{ ($activeNav ?? '') === 'participants' ? 'text-forest-700' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <span>Peserta</span>
                </a>

                <a href="{{ route('admin.articles') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium text-xs transition-all {{ ($activeNav ?? '') === 'articles' ? 'bg-forest-50 text-forest-700 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <svg class="w-4 h-4 {{ ($activeNav ?? '') === 'articles' ? 'text-forest-700' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                    <span>Artikel</span>
                </a>

                <a href="{{ route('admin.users') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium text-xs transition-all {{ ($activeNav ?? '') === 'users' ? 'bg-forest-50 text-forest-700 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <svg class="w-4 h-4 {{ ($activeNav ?? '') === 'users' ? 'text-forest-700' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <span>Pengguna & admin</span>
                </a>

                <a href="{{ route('admin.logs') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium text-xs transition-all {{ ($activeNav ?? '') === 'logs' ? 'bg-forest-50 text-forest-700 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <svg class="w-4 h-4 {{ ($activeNav ?? '') === 'logs' ? 'text-forest-700' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Log aktivitas</span>
                </a>
            </div>
        </div>

        <!-- Support / Public website link -->
        <div class="p-4 border-t border-slate-100 space-y-3">
            <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-2 text-xs font-semibold text-slate-600 hover:text-forest-700 transition-colors">
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                </svg>
                <span>Public website</span>
            </a>
            
            <div class="flex items-center gap-3 pt-2 border-t border-slate-100">
                <div class="w-8 h-8 rounded-full bg-forest-100 text-forest-800 font-bold flex items-center justify-center text-xs">
                    GG
                </div>
                <div class="min-w-0 flex-1">
                    <div class="text-xs font-bold text-slate-900 truncate">Gavril Ghazanfar</div>
                    <div class="text-[10px] text-slate-400 truncate">Administrator</div>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content wrapper -->
    <div class="flex-1 ml-56 flex flex-col min-h-screen">
        <!-- Top Header Bar -->
        <header class="h-20 bg-white border-b border-slate-200/80 px-8 flex items-center justify-between sticky top-0 z-20">
            <div class="flex items-center gap-2 text-xs font-semibold text-slate-500">
                <span>Terra</span>
                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-slate-900 font-bold">@yield('breadcrumb', 'Dashboard')</span>
            </div>

            <!-- Header Account Controls -->
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-3">
                    <svg class="w-4 h-4 text-slate-400 cursor-pointer hover:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <svg class="w-4 h-4 text-slate-400 cursor-pointer hover:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                </div>
                <div class="h-6 w-px bg-slate-200"></div>
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-slate-200 font-bold text-slate-700 flex items-center justify-center text-xs">GG</div>
                    <div>
                        <div class="text-xs font-bold text-slate-900 leading-none">Gavril</div>
                        <div class="text-[10px] text-slate-400">Super Admin</div>
                    </div>
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
            </div>
        </header>

        <!-- Main Body Content -->
        <main class="p-8 flex-1">
            @if(session('success'))
                <div class="mb-6 p-4 rounded-xl bg-forest-50 border border-forest-200 text-forest-800 text-xs flex items-center gap-3">
                    <svg class="w-4 h-4 text-forest-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
