@props(['site'])

<!-- FOOTER (Figma: w=1440, h=147, bg #131713, Frame 221 w=1312, h=51, and centered ©terra2025) -->
<footer class="w-full bg-[#131713] text-white py-8 border-t border-white/5">
    <div class="max-w-[1440px] mx-auto px-6 md:px-16 flex flex-col items-center gap-6">
        <!-- Frame 221: Logo Left | Links Center | Join Now Right -->
        <div class="w-full flex flex-col md:flex-row items-center justify-between gap-6 pb-4 border-b border-white/10">
            <!-- Frame 158: Brand Logo & Name -->
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-[#EBF2EA] flex items-center justify-center text-[#5E745D]">
                    <img src="{{ asset('svgs/logo.svg') }}" alt="Terra Logo" class="w-6 h-6 text-[#5E745D]">
                </div>
                <span class="font-heading font-medium text-[32px] tracking-tight text-white leading-none">Terra</span>
            </div>

            <!-- Frame 165: Navigation Links -->
            <div class="flex flex-wrap items-center justify-center gap-6 md:gap-8 text-neutral-300 font-heading text-[16px]">
                @foreach($site['nav'] ?? [] as $item)
                    <a href="{{ $item['url'] }}" class="hover:text-white transition-colors duration-200">
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </div>

            <!-- Button: Join Now (w=127, h=51) -->
            <div>
                <a href="{{ route('events.register') }}" 
                   class="px-8 py-3.5 rounded-full bg-[#5E745D] hover:bg-[#4B5D4A] text-white font-heading font-bold text-[18px] transition-all duration-200 active:scale-95 inline-block shadow">
                    {{ $site['footer']['cta_button']['label'] ?? 'Join Now' }}
                </a>
            </div>
        </div>

        <!-- Centered Copyright (©terra2025, 16px Regular) -->
        <div class="text-[16px] text-neutral-400 font-normal">
            {{ $site['footer']['copyright'] ?? '©terra2025' }}
        </div>
    </div>
</footer>
