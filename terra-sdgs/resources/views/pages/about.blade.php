@extends('layouts.app')

@section('title', 'About Us — Terra')
@section('meta_description', 'United for a Greener Future. A community driving positive environmental change.')

@section('content')
<!-- 1. HERO SECTION (Exact Figma Screen from image_071c22.png) -->
<section class="w-full pt-16 pb-20 bg-white overflow-hidden">
    <div class="max-w-[1440px] mx-auto px-6 md:px-12 flex flex-col items-center">
        <!-- Frame 205: Centered Content Block -->
        <div class="flex flex-col items-center text-center max-w-[620px] mx-auto">
            <!-- Badge: About Us (Pill bg #5E745D, text white) -->
            <span class="px-6 py-2 rounded-full bg-[#5E745D] text-white font-heading font-medium text-[15px] shadow-sm">
                About Us
            </span>

            <!-- Main Headline: Split on 2 lines matching image_071c22.png -->
            <h1 class="font-heading font-normal text-4xl sm:text-5xl lg:text-[56px] text-[#0F0F0F] leading-[1.15] tracking-tight mt-6">
                United for a<br>Greener Future
            </h1>

            <!-- Subtitle: Split on 2 lines matching image_071c22.png -->
            <p class="text-[#646464] text-base sm:text-lg md:text-[20px] font-normal leading-relaxed max-w-[480px] mt-4">
                A community driving positive environmental<br class="hidden sm:inline">change.
            </p>

            <!-- Dual Buttons: Left is light gray pill, Right is green pill (Exact image_071c22.png styling) -->
            <div class="flex items-center justify-center gap-4 mt-8">
                <a href="{{ route('events.register') }}" 
                   class="px-8 py-3.5 rounded-full bg-[#F3F4F6] hover:bg-[#E5E7EB] text-[#111827] font-heading font-bold text-base transition-all duration-200 active:scale-95 shadow-sm">
                    Join Volunteer
                </a>
                <a href="{{ route('login') }}" 
                   class="px-8 py-3.5 rounded-full bg-[#5E745D] hover:bg-[#4B5D4A] text-white font-heading font-bold text-base transition-all duration-200 active:scale-95 shadow-md">
                    Login
                </a>
            </div>
        </div>

        <!-- Frame 206: 3-Image Showcase Collage (Exact image_071c22.png asset matching) -->
        <div class="w-full max-w-[1360px] mt-16 relative flex flex-col md:flex-row items-center justify-center gap-4 md:gap-0">
            <!-- Left Card: Lush Forest Trail (Rectangle 33, rounded-3xl) -->
            <div class="w-full md:w-[440px] h-[320px] md:h-[390px] rounded-[32px] overflow-hidden shadow-lg shrink-0 md:translate-x-8 z-10">
                <img src="{{ asset('images/about_hero_left_woodland.png') }}" alt="Dense Forest Trail" class="w-full h-full object-cover">
            </div>

            <!-- Center Prominent Card: Aerial Forest Road (Rectangle 34, taller, elevated z-20, rounded-3xl) -->
            <div class="w-full md:w-[530px] h-[360px] md:h-[430px] rounded-[36px] overflow-hidden shadow-2xl shrink-0 z-20">
                <img src="{{ asset('images/about_hero_center_aerial.png') }}" alt="Aerial Pine Forest Road" class="w-full h-full object-cover">
            </div>

            <!-- Right Card: Pasture Meadow & Barn (Rectangle 35, rounded-3xl) -->
            <div class="w-full md:w-[440px] h-[320px] md:h-[390px] rounded-[32px] overflow-hidden shadow-lg shrink-0 md:-translate-x-8 z-10">
                <img src="{{ asset('images/about_hero_right_meadow.png') }}" alt="Pasture Meadow and Shed" class="w-full h-full object-cover">
            </div>
        </div>
    </div>
</section>

<!-- 2. OUR JOURNEY SECTION (Exact Figma Frame 989:1738: w=1440, h=945) -->
<section class="w-full py-20 bg-white border-t border-neutral-100">
    <div class="max-w-[1440px] mx-auto px-6 md:px-16 flex flex-col gap-12">
        <!-- Frame 207: Header (w=846, h=229) -->
        <div class="flex flex-col items-start gap-4 max-w-[846px]">
            <span class="px-6 py-2 rounded-full bg-[#5E745D] text-white font-heading font-normal text-[16px]">
                Our Journey
            </span>

            <h2 class="font-heading font-normal text-3xl sm:text-4xl md:text-[48px] text-[#0F0F0F] leading-[1.2]">
                Building a community committed to restoring our planet—turning collective action into lasting impact.
            </h2>
        </div>

        <!-- Frame 208: 50/50 Split (Rectangle 36 on Left w=656, h=500 | Rich Narrative on Right w=600) -->
        <div class="w-full max-w-[1312px] flex flex-col lg:flex-row items-center justify-between gap-12 pt-4">
            <!-- Left: Rectangle 36 (Image w=656, h=500, rounded-32px) -->
            <div class="w-full lg:w-[656px] h-[380px] sm:h-[450px] lg:h-[500px] rounded-[32px] overflow-hidden shadow-xl shrink-0">
                <img src="{{ asset('images/about_2.png') }}" alt="Our Journey Shoreline" class="w-full h-full object-cover">
            </div>

            <!-- Right: Text Story (w=600, h=435) -->
            <div class="w-full lg:w-[600px] flex flex-col gap-6 text-[#666666] text-base md:text-[18px] leading-relaxed">
                <p>Starting from a group of individuals' concern about the worsening environmental conditions, the Sustainable Green Environment Community was formed in 2020 with a determination to make a real difference.</p>
                <p>We believe that every small action, when taken together, can create a tremendous impact. From tree planting programs to environmental education, every step we take is dedicated to a greener and more sustainable future.</p>
                <p>Today, we are proud to be home to thousands of individuals who share the same vision—creating a healthier environment for current and future generations.</p>
            </div>
        </div>
    </div>
</section>

<!-- 3. GOALS SECTION (Exact Figma Frame 989:1746: w=1440, h=425, 3 Borderless Columns) -->
<section class="w-full py-20 bg-white border-t border-neutral-100">
    <div class="max-w-[1312px] mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center">
            <!-- Column 1: Vision (Frame 174, w=400, h=265) -->
            <div class="flex flex-col items-center gap-4 max-w-[400px] mx-auto">
                <div class="w-[58px] h-[58px] flex items-center justify-center text-[#5E745D]">
                    <img src="{{ asset('svgs/icon_vision.svg') }}" alt="Vision" class="w-12 h-12">
                </div>
                <h3 class="font-heading font-bold text-[32px] text-[#000000]">
                    Vision
                </h3>
                <p class="text-[#646464] text-[18px] md:text-[20px] font-normal leading-relaxed">
                    Building awareness and real action for environmental conservation through education, community empowerment, and sustainable programs.
                </p>
            </div>

            <!-- Column 2: Mission (Frame 175, w=400, h=236) -->
            <div class="flex flex-col items-center gap-4 max-w-[400px] mx-auto">
                <div class="w-[58px] h-[58px] flex items-center justify-center text-[#5E745D]">
                    <img src="{{ asset('svgs/icon_mission.svg') }}" alt="Mission" class="w-12 h-12">
                </div>
                <h3 class="font-heading font-medium text-[32px] text-[#000000]">
                    Mission
                </h3>
                <p class="text-[#646464] text-[18px] md:text-[20px] font-normal leading-relaxed">
                    To be a leading environmental community that creates positive and sustainable change for future generations.
                </p>
            </div>

            <!-- Column 3: Mark / Values (Frame 176, w=400, h=236) -->
            <div class="flex flex-col items-center gap-4 max-w-[400px] mx-auto">
                <div class="w-[58px] h-[58px] flex items-center justify-center text-[#5E745D]">
                    <img src="{{ asset('svgs/icon_values.svg') }}" alt="Mark" class="w-12 h-12">
                </div>
                <h3 class="font-heading font-bold text-[32px] text-[#000000]">
                    Mark
                </h3>
                <p class="text-[#646464] text-[18px] md:text-[20px] font-normal leading-relaxed">
                    Collaboration, sustainability, transparency, and a commitment to making a real impact on the environment and society.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- 4. CTA SECTION (Exact Figma Frame 989:1763) -->
<x-cta :cta="$cta" :assets="$assets" />
@endsection
