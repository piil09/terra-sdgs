@extends('layouts.app')

@section('title', 'Register Event — Terra')
@section('meta_description', 'Join our volunteer team and take part in real environmental change.')

@section('content')
<section class="w-full py-12 md:py-20 bg-white">
    <div class="max-w-[1440px] mx-auto px-6 md:px-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            <!-- Left Info Panel -->
            <div class="lg:col-span-5 flex flex-col gap-8 sticky top-28">
                <div class="flex flex-col gap-4">
                    <span class="px-4 py-1 rounded-full bg-[#EBF2EA] text-[#5E745D] font-heading font-medium text-[16px] w-fit">
                        Volunteer Registration
                    </span>
                    <h1 class="font-heading font-medium text-4xl sm:text-5xl text-[#131713] leading-tight">
                        {{ $registration['title'] ?? 'Join Our Event' }}
                    </h1>
                    <p class="text-[#666666] text-xl leading-relaxed">
                        {{ $registration['subtitle'] ?? 'Contribute to our community for a better environment.' }}
                    </p>
                </div>

                @if($selectedEvent)
                    <div class="p-6 rounded-2xl bg-[#EBF2EA]/60 border border-[#5E745D]/30 flex flex-col gap-3">
                        <span class="text-xs uppercase font-bold text-[#5E745D] tracking-wider">Event Terpilih:</span>
                        <h4 class="font-heading font-bold text-xl text-[#131713]">{{ $selectedEvent['title'] }}</h4>
                        <div class="text-sm text-[#4C4C4C] space-y-1">
                            <p class="flex items-center gap-2"><i data-lucide="calendar" class="w-4 h-4 text-[#5E745D]"></i> {{ $selectedEvent['date'] }} ({{ $selectedEvent['time'] }})</p>
                            <p class="flex items-center gap-2"><i data-lucide="map-pin" class="w-4 h-4 text-[#5E745D]"></i> {{ $selectedEvent['location'] }}</p>
                        </div>
                    </div>
                @endif

                <div class="overflow-hidden rounded-3xl shadow-lg h-[360px] hidden md:block">
                    <img src="{{ asset('images/about_1.png') }}" alt="Terra Volunteers" class="w-full h-full object-cover">
                </div>
            </div>

            <!-- Right Registration Form Card -->
            <div class="lg:col-span-7 p-8 md:p-12 rounded-[32px] bg-[#F9FAF9] border border-neutral-200/80 shadow-md">
                <h3 class="font-heading font-medium text-2xl text-[#131713] mb-6 pb-4 border-b border-neutral-200">
                    {{ $registration['form_title'] ?? 'Registration Form' }}
                </h3>

                @if ($errors->any())
                    <div class="mb-6 p-4 rounded-2xl bg-red-50 border border-red-200 text-red-700 text-sm">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('events.register.store') }}" class="flex flex-col gap-6">
                    @csrf

                    <!-- Full Name -->
                    <div class="flex flex-col gap-2">
                        <label for="full_name" class="text-sm font-medium text-[#131713]">
                            Full Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}" required
                               placeholder="Enter your full name"
                               class="w-full px-4 py-3.5 rounded-xl bg-white border border-neutral-300 focus:border-[#5E745D] focus:ring-2 focus:ring-[#5E745D]/20 outline-none transition-all text-base">
                    </div>

                    <!-- Email & Phone Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="flex flex-col gap-2">
                            <label for="email" class="text-sm font-medium text-[#131713]">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                   placeholder="your.email@example.com"
                                   class="w-full px-4 py-3.5 rounded-xl bg-white border border-neutral-300 focus:border-[#5E745D] focus:ring-2 focus:ring-[#5E745D]/20 outline-none transition-all text-base">
                        </div>

                        <div class="flex flex-col gap-2">
                            <label for="phone" class="text-sm font-medium text-[#131713]">
                                Phone/WhatsApp Number <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required
                                   placeholder="+62 812 3456 7890"
                                   class="w-full px-4 py-3.5 rounded-xl bg-white border border-neutral-300 focus:border-[#5E745D] focus:ring-2 focus:ring-[#5E745D]/20 outline-none transition-all text-base">
                        </div>
                    </div>

                    <!-- Date of Birth & City Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="flex flex-col gap-2">
                            <label for="date_of_birth" class="text-sm font-medium text-[#131713]">
                                Date of Birth <span class="text-neutral-400 text-xs">(YYYY-MM-DD)</span>
                            </label>
                            <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}"
                                   class="w-full px-4 py-3.5 rounded-xl bg-white border border-neutral-300 focus:border-[#5E745D] focus:ring-2 focus:ring-[#5E745D]/20 outline-none transition-all text-base">
                        </div>

                        <div class="flex flex-col gap-2">
                            <label for="city" class="text-sm font-medium text-[#131713]">
                                City/Domicile <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="city" name="city" value="{{ old('city') }}" required
                                   placeholder="Your city"
                                   class="w-full px-4 py-3.5 rounded-xl bg-white border border-neutral-300 focus:border-[#5E745D] focus:ring-2 focus:ring-[#5E745D]/20 outline-none transition-all text-base">
                        </div>
                    </div>

                    <!-- Occupation & Gender Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="flex flex-col gap-2">
                            <label for="occupation" class="text-sm font-medium text-[#131713]">
                                Occupation <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="occupation" name="occupation" value="{{ old('occupation') }}" required
                                   placeholder="Your occupation"
                                   class="w-full px-4 py-3.5 rounded-xl bg-white border border-neutral-300 focus:border-[#5E745D] focus:ring-2 focus:ring-[#5E745D]/20 outline-none transition-all text-base">
                        </div>

                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-medium text-[#131713]">
                                Gender <span class="text-red-500">*</span>
                            </label>
                            <div class="flex items-center gap-6 h-[50px]">
                                <label class="inline-flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="gender" value="Male" {{ old('gender', 'Male') === 'Male' ? 'checked' : '' }} class="radio radio-success">
                                    <span class="text-base text-neutral-800">Male</span>
                                </label>
                                <label class="inline-flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="gender" value="Female" {{ old('gender') === 'Female' ? 'checked' : '' }} class="radio radio-success">
                                    <span class="text-base text-neutral-800">Female</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Environmental Interest -->
                    <div class="flex flex-col gap-2">
                        <label for="interest" class="text-sm font-medium text-[#131713]">
                            Environmental Interest / Event <span class="text-red-500">*</span>
                        </label>
                        <select id="interest" name="interest" required
                                class="w-full px-4 py-3.5 rounded-xl bg-white border border-neutral-300 focus:border-[#5E745D] focus:ring-2 focus:ring-[#5E745D]/20 outline-none transition-all text-base">
                            @foreach($registration['interests'] ?? [] as $interest)
                                <option value="{{ $interest }}" {{ (old('interest') === $interest || ($selectedEvent && str_contains($selectedEvent['title'], $interest))) ? 'selected' : '' }}>
                                    {{ $interest }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Previous Volunteer Experience -->
                    <div class="flex flex-col gap-2">
                        <label for="volunteer_experience" class="text-sm font-medium text-[#131713]">
                            Previous Volunteer Experience (optional)
                        </label>
                        <textarea id="volunteer_experience" name="volunteer_experience" rows="3"
                                  placeholder="Share your previous volunteer experience..."
                                  class="w-full px-4 py-3 rounded-xl bg-white border border-neutral-300 focus:border-[#5E745D] focus:ring-2 focus:ring-[#5E745D]/20 outline-none transition-all text-base">{{ old('volunteer_experience') }}</textarea>
                    </div>

                    <!-- Terms agreement -->
                    <div class="flex items-start gap-3 pt-2">
                        <input type="checkbox" id="terms" name="terms" required class="checkbox checkbox-success mt-1">
                        <label for="terms" class="text-sm text-neutral-600 leading-relaxed cursor-pointer">
                            I agree to the terms and conditions and wish to be part of the community <span class="text-red-500">*</span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            class="w-full py-4 rounded-full bg-[#5E745D] hover:bg-[#4B5D4A] text-white font-heading font-bold text-[18px] shadow-lg hover:shadow-xl transition-all duration-300 active:scale-[0.98] flex items-center justify-center gap-2 mt-2">
                        <span>Join Volunteer Now</span>
                        <i data-lucide="check-circle" class="w-5 h-5"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- CTA SECTION -->
<x-cta :cta="$cta" :assets="$assets" />
@endsection
