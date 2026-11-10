<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terra Admin — Login</title>
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
                            border: '#E5E7EB',
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
<body class="h-full flex items-center justify-center p-3 sm:p-6 bg-[#F8FAF9] overflow-x-hidden">

    <!-- Main Container Card (Exact Figma proportions w=1380, h=760 max-height screen fit) -->
    <div class="w-full max-w-[1320px] bg-white rounded-[28px] border border-[#E5E7EB] shadow-xl overflow-hidden grid grid-cols-1 lg:grid-cols-12 min-h-[700px]">
        
        <!-- Left Column: Form & Identity -->
        <div class="lg:col-span-6 p-6 sm:p-10 lg:p-12 flex flex-col justify-between overflow-y-auto min-h-[700px]">
            <!-- Terra Brand Identity -->
            <div class="flex items-center gap-2.5">
                <div class="w-9 h-9 rounded-full bg-[#EBF2EA] flex items-center justify-center text-[#5E745D]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                </div>
                <span class="text-xl font-bold tracking-tight text-[#131713]">Terra</span>
            </div>

            <!-- Login Form Area -->
            <div class="my-auto py-4 max-w-[420px] w-full mx-auto">
                <!-- Admin Badge & Header -->
                <div class="mb-5">
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#EBF2EA] text-[#5E745D] text-[11px] font-bold mb-2.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                        <span>Portal Akses Administrator</span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-[#131713] tracking-tight">Selamat Datang Kembali</h1>
                    <p class="text-xs text-neutral-500 mt-1.5 leading-relaxed">Masuk untuk mengelola kegiatan pelestarian, pendaftar relawan, dan publikasi edukasi Terra SDGs.</p>
                </div>

                @if(session('error'))
                    <div class="mb-3 p-2.5 rounded-xl bg-red-50 border border-red-200 text-red-700 text-xs font-medium">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-3.5">
                    @csrf
                    <div>
                        <label class="block text-[11px] font-bold text-[#131713] mb-1">Alamat Email Administrator</label>
                        <input type="email" name="email" placeholder="admin@terra-sdgs.id" required
                               class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-[#E5E7EB] focus:outline-none focus:border-[#5E745D] focus:ring-1 focus:ring-[#5E745D] bg-[#F9FAF9]">
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label class="text-[11px] font-bold text-[#131713]">Kata Sandi</label>
                            <a href="#" class="text-[10px] font-semibold text-[#5E745D] hover:underline">Lupa sandi?</a>
                        </div>
                        <input type="password" name="password" placeholder="••••••••" required
                               class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-[#E5E7EB] focus:outline-none focus:border-[#5E745D] focus:ring-1 focus:ring-[#5E745D] bg-[#F9FAF9]">
                    </div>

                    <div class="flex items-center justify-between pt-0.5">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="remember" class="w-3.5 h-3.5 rounded text-[#5E745D] focus:ring-[#5E745D] border-neutral-300">
                            <span class="text-[11px] text-neutral-600 font-medium">Ingat saya untuk 30 hari</span>
                        </label>
                    </div>

                    <button type="submit" class="w-full py-3 rounded-full bg-[#5E745D] hover:bg-[#4B5D4A] text-white font-bold text-xs shadow-md transition-all">
                        Masuk ke Dashboard Admin &rarr;
                    </button>
                </form>

                <!-- Security Note -->
                <div class="mt-4 p-3 rounded-xl bg-[#F8FAF9] border border-[#E5E7EB] flex items-center gap-2.5">
                    <svg class="w-4 h-4 text-[#5E745D] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                    <p class="text-[10px] text-neutral-500 leading-snug">Akses ini terenkripsi dan terlindungi otentikasi internal Terra Foundation.</p>
                </div>
            </div>

            <!-- Footer Note -->
            <div class="mt-4 flex items-center justify-between text-[11px] text-neutral-400 border-t border-neutral-100 pt-3">
                <span>© 2026 Terra Foundation</span>
                <a href="{{ route('home') }}" class="text-[#5E745D] font-semibold hover:underline">Kembali ke Website Utama</a>
            </div>
            <div class="flex items-center justify-between text-[10px] text-neutral-400 border-t border-neutral-100 pt-3">
                <span>© 2026 Terra Foundation</span>
                <a href="{{ route('home') }}" class="text-[#5E745D] font-semibold hover:underline">Kembali ke Website Utama</a>
            </div>
        </div>

        <!-- Right Column: Visual Story Panel (Fits container height properly) -->
        <div class="hidden lg:flex lg:col-span-6 relative p-8 lg:p-10 flex-col justify-end text-white overflow-hidden m-2.5 rounded-[24px]">
            <img src="{{ asset('images/about_1.png') }}" alt="Garden Story" class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-[#131713]/95 via-[#131713]/60 via-40% to-transparent"></div>

            <div class="relative z-10 max-w-lg space-y-2.5">
                <span class="inline-block px-3 py-1 rounded-full bg-white/20 backdrop-blur-md text-[11px] font-semibold text-[#D6E3D4]">
                    Conservation & Community
                </span>
                <h2 class="text-2xl lg:text-3xl font-extrabold leading-tight text-white">
                    Memimpin Gerakan Aksi Nyata Pelestarian Bumi
                </h2>
                <p class="text-xs text-neutral-200 leading-relaxed">
                    Setiap pohon yang ditanam, setiap kilogram sampah yang dibersihkan, dan setiap relawan yang teredukasi membawa dampak nyata untuk masa depan berkelanjutan.
                </p>
                <div class="pt-1 flex items-center gap-6 text-xs text-neutral-300 font-medium">
                    <div><span class="font-bold text-white text-xs block">12+</span> Event Aktif</div>
                    <div><span class="font-bold text-white text-xs block">1.200+</span> Relawan</div>
                    <div><span class="font-bold text-white text-xs block">5.000+</span> Pohon</div>
                </div>
            </div>
        </div>

    </div>

</body>
</html>
