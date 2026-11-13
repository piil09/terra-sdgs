@extends('layouts.app')

@section('title', 'Events — Terra')
@section('meta_description', 'Join various fun activities for a better environment.')

@section('content')
<!-- 1. EVENTS HEADER SECTION (Exact Figma Frame 1507:1210: w=1312, h=171) -->
<section class="w-full pt-16 pb-12 bg-white">
    <div class="max-w-[1440px] mx-auto px-6 md:px-16 flex flex-col gap-5">
        <!-- Frame 168: Badge (bg #5E745D, text white) -->
        <span class="px-6 py-2 rounded-full bg-[#5E745D] text-white font-heading font-normal text-[16px] w-fit shadow-sm">
            Event
        </span>

        <!-- Headline: 48px font matching Figma -->
        <h1 class="font-heading font-normal text-3xl sm:text-4xl md:text-5xl lg:text-[48px] text-[#0F0F0F] leading-[1.2] max-w-[850px] tracking-tight">
            Join various fun activities for a better environment
        </h1>

        <p class="text-[#646464] text-lg md:text-[20px] font-normal leading-relaxed max-w-[720px]">
            Participate in our hands-on environmental workshops, beach cleanups, and community conservation actions across Indonesia.
        </p>
    </div>
</section>

<!-- 2. EVENTS CARDS GRID (Exact Figma Frame 1507:1216: 3 Columns, Cards with 451px image, 2x2 metadata & Register CTA) -->
<section class="w-full pb-24 bg-white">
    <div class="max-w-[1440px] mx-auto px-6 md:px-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($events as $event)
                <div class="rounded-[28px] overflow-hidden bg-white border border-neutral-100 shadow-sm flex flex-col justify-between hover:shadow-xl transition-all duration-300 group">
                    <div>
                        <!-- Top Image (Figma Frame 177: h=451) with Registration is open badge -->
                        <div class="relative h-[340px] md:h-[400px] overflow-hidden bg-neutral-100">
                            <img src="{{ asset($event['image']) }}" alt="{{ $event['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            
                            <!-- Registration is open badge (Exact Figma Badge) -->
                            <span class="absolute top-5 left-5 px-5 py-2 rounded-full bg-white/95 backdrop-blur-sm text-[#5E745D] font-heading font-normal text-[15px] shadow-md">
                                {{ $event['status'] ?? 'Registration is open' }}
                            </span>
                        </div>

                        <!-- Middle Content (Figma Frame 191) -->
                        <div class="p-6 md:p-8 flex flex-col gap-6">
                            <!-- Frame 100: Title & Description -->
                            <div class="flex flex-col gap-3">
                                <h3 class="font-heading font-bold text-2xl md:text-[28px] text-[#0F0F0F] leading-snug">
                                    {{ $event['title'] }}
                                </h3>
                                <p class="text-[#666666] text-base md:text-[18px] leading-relaxed">
                                    {{ $event['description'] }}
                                </p>
                            </div>

                            <!-- Container: 4 Metadata Items in 2x2 Grid with SVGs -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4 border-t border-neutral-100 text-sm text-[#4C4C4C]">
                                <!-- Date -->
                                <div class="flex items-center gap-2.5">
                                    <div class="w-6 h-6 flex items-center justify-center shrink-0 text-[#5E745D]">
                                        <img src="{{ asset('svgs/icon_calendar.svg') }}" alt="Calendar" class="w-5 h-5">
                                    </div>
                                    <span class="font-medium text-[#131713] text-[15px]">{{ $event['date'] }}</span>
                                </div>

                                <!-- Time -->
                                <div class="flex items-center gap-2.5">
                                    <div class="w-6 h-6 flex items-center justify-center shrink-0 text-[#5E745D]">
                                        <img src="{{ asset('svgs/icon_clock.svg') }}" alt="Clock" class="w-5 h-5">
                                    </div>
                                    <span class="text-[#666666] text-[15px]">{{ $event['time'] }}</span>
                                </div>

                                <!-- Location -->
                                <div class="flex items-center gap-2.5">
                                    <div class="w-6 h-6 flex items-center justify-center shrink-0 text-[#5E745D]">
                                        <img src="{{ asset('svgs/icon_location.svg') }}" alt="Location" class="w-5 h-5">
                                    </div>
                                    <span class="text-[#131713] text-[15px] truncate">{{ $event['location'] }}</span>
                                </div>

                                <!-- Quota -->
                                <div class="flex items-center gap-2.5">
                                    <div class="w-6 h-6 flex items-center justify-center shrink-0 text-[#5E745D]">
                                        <img src="{{ asset('svgs/icon_users.svg') }}" alt="Quota" class="w-5 h-5">
                                    </div>
                                    <span class="text-[#131713] font-medium text-[15px]">{{ $event['quota'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Register Button (Figma Button w=421, h=51) -->
                    <div class="p-6 md:p-8 pt-0">
                        <a href="{{ route('events.register', ['event_id' => $event['id']]) }}" 
                           class="w-full py-4 rounded-full bg-[#5E745D] hover:bg-[#4B5D4A] text-white font-heading font-bold text-center text-[18px] transition-all shadow-md hover:shadow-lg active:scale-95 block">
                            Register
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- 3. CTA SECTION (Exact Figma Frame 1507:1360) -->
<x-cta :cta="$cta" :assets="$assets" />
@endsection
