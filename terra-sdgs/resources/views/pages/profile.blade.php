@extends('layouts.app')

@section('title', 'Profil Anggota — Terra')
@section('meta_description', 'Kelola pendaftaran kegiatan relawan dan profil akun Anda.')

@section('content')
<section class="w-full py-16 md:py-24 bg-[#FAFAFA] min-h-[700px]">
    <div class="max-w-[1200px] mx-auto px-6">
        <!-- Profile Header Card -->
        <div class="bg-white p-8 rounded-[32px] border border-neutral-200/80 shadow-sm flex flex-col md:flex-row items-center justify-between gap-6 mb-10">
            <div class="flex items-center gap-5">
                <div class="w-20 h-20 rounded-full bg-[#EBF2EA] text-[#5E745D] font-bold text-2xl flex items-center justify-center shrink-0">
                    {{ strtoupper(substr($user['name'] ?? 'U', 0, 2)) }}
                </div>
                <div>
                    <div class="inline-block px-3 py-1 rounded-full bg-[#EBF2EA] text-[#5E745D] text-xs font-bold mb-2">
                        {{ $user['role'] ?? 'Volunteer' }}
                    </div>
                    <h1 class="font-heading font-bold text-2xl md:text-3xl text-[#131713]">{{ $user['name'] ?? 'Anggota Terra' }}</h1>
                    <p class="text-neutral-500 text-sm mt-0.5">{{ $user['email'] ?? '' }}</p>
                </div>
            </div>

            <div>
                <form action="{{ route('user.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-6 py-3 rounded-full border border-neutral-300 hover:bg-neutral-50 text-neutral-800 font-heading font-bold text-sm transition-colors flex items-center gap-2">
                        <i data-lucide="log-out" class="w-4 h-4"></i>
                        <span>Keluar Akun</span>
                    </button>
                </form>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 rounded-2xl bg-[#EBF2EA] text-[#384638] text-sm font-medium border border-[#D6E3D4]">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 rounded-2xl bg-red-50 text-red-700 text-sm font-medium border border-red-200">
                {{ session('error') }}
            </div>
        @endif

        <!-- My Registered Events -->
        <div class="bg-white rounded-[32px] border border-neutral-200/80 shadow-sm p-8">
            <h2 class="font-heading font-bold text-xl text-[#131713] mb-6 flex items-center justify-between">
                <span>Riwayat Pendaftaran Kegiatan Relawan</span>
                <a href="{{ route('events') }}" class="text-sm font-semibold text-[#5E745D] hover:underline">Cari Event Lain &rarr;</a>
            </h2>

            @if(count($registrations) > 0)
                <div class="space-y-4">
                    @foreach($registrations as $reg)
                        <div class="p-5 rounded-2xl bg-[#F9FAF9] border border-neutral-200/60 flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <div>
                                <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold inline-block mb-2">Terdaftar</span>
                                <h3 class="font-heading font-bold text-lg text-[#131713]">{{ $reg->full_name }}</h3>
                                <p class="text-neutral-500 text-xs mt-1">Minat & Peran: <span class="font-semibold text-neutral-800">{{ $reg->interest }}</span> • Kota: {{ $reg->city }}</p>
                            </div>
                            <div class="text-right text-xs text-neutral-400">
                                <div>Didaftarkan pada:</div>
                                <div class="font-semibold text-neutral-700">{{ $reg->created_at->format('d M Y, H:i') }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12 border-2 border-dashed border-neutral-200 rounded-2xl">
                    <p class="text-neutral-500 text-sm mb-4">Anda belum mendaftarkan diri pada kegiatan pelestarian manapun.</p>
                    <a href="{{ route('events') }}" class="px-6 py-3 rounded-full bg-[#5E745D] text-white font-heading font-bold text-sm inline-block shadow">
                        Jelajahi Event Sekarang
                    </a>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
