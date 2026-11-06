<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Terra — Sustainable Green Environment Community')</title>
    <meta name="description" content="@yield('meta_description', 'Turn intention into impact. Preserve the earth, together.')">
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('svgs/logo.svg') }}">

    <!-- Vite compiled styles & scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-[#191919] min-h-screen flex flex-col antialiased selection:bg-[#5E745D] selection:text-white">
    <!-- Navbar Component -->
    <x-navbar :site="$site ?? []" :activeNav="$activeNav ?? 'home'" />

    <!-- Main Page Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer Component -->
    <x-footer :site="$site ?? []" />

    <!-- Flash message toast if present -->
    @if(session('success'))
        <div id="flash-toast" class="fixed bottom-6 right-6 z-50 max-w-md bg-[#131713] text-white p-4 rounded-2xl shadow-2xl border border-[#5E745D] flex items-start gap-3 animate-in slide-in-from-bottom-5">
            <div class="w-8 h-8 rounded-full bg-[#5E745D] flex items-center justify-center shrink-0">
                <i data-lucide="check" class="w-5 h-5 text-white"></i>
            </div>
            <div class="flex-grow text-sm">
                <p class="font-bold font-heading text-base text-[#D6E3D4]">Berhasil!</p>
                <p class="text-neutral-300 mt-0.5">{{ session('success') }}</p>
            </div>
            <button onclick="document.getElementById('flash-toast').remove()" class="text-neutral-400 hover:text-white">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>
        <script>
            setTimeout(() => {
                const toast = document.getElementById('flash-toast');
                if (toast) toast.remove();
            }, 6000);
        </script>
    @endif
</body>
</html>
