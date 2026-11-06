@extends('layouts.app')

@section('title', 'Donate — Terra')
@section('meta_description', $donate['header']['subtitle'] ?? '')

@section('content')
<section class="w-full py-12 md:py-20 bg-white">
    <div class="max-w-[1360px] mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            <!-- Left Side Featured Image (matching Figma width 628, height 981) -->
            <div class="lg:col-span-5 overflow-hidden rounded-[32px] shadow-2xl h-[560px] lg:h-[920px] sticky top-28">
                <img src="{{ asset('images/donate_side.jpeg') }}" alt="Donate to Terra" class="w-full h-full object-cover">
            </div>

            <!-- Right Side Donation Form (matching Figma width 628) -->
            <div class="lg:col-span-7 flex flex-col gap-8">
                <!-- Header -->
                <div class="flex flex-col gap-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-[#EBF2EA] flex items-center justify-center text-[#5E745D]">
                            <i data-lucide="heart" class="w-5 h-5 fill-[#5E745D]"></i>
                        </div>
                        <h1 class="font-heading font-bold text-3xl sm:text-4xl text-[#131713]">
                            {{ $donate['header']['title'] ?? 'Make a difference: Donate today' }}
                        </h1>
                    </div>
                    <p class="text-[#666666] text-lg leading-relaxed">
                        {{ $donate['header']['subtitle'] ?? 'Every contribution helps realize a greener and more sustainable environment' }}
                    </p>
                </div>

                <!-- Form -->
                <form method="POST" action="{{ route('donate.store') }}" class="flex flex-col gap-8 bg-[#F9FAF9] p-8 md:p-10 rounded-[32px] border border-neutral-200/80 shadow-sm">
                    @csrf

                    <!-- 1. Choose a Program to Support (Figma Label component set) -->
                    <div class="flex flex-col gap-4">
                        <label class="font-heading font-medium text-[18px] text-[#131713]">
                            {{ $donate['program_title'] ?? 'Choose a Program to Support' }}
                        </label>

                        <input type="hidden" name="program_id" id="selected-program-id" value="{{ $donate['programs'][0]['id'] ?? 'general' }}">
                        <input type="hidden" name="program_name" id="selected-program-name" value="{{ $donate['programs'][0]['name'] ?? 'General Conservation' }}">

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach($donate['programs'] ?? [] as $idx => $prog)
                                @php $isFirst = ($idx === 0); @endphp
                                <div class="donate-program-badge p-4 rounded-2xl border cursor-pointer transition-all duration-200 flex flex-col gap-1 {{ $isFirst ? 'border-[#5E745D] bg-[#EBF2EA] ring-2 ring-[#5E745D]' : 'border-neutral-200 bg-white hover:border-neutral-300' }}"
                                     data-id="{{ $prog['id'] }}"
                                     data-name="{{ $prog['name'] }}">
                                    <span class="font-heading font-bold text-base text-[#131713]">{{ $prog['name'] }}</span>
                                    <span class="text-xs text-[#666666] line-clamp-2 leading-relaxed">{{ $prog['desc'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- 2. Select Amount Presets (Figma Button Stroke component set) -->
                    <div class="flex flex-col gap-4">
                        <div class="flex items-center justify-between">
                            <label class="font-heading font-medium text-[18px] text-[#131713]">
                                Select Amount
                            </label>
                            <span class="text-xs text-neutral-500">IDR (Rupiah)</span>
                        </div>

                        <input type="hidden" name="amount" id="selected-amount-input" value="100000">

                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3">
                            @foreach($donate['amounts'] ?? [] as $idx => $amt)
                                @php $isSelectedAmt = ($amt['value'] === 100000); @endphp
                                <button type="button" 
                                        class="donate-amount-btn py-3 px-2 rounded-xl border font-heading font-bold text-sm transition-all duration-200 text-center {{ $isSelectedAmt ? 'bg-[#5E745D] text-white border-[#5E745D]' : 'bg-white text-neutral-800 border-neutral-300 hover:border-[#5E745D]' }}"
                                        data-value="{{ $amt['value'] }}">
                                    {{ $amt['label'] }}
                                </button>
                            @endforeach
                        </div>

                        <!-- Custom Amount Input -->
                        <div class="relative mt-2">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-neutral-500 font-bold text-sm">Rp</span>
                            <input type="number" id="custom-amount-input" placeholder="Or enter custom amount (e.g. 150000)" value="100000" min="10000" step="5000"
                                   class="w-full pl-12 pr-4 py-3.5 rounded-xl bg-white border border-neutral-300 focus:border-[#5E745D] focus:ring-2 focus:ring-[#5E745D]/20 outline-none text-base font-medium">
                        </div>
                    </div>

                    <!-- 3. Donor Information Inputs -->
                    <div class="flex flex-col gap-5 pt-4 border-t border-neutral-200">
                        <h4 class="font-heading font-medium text-lg text-[#131713]">Donor Information</h4>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="flex flex-col gap-1.5">
                                <label for="donor_name" class="text-sm font-medium text-[#131713]">Full Name <span class="text-red-500">*</span></label>
                                <input type="text" id="donor_name" name="donor_name" required placeholder="e.g. Budi Santoso"
                                       class="px-4 py-3 rounded-xl bg-white border border-neutral-300 focus:border-[#5E745D] outline-none text-base">
                            </div>

                            <div class="flex flex-col gap-1.5">
                                <label for="donor_email" class="text-sm font-medium text-[#131713]">Email Address <span class="text-red-500">*</span></label>
                                <input type="email" id="donor_email" name="donor_email" required placeholder="budi@example.com"
                                       class="px-4 py-3 rounded-xl bg-white border border-neutral-300 focus:border-[#5E745D] outline-none text-base">
                            </div>
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label for="donor_phone" class="text-sm font-medium text-[#131713]">Phone / WhatsApp (optional)</label>
                            <input type="text" id="donor_phone" name="donor_phone" placeholder="+62 812..."
                                   class="px-4 py-3 rounded-xl bg-white border border-neutral-300 focus:border-[#5E745D] outline-none text-base">
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label for="message" class="text-sm font-medium text-[#131713]">Message of Encouragement (optional)</label>
                            <textarea id="message" name="message" rows="2" placeholder="Write a warm note for our volunteer team..."
                                      class="px-4 py-3 rounded-xl bg-white border border-neutral-300 focus:border-[#5E745D] outline-none text-base"></textarea>
                        </div>
                    </div>

                    <!-- 4. Payment Method -->
                    <div class="flex flex-col gap-3 pt-2">
                        <label class="text-sm font-medium text-[#131713]">Payment Method <span class="text-red-500">*</span></label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach($donate['payment_methods'] ?? [] as $idx => $pm)
                                <label class="p-3.5 rounded-xl border border-neutral-300 bg-white flex items-center gap-3 cursor-pointer hover:border-[#5E745D] transition-colors">
                                    <input type="radio" name="payment_method" value="{{ $pm['name'] }}" {{ $idx === 0 ? 'checked' : '' }} class="radio radio-success radio-sm">
                                    <span class="text-sm font-medium text-neutral-800">{{ $pm['name'] }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            class="w-full py-4 rounded-full bg-[#5E745D] hover:bg-[#4B5D4A] text-white font-heading font-bold text-[18px] shadow-lg hover:shadow-xl transition-all duration-300 active:scale-[0.98] flex items-center justify-center gap-2 mt-2">
                        <span>Donate Now</span>
                        <i data-lucide="heart" class="w-5 h-5 fill-white/30"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- DONATION SUCCESS MODAL -->
@if(session('donation_success'))
    @php $ds = session('donation_success'); @endphp
    <div id="donation-modal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl p-8 max-w-md w-full shadow-2xl flex flex-col items-center text-center gap-5 border border-[#5E745D]/30 animate-in zoom-in-95">
            <div class="w-16 h-16 rounded-full bg-[#EBF2EA] text-[#5E745D] flex items-center justify-center">
                <i data-lucide="check" class="w-8 h-8"></i>
            </div>
            <h3 class="font-heading font-bold text-2xl text-[#131713]">Terima Kasih, {{ $ds['donor'] }}!</h3>
            <p class="text-neutral-600 text-sm leading-relaxed">
                Donasi sebesar <strong class="text-[#5E745D]">Rp {{ number_format($ds['amount'], 0, ',', '.') }}</strong> untuk program <strong>{{ $ds['program'] }}</strong> telah kami terima. Kontribusi Anda sangat berarti bagi kelestarian alam!
            </p>
            <button onclick="document.getElementById('donation-modal').remove()" class="w-full py-3.5 rounded-full bg-[#5E745D] text-white font-heading font-bold text-base hover:bg-[#4B5D4A]">
                Tutup
            </button>
        </div>
    </div>
@endif

<!-- CTA SECTION -->
<x-cta :cta="$cta" :assets="$assets" />
@endsection
