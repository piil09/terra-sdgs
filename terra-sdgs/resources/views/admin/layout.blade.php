<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Terra SDGs</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        terra: {
                            primary: '#5E745D',
                            hover: '#4B5D4A',
                            dark: '#131713',
                            light: '#EBF2EA',
                            subtle: '#D6E3D4',
                            bg: '#F8FAF9',
                            card: '#FFFFFF',
                            border: '#E5E7EB',
                            text: '#131713',
                            muted: '#646464'
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
            color: #131713;
        }
    </style>
</head>
<body class="text-[#131713] antialiased min-h-screen flex bg-[#F8FAF9]">

    <!-- Sidebar Navigation (Exact Figma Frame: Navigasi admin w=224, bg #FFFFFF, border #E5E7EB) -->
    <aside class="w-56 bg-white border-r border-[#E5E7EB] flex flex-col justify-between fixed inset-y-0 left-0 z-30 shadow-sm">
        <div>
            <!-- Brand Logo (Terra identity) -->
            <div class="h-20 flex items-center px-6 border-b border-neutral-100">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-[#EBF2EA] flex items-center justify-center text-[#5E745D]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </div>
                    <div>
                        <span class="text-base font-bold tracking-tight text-[#131713] block leading-tight">Terra</span>
                        <span class="text-[10px] font-semibold text-[#5E745D] tracking-wider uppercase">Admin Portal</span>
                    </div>
                </a>
            </div>

            <!-- Workspace label (Figma: Workspace) -->
            <div class="px-5 py-4 border-b border-neutral-100 bg-[#F9FAF9]">
                <div class="text-[11px] font-bold text-neutral-400 uppercase tracking-wider">Workspace</div>
                <div class="text-xs font-semibold text-[#131713] mt-0.5 truncate">Terra Environment ID</div>
            </div>

            <!-- Navigation Menu Items (Exact Figma Menu Icons & Labels) -->
            <div class="px-3 py-6 space-y-1">
                <!-- 1. Dashboard -->
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-xs transition-all {{ ($activeNav ?? '') === 'dashboard' ? 'bg-[#EBF2EA] text-[#5E745D] font-bold' : 'text-[#646464] hover:bg-[#F9FAF9] hover:text-[#131713]' }}">
                    <svg class="w-4 h-4 {{ ($activeNav ?? '') === 'dashboard' ? 'text-[#5E745D]' : 'text-neutral-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>
                    <span>Dashboard</span>
                </a>

                <!-- 2. Event -->
                <a href="{{ route('admin.events') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-xs transition-all {{ ($activeNav ?? '') === 'events' ? 'bg-[#EBF2EA] text-[#5E745D] font-bold' : 'text-[#646464] hover:bg-[#F9FAF9] hover:text-[#131713]' }}">
                    <svg class="w-4 h-4 {{ ($activeNav ?? '') === 'events' ? 'text-[#5E745D]' : 'text-neutral-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span>Event</span>
                </a>

                <!-- 3. Peserta -->
                <a href="{{ route('admin.participants') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-xs transition-all {{ ($activeNav ?? '') === 'participants' ? 'bg-[#EBF2EA] text-[#5E745D] font-bold' : 'text-[#646464] hover:bg-[#F9FAF9] hover:text-[#131713]' }}">
                    <svg class="w-4 h-4 {{ ($activeNav ?? '') === 'participants' ? 'text-[#5E745D]' : 'text-neutral-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <span>Peserta</span>
                </a>

                <!-- 4. Artikel -->
                <a href="{{ route('admin.articles') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-xs transition-all {{ ($activeNav ?? '') === 'articles' ? 'bg-[#EBF2EA] text-[#5E745D] font-bold' : 'text-[#646464] hover:bg-[#F9FAF9] hover:text-[#131713]' }}">
                    <svg class="w-4 h-4 {{ ($activeNav ?? '') === 'articles' ? 'text-[#5E745D]' : 'text-neutral-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                    <span>Artikel</span>
                </a>

                <!-- 5. Pengguna & admin -->
                <a href="{{ route('admin.users') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-xs transition-all {{ ($activeNav ?? '') === 'users' ? 'bg-[#EBF2EA] text-[#5E745D] font-bold' : 'text-[#646464] hover:bg-[#F9FAF9] hover:text-[#131713]' }}">
                    <svg class="w-4 h-4 {{ ($activeNav ?? '') === 'users' ? 'text-[#5E745D]' : 'text-neutral-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span>Pengguna & admin</span>
                </a>

                <!-- 6. Log aktivitas -->
                <a href="{{ route('admin.logs') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-xs transition-all {{ ($activeNav ?? '') === 'logs' ? 'bg-[#EBF2EA] text-[#5E745D] font-bold' : 'text-[#646464] hover:bg-[#F9FAF9] hover:text-[#131713]' }}">
                    <svg class="w-4 h-4 {{ ($activeNav ?? '') === 'logs' ? 'text-[#5E745D]' : 'text-neutral-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Log aktivitas</span>
                </a>
            </div>
        </div>

        <!-- Support / Public website link & Admin Profile Card -->
        <div class="p-4 border-t border-[#E5E7EB] space-y-3">
            <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-2 text-xs font-semibold text-[#646464] hover:text-[#5E745D] transition-colors">
                <svg class="w-4 h-4 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                </svg>
                <span>Public website</span>
            </a>
            
            <div class="flex items-center justify-between pt-2 border-t border-neutral-100">
                <div class="flex items-center gap-2.5 min-w-0">
                    <div class="w-8 h-8 rounded-full bg-[#EBF2EA] text-[#5E745D] font-bold flex items-center justify-center text-xs shrink-0">
                        GG
                    </div>
                    <div class="min-w-0 flex-1">
                        <div class="text-xs font-bold text-[#131713] truncate">Gavril</div>
                        <div class="text-[10px] text-neutral-400 truncate">Super Admin</div>
                    </div>
                </div>
                
                <!-- Logout button form -->
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" title="Logout" class="p-1.5 rounded-lg text-neutral-400 hover:text-red-600 hover:bg-red-50 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content wrapper -->
    <div class="flex-1 ml-56 flex flex-col min-h-screen">
        <!-- Top Header Bar (Figma: Header w=1216, h=80) -->
        <header class="h-20 bg-white border-b border-[#E5E7EB] px-8 flex items-center justify-between sticky top-0 z-20">
            <div class="flex items-center gap-2 text-xs font-semibold text-[#646464]">
                <span>Terra</span>
                <svg class="w-3.5 h-3.5 text-neutral-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-[#131713] font-bold">@yield('breadcrumb', 'Dashboard')</span>
            </div>

            <!-- Header Account Controls (Figma: Account search, bell, divider, Admin profile) -->
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-3">
                    <button class="p-1.5 text-neutral-400 hover:text-[#131713] transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                    <button class="p-1.5 text-neutral-400 hover:text-[#131713] transition-colors relative">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                    </button>
                </div>
                <div class="h-6 w-px bg-neutral-200"></div>
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-[#EBF2EA] font-bold text-[#5E745D] flex items-center justify-center text-xs">GG</div>
                    <div>
                        <div class="text-xs font-bold text-[#131713] leading-none">Gavril</div>
                        <div class="text-[10px] text-neutral-400">Super Admin</div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Body Content -->
        <main class="p-8 flex-1">
            @if(session('success'))
                <div class="mb-6 p-4 rounded-xl bg-[#EBF2EA] border border-[#D6E3D4] text-[#384638] text-xs flex items-center gap-3">
                    <svg class="w-4 h-4 text-[#5E745D] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
