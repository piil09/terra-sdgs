@extends('layouts.app')

@section('title', 'Login Anggota — Terra')
@section('meta_description', 'Welcome back to Terra. Sign in to your green community account.')

@section('content')
<section class="w-full py-12 md:py-20 bg-white">
    <div class="max-w-[1416px] mx-auto px-4 md:px-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 rounded-[32px] overflow-hidden border border-neutral-200/80 shadow-2xl bg-white min-h-[750px]">
            <!-- Left Side Login Form (matching Figma Frame 222, width ~708px) -->
            <div class="lg:col-span-6 p-8 md:p-16 lg:p-20 flex flex-col justify-center max-w-[600px] mx-auto w-full">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-full bg-[#EBF2EA] flex items-center justify-center text-[#5E745D]">
                        <img src="{{ asset('svgs/logo.svg') }}" alt="Terra" class="w-6 h-6 text-[#5E745D]">
                    </div>
                    <span class="font-heading font-medium text-2xl text-[#131713]">Terra</span>
                </div>

                <div class="flex flex-col gap-2 mb-8">
                    <div class="inline-block px-3 py-1 rounded-full bg-[#EBF2EA] text-[#5E745D] text-xs font-bold w-fit mb-1">
                        Portal Akun Anggota / Relawan
                    </div>
                    <h1 class="font-heading font-normal text-3xl sm:text-[32px] text-[#131713] leading-tight">
                        {{ $login['title'] ?? 'Welcome back! Please enter your details.' }}
                    </h1>
                </div>

                @if(session('success'))
                    <div class="mb-5 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-medium">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-5 p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 text-xs font-medium">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login.submit') }}" class="flex flex-col gap-6">
                    @csrf
                    <!-- Email input -->
                    <div class="flex flex-col gap-2">
                        <label for="email" class="font-heading font-medium text-[16px] text-[#131713]">Email</label>
                        <input type="email" id="email" name="email" placeholder="user@terra-sdgs.id" required
                               class="w-full px-5 py-4 rounded-2xl border border-neutral-300 focus:outline-none focus:border-[#5E745D] focus:ring-1 focus:ring-[#5E745D] font-sans text-base transition-colors bg-[#F9FAF9]">
                    </div>

                    <!-- Password input -->
                    <div class="flex flex-col gap-2">
                        <label for="password" class="font-heading font-medium text-[16px] text-[#131713]">Password</label>
                        <input type="password" id="password" name="password" placeholder="••••••••" required
                               class="w-full px-5 py-4 rounded-2xl border border-neutral-300 focus:outline-none focus:border-[#5E745D] focus:ring-1 focus:ring-[#5E745D] font-sans text-base transition-colors bg-[#F9FAF9]">
                    </div>

                    <!-- Remember & Forgot -->
                    <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="remember" class="w-4 h-4 rounded text-[#5E745D] focus:ring-[#5E745D] border-neutral-300">
                            <span class="text-neutral-600 font-sans">Remember for 30 days</span>
                        </label>
                        <a href="#" class="text-[#5E745D] font-heading font-medium hover:underline">Forgot password</a>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            class="w-full py-4 rounded-full bg-[#5E745D] hover:bg-[#4B5D4A] text-white font-heading font-bold text-lg shadow-md hover:shadow-lg transition-all duration-200 active:scale-95 text-center mt-2">
                        Sign In as Member
                    </button>

                    <!-- Notice for Admin -->
                    <div class="mt-4 p-4 rounded-2xl bg-neutral-50 border border-neutral-200 text-xs text-neutral-500 flex items-center justify-between">
                        <span>Apakah Anda pengelola internal?</span>
                        <a href="{{ route('admin.login') }}" class="font-bold text-[#5E745D] hover:underline">Masuk ke Portal Admin &rarr;</a>
                    </div>
                </form>
            </div>

            <!-- Right Side Image (Frame 223 in Figma) -->
            <div class="hidden lg:block lg:col-span-6 relative overflow-hidden bg-neutral-900 m-4 rounded-[28px]">
                <img src="{{ asset('images/login_side.jpeg') }}" alt="Nature Pathway" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>
                <div class="absolute bottom-12 left-12 right-12 text-white">
                    <p class="font-heading font-medium text-2xl lg:text-3xl leading-snug">
                        "Every small step taken in harmony with nature leads to a flourishing future for all."
                    </p>
                    <span class="block mt-4 text-sm font-sans text-neutral-300 tracking-wide">— Terra Conservation Movement</span>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
