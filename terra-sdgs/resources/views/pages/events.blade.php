@extends('layouts.app')

@section('title', 'Events — Terra')
@section('meta_description', 'Join various fun activities for a better environment.')

@section('content')
<!-- EVENTS HEADER & HERO -->
<section class="w-full pt-12 pb-8 bg-white">
    <div class="max-w-[1440px] mx-auto px-6 md:px-16 flex flex-col gap-4">
        <span class="px-4 py-1 rounded-full bg-[#EBF2EA] text-[#5E745D] font-heading font-medium text-[16px] w-fit">
            Event
        </span>
        <h1 class="font-heading font-medium text-4xl sm:text-5xl md:text-[64px] text-[#131713] leading-[1.15] max-w-[900px]">
            Join various fun activities for a better environment
        </h1>
        <p class="text-[#666666] text-xl max-w-[700px] mt-2">
            Participate in our hands-on environmental workshops, beach cleanups, and community conservation actions across Indonesia.
        </p>
    </div>
</section>

<!-- EVENTS LISTING GRID -->
<section class="w-full py-12 pb-24 bg-white">
    <div class="max-w-[1440px] mx-auto px-6 md:px-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($events as $event)
                <div class="rounded-[24px] overflow-hidden bg-white border border-neutral-200/80 shadow-sm flex flex-col hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                    <div class="relative h-[260px] overflow-hidden">
                        <img src="{{ asset($event['image']) }}" alt="{{ $event['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-4 left-4 px-3 py-1 rounded-full bg-white/95 backdrop-blur text-xs font-semibold text-[#5E745D] shadow-sm">
                            {{ $event['status'] }}
                        </span>
                    </div>

                    <div class="p-8 flex flex-col gap-5 flex-grow justify-between">
                        <div class="flex flex-col gap-3">
                            <h3 class="font-heading font-bold text-2xl text-[#131713] leading-snug">
                                {{ $event['title'] }}
                            </h3>
                            <p class="text-[#666666] text-base leading-relaxed">
                                {{ $event['description'] }}
                            </p>
                        </div>

                        <div class="flex flex-col gap-3 pt-4 border-t border-neutral-100 text-sm text-[#4C4C4C]">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-[#EBF2EA] flex items-center justify-center shrink-0">
                                    <i data-lucide="calendar" class="w-4 h-4 text-[#5E745D]"></i>
                                </div>
                                <div>
                                    <span class="font-medium text-[#131713]">{{ $event['date'] }}</span>
                                    <span class="text-xs text-neutral-500 block">{{ $event['time'] }}</span>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-[#EBF2EA] flex items-center justify-center shrink-0">
                                    <i data-lucide="map-pin" class="w-4 h-4 text-[#5E745D]"></i>
                                </div>
                                <span class="text-[#131713]">{{ $event['location'] }}</span>
                            </div>

                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-[#EBF2EA] flex items-center justify-center shrink-0">
                                    <i data-lucide="users" class="w-4 h-4 text-[#5E745D]"></i>
                                </div>
                                <span class="text-[#131713]">{{ $event['quota'] }}</span>
                            </div>
                        </div>

                        <a href="{{ route('events.register', ['event_id' => $event['id']]) }}" 
                           class="w-full py-4 rounded-full bg-[#5E745D] hover:bg-[#4B5D4A] text-white font-heading font-bold text-center text-[18px] transition-all shadow hover:shadow-md active:scale-95">
                            Register Now
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA SECTION -->
<x-cta :cta="$cta" :assets="$assets" />
@endsection
