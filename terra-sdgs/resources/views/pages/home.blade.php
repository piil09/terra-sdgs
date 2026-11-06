@extends('layouts.app')

@section('title', 'Terra — Sustainable Green Environment Community')
@section('meta_description', $landing['hero']['subheadline'] ?? '')

@section('content')
<!-- 1. HERO SECTION (Figma: w=1440, h=740, Inner Hero w=1416, h=716, Frame 2 at bottom y=406) -->
<section class="w-full pt-2 pb-6 md:pb-10">
    <div class="max-w-[1416px] mx-auto px-4 md:px-6">
        <div class="relative overflow-hidden rounded-[32px] h-[calc(100vh-104px)] min-h-[520px] max-h-[720px] flex flex-col justify-end p-6 md:p-10 lg:p-14 shadow-2xl">
            <!-- Background Image -->
            <img src="{{ asset($landing['hero']['image']) }}" alt="Hero Background" class="absolute inset-0 w-full h-full object-cover">
            <!-- Rich dark contrast gradient overlay covering the bottom 65% of the hero -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/80 via-55% to-transparent z-10"></div>

            <!-- Frame 2 (Figma: bottom row with headline on left, Join Now on right) -->
            <div class="relative z-20 w-full flex flex-col md:flex-row md:items-end justify-between gap-6 pb-2">
                <!-- Frame 1 (w=871, h=216): H1 + Subtitle -->
                <div class="flex flex-col gap-3 md:gap-4 max-w-[871px]">
                    <h1 class="font-heading font-medium text-3xl sm:text-4xl md:text-5xl lg:text-[56px] xl:text-[62px] text-white leading-[1.12] tracking-tight">
                        {{ $landing['hero']['headline'] }}
                    </h1>
                    <p class="text-neutral-200 text-base sm:text-lg md:text-xl lg:text-[22px] font-normal leading-relaxed max-w-[791px]">
                        {{ $landing['hero']['subheadline'] }}
                    </p>
                </div>

                <!-- Right Button (Figma: w=127, h=51, Join Now, bg #5E745D) -->
                <div class="shrink-0 mb-1">
                    <a href="{{ route('events.register') }}" 
                       class="px-8 py-3.5 rounded-full bg-[#5E745D] hover:bg-[#4B5D4A] text-white font-heading font-bold text-base md:text-[18px] shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 active:scale-95 inline-flex items-center justify-center">
                        {{ $landing['hero']['cta_primary']['label'] ?? 'Join Now' }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 2. ABOUT SECTION (Figma: bg #FAFAFA, Centered Header w=1212, then Left 2 Cards | Center Wide Image w=726 | Right 2 Cards) -->
<section class="w-full py-16 md:py-24 bg-[#FAFAFA]">
    <div class="max-w-[1440px] mx-auto px-6 md:px-16 flex flex-col gap-14">
        <!-- Frame 169 (Centered Header) -->
        <div class="flex flex-col items-center text-center gap-5 max-w-[1212px] mx-auto">
            <!-- Frame 168 (Badge bg #5E745D, text white) -->
            <span class="px-6 py-2 rounded-full bg-[#5E745D] text-white font-heading font-normal text-[16px]">
                {{ $landing['about']['badge'] ?? 'About Us' }}
            </span>
            <!-- Headline: 48px Medium #0F0F0F -->
            <h2 class="font-heading font-medium text-2xl sm:text-3xl md:text-4xl lg:text-[48px] text-[#0F0F0F] leading-[1.25]">
                {{ $landing['about']['headline'] }}
            </h2>
        </div>

        <!-- Frame 173 (w=1312, h=512): [2 Cards on Left] | [Center Big Landscape Image] | [2 Cards on Right] -->
        <div class="flex flex-col lg:flex-row items-center justify-between gap-6 w-full max-w-[1312px] mx-auto">
            <!-- Left Stack: 2 Stat Cards (Frame 171, w=237) -->
            <div class="w-full lg:w-[240px] flex flex-col sm:flex-row lg:flex-col gap-6 shrink-0">
                <!-- Card 1: 5,000+ trees planted -->
                <div class="p-6 rounded-[24px] bg-white border border-neutral-100 shadow-sm flex flex-col items-center text-center gap-3 w-full h-[178px] justify-center hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 flex items-center justify-center">
                        <img src="{{ asset('svgs/icon_tree.svg') }}" alt="Trees" class="w-10 h-10">
                    </div>
                    <div>
                        <div class="font-heading font-bold text-[32px] text-[#0F0F0F] leading-tight">5,000+</div>
                        <div class="text-[#646464] text-[18px] font-normal">trees planted</div>
                    </div>
                </div>

                <!-- Card 2: 3 Tons Accumulated Rubbish -->
                <div class="p-6 rounded-[24px] bg-white border border-neutral-100 shadow-sm flex flex-col items-center text-center gap-3 w-full h-[178px] justify-center hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 flex items-center justify-center">
                        <img src="{{ asset('svgs/icon_trash.svg') }}" alt="Rubbish" class="w-10 h-10">
                    </div>
                    <div>
                        <div class="font-heading font-bold text-[32px] text-[#0F0F0F] leading-tight">3 Tons</div>
                        <div class="text-[#646464] text-[18px] font-normal">Accumulated Rubbish</div>
                    </div>
                </div>
            </div>

            <!-- Center: Big Landscape Image (Frame 170, w=726, h=450) -->
            <div class="w-full lg:w-[726px] overflow-hidden rounded-[32px] h-[320px] sm:h-[380px] lg:h-[450px] shadow-lg shrink-0">
                <img src="{{ asset('images/about_1.png') }}" alt="Terra Community" class="w-full h-full object-cover">
            </div>

            <!-- Right Stack: 2 Stat Cards (Frame 172, w=237) -->
            <div class="w-full lg:w-[240px] flex flex-col sm:flex-row lg:flex-col gap-6 shrink-0">
                <!-- Card 3: 1,200+ Active volunteer -->
                <div class="p-6 rounded-[24px] bg-white border border-neutral-100 shadow-sm flex flex-col items-center text-center gap-3 w-full h-[178px] justify-center hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 flex items-center justify-center">
                        <img src="{{ asset('svgs/icon_volunteer.svg') }}" alt="Volunteer" class="w-10 h-10">
                    </div>
                    <div>
                        <div class="font-heading font-bold text-[32px] text-[#0F0F0F] leading-tight">1,200+</div>
                        <div class="text-[#646464] text-[18px] font-normal">Active volunteer</div>
                    </div>
                </div>

                <!-- Card 4: 50+ Educated School -->
                <div class="p-6 rounded-[24px] bg-white border border-neutral-100 shadow-sm flex flex-col items-center text-center gap-3 w-full h-[178px] justify-center hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 flex items-center justify-center">
                        <img src="{{ asset('svgs/icon_school.svg') }}" alt="School" class="w-10 h-10">
                    </div>
                    <div>
                        <div class="font-heading font-bold text-[32px] text-[#0F0F0F] leading-tight">50+</div>
                        <div class="text-[#646464] text-[18px] font-normal">Educated School</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 3. GOALS SECTION (Figma: bg #FFFFFF, 3 borderless columns, 58x58 centered icons, Vision, Mission, Mark) -->
<section class="w-full py-20 bg-white">
    <div class="max-w-[1312px] mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center">
            <!-- Column 1: Vision -->
            <div class="flex flex-col items-center gap-4 max-w-[400px] mx-auto">
                <div class="w-[58px] h-[58px] flex items-center justify-center text-[#5E745D]">
                    <img src="{{ asset('svgs/icon_vision.svg') }}" alt="Vision" class="w-12 h-12">
                </div>
                <h3 class="font-heading font-bold text-[32px] text-[#000000]">
                    Vision
                </h3>
                <p class="text-[#646464] text-[20px] lg:text-[24px] font-normal leading-relaxed">
                    Building awareness and real action for environmental conservation through education, community empowerment, and sustainable programs.
                </p>
            </div>

            <!-- Column 2: Mission -->
            <div class="flex flex-col items-center gap-4 max-w-[400px] mx-auto">
                <div class="w-[58px] h-[58px] flex items-center justify-center text-[#5E745D]">
                    <img src="{{ asset('svgs/icon_mission.svg') }}" alt="Mission" class="w-12 h-12">
                </div>
                <h3 class="font-heading font-medium text-[32px] text-[#000000]">
                    Mission
                </h3>
                <p class="text-[#646464] text-[20px] lg:text-[24px] font-normal leading-relaxed">
                    To be a leading environmental community that creates positive and sustainable change for future generations.
                </p>
            </div>

            <!-- Column 3: Mark (Values) -->
            <div class="flex flex-col items-center gap-4 max-w-[400px] mx-auto">
                <div class="w-[58px] h-[58px] flex items-center justify-center text-[#5E745D]">
                    <img src="{{ asset('svgs/icon_values.svg') }}" alt="Mark" class="w-12 h-12">
                </div>
                <h3 class="font-heading font-bold text-[32px] text-[#000000]">
                    Mark
                </h3>
                <p class="text-[#646464] text-[20px] lg:text-[24px] font-normal leading-relaxed">
                    Collaboration, sustainability, transparency, and a commitment to making a real impact on the environment and society.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- 4. EVENT SECTION (Figma: bg #FAFAFA, Badge Event, Title, View All Event, 3 Cards with h=451 image + Register button w=421) -->
<section class="w-full py-20 bg-[#FAFAFA]">
    <div class="max-w-[1440px] mx-auto px-6 md:px-16 flex flex-col gap-12">
        <!-- Header row -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="flex flex-col items-start gap-4 max-w-[600px]">
                <span class="px-6 py-2 rounded-full bg-[#5E745D] text-white font-heading font-normal text-[16px]">
                    Event
                </span>
                <h2 class="font-heading font-normal text-3xl sm:text-4xl md:text-[48px] text-[#0F0F0F] leading-[1.2]">
                    Join various fun activities for a better environment
                </h2>
            </div>

            <div>
                <a href="{{ route('events') }}" 
                   class="px-8 py-3.5 rounded-full bg-[#5E745D] hover:bg-[#4B5D4A] text-white font-heading font-bold text-[18px] transition-all inline-block shadow">
                    View All Event
                </a>
            </div>
        </div>

        <!-- 3 Event Cards (Frame 192, 193, 194 in Figma) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($events as $event)
                <div class="rounded-[24px] overflow-hidden bg-white border border-neutral-100 shadow-sm flex flex-col justify-between hover:shadow-xl transition-all duration-300 group">
                    <div>
                        <!-- Top Image (h=451 in Figma) with Registration is open badge -->
                        <div class="relative h-[340px] md:h-[400px] overflow-hidden">
                            <img src="{{ asset($event['image']) }}" alt="{{ $event['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <span class="absolute top-5 left-5 px-5 py-2 rounded-full bg-white text-[#5E745D] font-heading font-normal text-[16px] shadow-sm">
                                Registration is open
                            </span>
                        </div>

                        <!-- Middle Content (Frame 191) -->
                        <div class="p-6 md:p-8 flex flex-col gap-3">
                            <h3 class="font-heading font-bold text-[28px] text-[#0F0F0F] leading-snug">
                                {{ $event['title'] }}
                            </h3>
                            <p class="text-[#666666] text-[18px] leading-relaxed">
                                {{ $event['description'] }}
                            </p>
                        </div>
                    </div>

                    <!-- Bottom Register Button (w=421, h=51 in Figma, rounded-full bg #5E745D) -->
                    <div class="p-6 md:p-8 pt-0">
                        <a href="{{ route('events.register', ['event_id' => $event['id']]) }}" 
                           class="w-full py-4 rounded-full bg-[#5E745D] hover:bg-[#4B5D4A] text-white font-heading font-bold text-center text-[18px] transition-colors block shadow-sm">
                            Register
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- 5. ARTICLE SECTION (Figma: bg #FAFAFA, 3 Horizontal Rows with [Title/Meta on Left] | [Image 280x300 in Center] | [Excerpt + Read More on Right]) -->
<section class="w-full py-20 bg-[#FAFAFA]">
    <div class="max-w-[1440px] mx-auto px-6 md:px-16 flex flex-col gap-12">
        <!-- Header row -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="flex flex-col items-start gap-4 max-w-[650px]">
                <span class="px-6 py-2 rounded-full bg-[#5E745D] text-white font-heading font-normal text-[16px]">
                    Article
                </span>
                <h2 class="font-heading font-normal text-3xl sm:text-4xl md:text-[48px] text-[#0F0F0F] leading-[1.2]">
                    Explore inspiring actions for a greener, sustainable future
                </h2>
            </div>

            <div>
                <a href="{{ route('articles') }}" 
                   class="px-8 py-3.5 rounded-full bg-[#5E745D] hover:bg-[#4B5D4A] text-white font-heading font-normal text-[18px] transition-all inline-block shadow">
                    View All Articles
                </a>
            </div>
        </div>

        <!-- 3 Horizontal Rows Grid (Frame 207, 208, 209 in Figma) -->
        <div class="flex flex-col gap-6">
            @foreach($articles as $art)
                <div class="p-6 md:p-8 rounded-[28px] bg-white border border-neutral-100 shadow-sm flex flex-col lg:flex-row items-center justify-between gap-8 hover:shadow-md transition-shadow">
                    <!-- Left: Title & Meta (w=428px in Figma) -->
                    <div class="w-full lg:w-[428px] flex flex-col gap-3">
                        <h3 class="font-heading font-bold text-2xl lg:text-[32px] text-[#0F0F0F] leading-snug">
                            {{ $art['title'] }}
                        </h3>
                        <div class="flex items-center gap-2 text-[18px] font-normal text-[#5E745D]">
                            <span>{{ $art['author'] }}</span>
                            <span>/</span>
                            <span>{{ $art['date'] }}</span>
                        </div>
                    </div>

                    <!-- Middle: Square Image (Rectangle 33 in Figma: w=280, h=300) -->
                    <div class="overflow-hidden rounded-2xl w-[280px] h-[260px] md:h-[300px] shrink-0 shadow-sm">
                        <img src="{{ asset($art['image']) }}" alt="{{ $art['title'] }}" class="w-full h-full object-cover">
                    </div>

                    <!-- Right: Excerpt & Read More Button (w=428px in Figma) -->
                    <div class="w-full lg:w-[428px] flex flex-col gap-5 justify-between">
                        <p class="text-[#666666] text-base lg:text-[18px] leading-relaxed">
                            {{ $art['excerpt'] }}
                        </p>
                        <div>
                            <a href="{{ route('articles.detail', $art['slug']) }}" 
                               class="px-8 py-3 rounded-full bg-[#F5F5F5] hover:bg-[#EBEBEB] text-[#0F0F0F] font-heading font-bold text-[18px] transition-colors inline-block">
                                Read More
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- 6. CTA SECTION -->
<x-cta :cta="$landing['cta']" :assets="$assets" />
@endsection
