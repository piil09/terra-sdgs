@extends('layouts.app')

@section('title', 'Login — Terra')
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
                    <h1 class="font-heading font-normal text-3xl sm:text-[32px] text-[#131713]">
                        {{ $login['title'] ?? 'Welcome back!' }}
                    </h1>
                    <p class="text-neutral-500 text-sm">
                        {{ $login['subtitle'] ?? 'Sign in to access your volunteer dashboard and program impact.' }}
                    </p>
                </div>

                <form onsubmit="event.preventDefault(); alert('Simulasi Login Berhasil! Selamat datang di Terra.'); window.location.href='/';" class="flex flex-col gap-5">
                    <!-- Email -->
                    <div class="flex flex-col gap-1.5">
                        <label for="email" class="text-sm font-medium text-[#131713]">Email</label>
                        <div class="relative">
                            <i data-lucide="mail" class="w-5 h-5 text-neutral-400 absolute left-4 top-1/2 -translate-y-1/2"></i>
                            <input type="email" id="email" required placeholder="your.email@example.com"
                                   class="w-full pl-12 pr-4 py-3.5 rounded-xl bg-white border border-neutral-300 focus:border-[#5E745D] focus:ring-2 focus:ring-[#5E745D]/20 outline-none text-base">
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="flex flex-col gap-1.5">
                        <div class="flex items-center justify-between">
                            <label for="password" class="text-sm font-medium text-[#131713]">Password</label>
                            <a href="#" class="text-xs text-[#5E745D] hover:underline font-medium">
                                {{ $login['forgot_password'] ?? 'Forgot your password?' }}
                            </a>
                        </div>
                        <div class="relative">
                            <i data-lucide="lock" class="w-5 h-5 text-neutral-400 absolute left-4 top-1/2 -translate-y-1/2"></i>
                            <input type="password" id="password" required placeholder="••••••••"
                                   class="w-full pl-12 pr-4 py-3.5 rounded-xl bg-white border border-neutral-300 focus:border-[#5E745D] focus:ring-2 focus:ring-[#5E745D]/20 outline-none text-base">
                        </div>
                    </div>

                    <!-- Submit Login Button -->
                    <button type="submit" 
                            class="w-full py-4 rounded-full bg-[#5E745D] hover:bg-[#4B5D4A] text-white font-heading font-bold text-[18px] shadow-md hover:shadow-lg transition-all duration-300 active:scale-[0.98] mt-2">
                        Login
                    </button>

                    <!-- OR Divider -->
                    <div class="relative flex items-center justify-center my-2">
                        <div class="border-t border-neutral-200 w-full"></div>
                        <span class="bg-white px-3 text-xs uppercase text-neutral-400 font-medium">OR</span>
                        <div class="border-t border-neutral-200 w-full"></div>
                    </div>

                    <!-- Google OAuth Button -->
                    <button type="button" onclick="alert('Login Google diaktifkan pada produksi OAuth credentials.')"
                            class="w-full py-3.5 rounded-full border border-neutral-300 bg-white hover:bg-neutral-50 text-neutral-700 font-heading font-bold text-base transition-colors flex items-center justify-center gap-3">
                        <svg class="w-5 h-5" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                        </svg>
                        <span>Login with Google</span>
                    </button>

                    <p class="text-center text-sm text-neutral-600 mt-2">
                        Don't have an account? 
                        <a href="{{ route('events.register') }}" class="text-[#5E745D] font-bold hover:underline">
                            Sign up
                        </a>
                    </p>
                </form>
            </div>

            <!-- Right Side Image (matching Figma width 708, height 876) -->
            <div class="lg:col-span-6 relative overflow-hidden hidden lg:block">
                <img src="{{ asset('images/login_side.jpeg') }}" alt="Nature photography" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent flex flex-col justify-end p-12 text-white">
                    <span class="px-3 py-1 rounded-full bg-white/20 backdrop-blur w-fit text-xs font-bold uppercase mb-2">Terra Community</span>
                    <h3 class="font-heading font-medium text-3xl">Connecting Purpose with Action</h3>
                    <p class="text-neutral-200 text-sm mt-1 max-w-md">Join over 1,200 active volunteers creating measurable positive impact for our planet.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA SECTION -->
<x-cta :cta="$cta" :assets="$assets" />
@endsection
