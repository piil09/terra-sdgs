@props(['cta' => []])

@php
    $bgImg = asset('images/cta_bg.png');
    $btnLabel = $cta['button']['label'] ?? 'Explore Events';
    $btnUrl = $cta['button']['url'] ?? route('events');
@endphp

<!-- CTA SECTION (Figma: w=1440, h=520, bg #131713, Frame 157 w=1312, h=400, r=40px) -->
<section class="w-full bg-white py-12 md:py-20">
    <div class="max-w-[1440px] mx-auto px-6 md:px-16">
        <!-- Frame 157: Dark Card Container -->
        <div class="relative w-full rounded-[40px] bg-[#131713] overflow-hidden p-8 md:p-16 lg:p-20 text-white min-h-[400px] flex flex-col justify-between shadow-2xl">
            <!-- Background Image with Dark Overlay -->
            <div class="absolute inset-0 z-0 opacity-40 mix-blend-luminosity">
                <img src="{{ $bgImg }}" alt="Terra CTA Background" class="w-full h-full object-cover">
            </div>
            <div class="absolute inset-0 bg-gradient-to-r from-[#131713] via-[#131713]/85 to-transparent z-0"></div>

            <!-- Content Area (Z-Index 10) -->
            <div class="relative z-10 max-w-2xl flex flex-col gap-6">
                <!-- Tagline Badge -->
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/10 w-fit text-sm text-[#D6E3D4] font-medium font-heading">
                    <span class="w-2 h-2 rounded-full bg-[#5E745D]"></span>
                    <span>{{ $cta['tagline'] ?? 'Take Action Today' }}</span>
                </div>

                <!-- Main Heading -->
                <h2 class="font-heading font-medium text-3xl md:text-5xl lg:text-[56px] leading-[1.15] tracking-tight text-white">
                    {{ $cta['title'] ?? 'Ready to Make an Impact with Terra?' }}
                </h2>

                <!-- Subtitle -->
                <p class="font-sans font-normal text-base md:text-lg text-neutral-300 leading-relaxed max-w-xl">
                    {{ $cta['subtitle'] ?? 'Join thousands of youth and environmental advocates taking concrete actions to restore nature and preserve biodiversity.' }}
                </p>
            </div>

            <!-- CTA Action Button -->
            <div class="relative z-10 mt-8 pt-4">
                <a href="{{ $btnUrl }}" 
                   class="inline-flex items-center gap-3 px-8 py-4 rounded-full bg-[#5E745D] hover:bg-[#4B5D4A] text-white font-heading font-bold text-lg shadow-lg hover:shadow-xl transition-all duration-200 active:scale-95 group">
                    <span>{{ $btnLabel }}</span>
                    <i data-lucide="arrow-right" class="w-5 h-5 transition-transform duration-200 group-hover:translate-x-1"></i>
                </a>
            </div>
        </div>
    </div>
</section>
