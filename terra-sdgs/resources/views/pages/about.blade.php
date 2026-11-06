@extends('layouts.app')

@section('title', 'About Us — Terra')
@section('meta_description', $about['hero']['subheadline'] ?? '')

@section('content')
<!-- ABOUT HERO SECTION (h=966) -->
<section class="w-full pt-4 pb-12">
    <div class="max-w-[1416px] mx-auto px-4 md:px-6">
        <div class="relative overflow-hidden rounded-[32px] min-h-[480px] md:min-h-[560px] flex items-center justify-center p-8 md:p-16 text-center shadow-xl">
            <img src="{{ asset('images/journey_hero.png') }}" alt="About Hero" class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/50 to-black/30 z-10"></div>

            <div class="relative z-20 max-w-[850px] flex flex-col items-center gap-6">
                <span class="px-4 py-1.5 rounded-full bg-white/20 backdrop-blur-md text-white text-sm font-heading font-medium tracking-wide">
                    {{ $about['hero']['badge'] ?? 'About Us' }}
                </span>

                <h1 class="font-heading font-medium text-4xl sm:text-5xl md:text-[64px] text-white leading-[1.15] tracking-tight">
                    {{ $about['hero']['headline'] }}
                </h1>

                <p class="text-neutral-200 text-lg md:text-[24px] font-normal leading-relaxed max-w-[700px]">
                    {{ $about['hero']['subheadline'] }}
                </p>

                <div class="pt-4 flex flex-wrap items-center justify-center gap-4">
                    <a href="{{ route('donate') }}" class="px-8 py-3.5 rounded-full bg-[#5E745D] hover:bg-[#4B5D4A] text-white font-heading font-bold text-base shadow-lg transition-all active:scale-95">
                        {{ $about['hero']['cta_donate']['label'] ?? 'Donate Us' }}
                    </a>
                    <a href="{{ route('login') }}" class="px-8 py-3.5 rounded-full bg-white/20 hover:bg-white/30 text-white font-heading font-medium text-base backdrop-blur-md transition-all">
                        {{ $about['hero']['cta_login']['label'] ?? 'Login' }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- OUR JOURNEY SECTION (h=945) -->
<section class="w-full py-16 md:py-24 bg-white">
    <div class="max-w-[1440px] mx-auto px-6 md:px-16 flex flex-col gap-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <!-- Left Narrative -->
            <div class="lg:col-span-7 flex flex-col gap-6">
                <span class="px-4 py-1 rounded-full bg-[#EBF2EA] text-[#5E745D] font-heading font-medium text-[16px] w-fit">
                    {{ $about['journey']['badge'] ?? 'Our Journey' }}
                </span>

                <h2 class="font-heading font-normal text-3xl sm:text-4xl md:text-[48px] text-[#131713] leading-[1.25]">
                    {{ $about['journey']['headline'] }}
                </h2>

                <div class="flex flex-col gap-4 text-[#4C4C4C] text-lg leading-relaxed pt-2">
                    @foreach($about['journey']['story'] ?? [] as $para)
                        <p>{{ $para }}</p>
                    @endforeach
                </div>
            </div>

            <!-- Right Featured Image -->
            <div class="lg:col-span-5 overflow-hidden rounded-[32px] shadow-xl h-[500px]">
                <img src="{{ asset('images/about_2.png') }}" alt="Our Journey" class="w-full h-full object-cover">
            </div>
        </div>

        <!-- 3-Image Gallery Row from Figma -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-6">
            @foreach($about['journey']['gallery'] ?? [] as $img)
                <div class="overflow-hidden rounded-[24px] h-[320px] shadow-md group">
                    <img src="{{ asset($img) }}" alt="Journey Gallery" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- GOALS SECTION (VISION, MISSION, VALUES) (h=396) -->
<section class="w-full py-20 bg-[#F9FAF9]">
    <div class="max-w-[1440px] mx-auto px-6 md:px-16">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($goals['items'] ?? [] as $item)
                <div class="p-8 md:p-10 rounded-[24px] bg-white border border-neutral-100 shadow-sm flex flex-col gap-4">
                    <div class="w-12 h-12 rounded-xl bg-[#EBF2EA] flex items-center justify-center text-[#5E745D]">
                        <img src="{{ asset($item['icon']) }}" alt="{{ $item['title'] }}" class="w-6 h-6">
                    </div>
                    <h3 class="font-heading font-bold text-2xl md:text-[32px] text-[#131713]">
                        {{ $item['title'] }}
                    </h3>
                    <p class="text-[#4C4C4C] text-base md:text-[20px] leading-relaxed">
                        {{ $item['description'] }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA SECTION -->
<x-cta :cta="$cta" :assets="$assets" />
@endsection
