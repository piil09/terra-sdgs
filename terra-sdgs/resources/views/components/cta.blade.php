@props(['cta' => null, 'assets' => null])

@php
    $headline = $cta['headline'] ?? 'Support Our Movement';
    $subheadline = $cta['subheadline'] ?? 'Every contribution you make helps create a greener and more sustainable environment.';
    $btnLabel = $cta['button']['label'] ?? 'Donate Now';
    $btnUrl = $cta['button']['url'] ?? route('donate');
@endphp

<!-- CTA SECTION (Figma: w=1440, h=764, Container w=1416, h=740, Centered content surrounded by 4 floating image cards) -->
<section class="w-full py-8 md:py-16">
    <div class="max-w-[1416px] mx-auto px-4 md:px-6">
        <div class="relative overflow-hidden rounded-[32px] bg-[#192119] min-h-[580px] lg:h-[740px] flex items-center justify-center p-6 md:p-12 shadow-2xl">
            <!-- Background subtle overlay -->
            <img src="{{ asset('images/cta_bg.png') }}" alt="CTA Background" class="absolute inset-0 w-full h-full object-cover opacity-15">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent z-10"></div>

            <!-- Floating 4 Image Cards around center (Figma: Rectangles 29, 30, 31, 32 of 216x216) -->
            <!-- Top-Left Floating Card (Rectangle 29) -->
            <div class="hidden lg:block absolute top-12 left-12 w-[200px] xl:w-[216px] h-[200px] xl:h-[216px] rounded-[24px] overflow-hidden shadow-2xl z-20 transform hover:-translate-y-1 transition-transform">
                <img src="{{ asset('images/cta_grid1.png') }}" alt="Terra Nature 1" class="w-full h-full object-cover">
            </div>

            <!-- Top-Right Floating Card (Rectangle 30) -->
            <div class="hidden lg:block absolute top-12 right-12 w-[200px] xl:w-[216px] h-[200px] xl:h-[216px] rounded-[24px] overflow-hidden shadow-2xl z-20 transform hover:-translate-y-1 transition-transform">
                <img src="{{ asset('images/cta_grid2.png') }}" alt="Terra Nature 2" class="w-full h-full object-cover">
            </div>

            <!-- Bottom-Left Floating Card (Rectangle 32) -->
            <div class="hidden lg:block absolute bottom-12 left-28 xl:left-36 w-[200px] xl:w-[216px] h-[200px] xl:h-[216px] rounded-[24px] overflow-hidden shadow-2xl z-20 transform hover:-translate-y-1 transition-transform">
                <img src="{{ asset('images/about_2.png') }}" alt="Terra Nature 3" class="w-full h-full object-cover">
            </div>

            <!-- Bottom-Right Floating Card (Rectangle 31) -->
            <div class="hidden lg:block absolute bottom-12 right-28 xl:right-36 w-[200px] xl:w-[216px] h-[200px] xl:h-[216px] rounded-[24px] overflow-hidden shadow-2xl z-20 transform hover:-translate-y-1 transition-transform">
                <img src="{{ asset('images/cta_grid4.png') }}" alt="Terra Nature 4" class="w-full h-full object-cover">
            </div>

            <!-- Centered Text Block (Frame 198 in Figma: w=684, h=221) -->
            <div class="relative z-30 max-w-[684px] mx-auto flex flex-col items-center text-center gap-6">
                <!-- Headline (64px Medium #FFFFFF) -->
                <h2 class="font-heading font-medium text-3xl sm:text-4xl md:text-5xl lg:text-[64px] text-white leading-[1.15] tracking-tight">
                    {{ $headline }}
                </h2>

                <!-- Subheadline (24px Regular #FFFFFF) -->
                <p class="text-neutral-200 text-base sm:text-lg md:text-[22px] lg:text-[24px] font-normal leading-relaxed max-w-[667px]">
                    {{ $subheadline }}
                </p>

                <!-- Button (w=152, h=46, bg #5E745D, 18px Bold) -->
                <div class="pt-2">
                    <a href="{{ $btnUrl }}" 
                       class="px-8 py-3.5 rounded-full bg-[#5E745D] hover:bg-[#4B5D4A] text-white font-heading font-bold text-[18px] shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 active:scale-95 inline-flex items-center justify-center">
                        {{ $btnLabel }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
