@props(['site', 'activeNav' => 'home'])

<nav id="main-navbar" class="sticky top-0 z-50 w-full bg-white border-b border-neutral-100 shadow-sm transition-all duration-300">
    <div class="max-w-[1440px] mx-auto px-6 md:px-16 h-[88px] flex items-center justify-between">
        <!-- Logo & Brand -->
        <div class="flex items-center gap-10">
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-full bg-[#EBF2EA] flex items-center justify-center text-[#5E745D] transition-transform duration-300 group-hover:scale-105">
                    <img src="{{ asset('svgs/logo.svg') }}" alt="Terra Logo" class="w-6 h-6 text-[#5E745D]">
                </div>
                <span class="font-heading font-medium text-2xl text-[#131713] tracking-tight">Terra</span>
            </a>

            <!-- Desktop Navigation Links -->
            <div class="hidden lg:flex items-center gap-1">
                @foreach($site['nav'] ?? [] as $item)
                    @php
                        $isActive = ($activeNav === $item['route'] || request()->is(trim($item['url'], '/')) || (request()->path() === '/' && $item['url'] === '/'));
                    @endphp
                    <a href="{{ $item['url'] }}" 
                       class="px-4 py-2 text-[16px] transition-colors rounded-full font-heading {{ $isActive ? 'font-bold text-[#131713] bg-neutral-100/60' : 'font-normal text-[#666666] hover:text-[#131713] hover:bg-neutral-50' }}">
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Desktop Action Buttons -->
        <div class="hidden md:flex items-center gap-4">
            <a href="{{ route('donate') }}" 
               class="px-6 py-3 rounded-full bg-[#5E745D] text-white font-heading font-bold text-[16px] shadow-sm hover:bg-[#4B5D4A] hover:shadow transition-all duration-200 active:scale-95 flex items-center gap-2">
                <i data-lucide="heart" class="w-4 h-4 fill-white/20"></i>
                <span>{{ $site['nav_actions']['donate']['label'] ?? 'Donate Us' }}</span>
            </a>
            
            <a href="{{ route('login') }}" 
               class="px-5 py-3 font-heading font-medium text-[18px] text-[#131713] hover:text-[#5E745D] transition-colors duration-200">
                {{ $site['nav_actions']['login']['label'] ?? 'Login' }}
            </a>
        </div>

        <!-- Mobile Menu Trigger -->
        <div class="flex items-center gap-2 lg:hidden">
            <a href="{{ route('donate') }}" class="px-4 py-2 rounded-full bg-[#5E745D] text-white text-xs font-bold font-heading">
                Donate
            </a>
            <button id="mobile-menu-btn" type="button" class="p-2 rounded-lg text-neutral-700 hover:bg-neutral-100" aria-label="Toggle Menu">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Drawer / Menu -->
    <div id="mobile-menu" class="hidden lg:hidden border-t border-neutral-100 bg-white px-6 py-6 shadow-xl animate-in slide-in-from-top-2">
        <div class="flex flex-col gap-3">
            @foreach($site['nav'] ?? [] as $item)
                @php
                    $isActive = ($activeNav === $item['route'] || request()->is(trim($item['url'], '/')));
                @endphp
                <a href="{{ $item['url'] }}" 
                   class="px-4 py-3 rounded-xl text-base font-heading {{ $isActive ? 'font-bold bg-[#EBF2EA] text-[#5E745D]' : 'text-neutral-700 hover:bg-neutral-50' }}">
                    {{ $item['label'] }}
                </a>
            @endforeach
            <hr class="my-2 border-neutral-100">
            <a href="{{ route('login') }}" class="px-4 py-3 rounded-xl font-heading font-medium text-neutral-800 hover:bg-neutral-50 flex items-center justify-between">
                <span>Login Account</span>
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>
    </div>
</nav>

<script>
    document.getElementById('mobile-menu-btn')?.addEventListener('click', () => {
        const menu = document.getElementById('mobile-menu');
        if (menu) menu.classList.toggle('hidden');
    });
</script>
