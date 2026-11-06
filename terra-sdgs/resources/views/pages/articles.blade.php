@extends('layouts.app')

@section('title', 'Articles — Terra')
@section('meta_description', 'Explore inspiring actions for a greener, sustainable future.')

@section('content')
<!-- ARTICLES HEADER -->
<section class="w-full pt-12 pb-8 bg-white">
    <div class="max-w-[1440px] mx-auto px-6 md:px-16 flex flex-col gap-6">
        <span class="px-4 py-1 rounded-full bg-[#EBF2EA] text-[#5E745D] font-heading font-medium text-[16px] w-fit">
            Article
        </span>
        <h1 class="font-heading font-medium text-4xl sm:text-5xl md:text-[64px] text-[#131713] leading-[1.15] max-w-[900px]">
            Explore inspiring actions for a greener, sustainable future
        </h1>

        <!-- CATEGORY TABS (Figma exact tabs: All Category, Lifestyle, Conservation, Environmental News) -->
        <div class="flex flex-wrap items-center gap-3 pt-6 border-b border-neutral-200 pb-4">
            @php
                $categories = [
                    ['id' => 'all', 'label' => 'All Category'],
                    ['id' => 'lifestyle', 'label' => 'Lifestyle'],
                    ['id' => 'conservation', 'label' => 'Conservation'],
                    ['id' => 'environmental news', 'label' => 'Environmental News'],
                ];
            @endphp

            @foreach($categories as $cat)
                @php
                    $isCatActive = strtolower($currentCategory) === strtolower($cat['id']) || ($cat['id'] === 'all' && (empty($currentCategory) || $currentCategory === 'All'));
                @endphp
                <button type="button" 
                        class="article-category-tab px-6 py-2.5 rounded-full font-heading font-bold text-[18px] transition-all duration-200 {{ $isCatActive ? 'bg-[#5E745D] text-white shadow-sm' : 'bg-neutral-100 text-[#4C4C4C] hover:bg-neutral-200' }}"
                        data-category="{{ $cat['id'] }}">
                    {{ $cat['label'] }}
                </button>
            @endforeach
        </div>
    </div>
</section>

<!-- ARTICLES GRID -->
<section class="w-full py-8 pb-24 bg-white">
    <div class="max-w-[1440px] mx-auto px-6 md:px-16">
        <div id="articles-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($articles as $art)
                <div class="article-item-card rounded-[24px] overflow-hidden bg-white border border-neutral-200/80 shadow-sm flex flex-col hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group"
                     data-category="{{ strtolower($art['category']) }}">
                    <div class="relative h-[260px] overflow-hidden">
                        <img src="{{ asset($art['image']) }}" alt="{{ $art['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-4 left-4 px-3 py-1 rounded-full bg-white/95 backdrop-blur text-xs font-semibold text-[#5E745D] shadow-sm">
                            {{ $art['category'] }}
                        </span>
                    </div>

                    <div class="p-8 flex flex-col gap-4 flex-grow justify-between">
                        <div class="flex flex-col gap-3">
                            <span class="text-xs font-semibold text-[#808080]">
                                {{ $art['category'] }}
                            </span>
                            <h3 class="font-heading font-bold text-2xl text-[#131713] leading-snug line-clamp-2">
                                {{ $art['title'] }}
                            </h3>
                            <p class="text-[#666666] text-base leading-relaxed line-clamp-3">
                                {{ $art['excerpt'] }}
                            </p>
                        </div>

                        <div class="pt-4 border-t border-neutral-100">
                            <a href="{{ route('articles.detail', $art['slug']) }}" 
                               class="w-full py-3.5 rounded-full bg-[#5E745D] hover:bg-[#4B5D4A] text-white font-heading font-bold text-center text-base transition-colors shadow-sm inline-block">
                                Read Now
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA SECTION -->
<x-cta :cta="$cta" :assets="$assets" />
@endsection
