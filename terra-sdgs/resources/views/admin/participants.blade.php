@extends('admin.layout')

@section('title', 'Pengelolaan Peserta')
@section('breadcrumb', 'Peserta')

@section('content')
<div class="space-y-6">
    <div class="bg-white p-4 rounded-2xl border border-[#E5E7EB] shadow-sm flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <input type="text" placeholder="Cari nama, email, atau no. telp..." class="w-72 pl-3 py-1.5 text-xs rounded-xl border border-[#E5E7EB] bg-[#F9FAF9] focus:outline-none focus:border-[#5E745D]">
            <span class="text-xs font-bold text-[#5E745D] bg-[#EBF2EA] px-3 py-1.5 rounded-xl">
                Total Pendaftar Live: {{ $participants_list->count() }} Orang
            </span>
        </div>
        <button class="px-4 py-2 border border-[#E5E7EB] rounded-xl text-xs font-bold text-[#131713] hover:bg-[#F9FAF9] flex items-center gap-2">
            <svg class="w-4 h-4 text-neutral-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
            </svg>
            <span>Export CSV</span>
        </button>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-2xl border border-[#E5E7EB] shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#F9FAF9] border-b border-neutral-100 text-[11px] font-bold text-neutral-400 uppercase tracking-wider">
                        <th class="py-3.5 px-6">ID & Nama Peserta</th>
                        <th class="py-3.5 px-6">Kontak</th>
                        <th class="py-3.5 px-6">Event yang Diikuti</th>
                        <th class="py-3.5 px-6">Kota / Profesi</th>
                        <th class="py-3.5 px-6">Waktu Daftar</th>
                        <th class="py-3.5 px-6">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-100 text-xs">
                    @forelse($participants_list as $participant)
                    <tr class="hover:bg-[#F9FAF9]/50 transition-colors">
                        <td class="py-4 px-6">
                            <div class="font-mono text-[11px] text-neutral-400">REG-{{ str_pad($participant['id'], 3, '0', STR_PAD_LEFT) }}</div>
                            <div class="font-bold text-[#131713]">{{ $participant['full_name'] }}</div>
                        </td>
                        <td class="py-4 px-6">
                            <div class="text-[#131713]">{{ $participant['email'] }}</div>
                            <div class="text-neutral-400 text-[11px]">{{ $participant['phone'] }}</div>
                        </td>
                        <td class="py-4 px-6 font-medium text-[#131713]">
                            {{ $participant['interest'] }}
                        </td>
                        <td class="py-4 px-6 text-[#646464]">
                            <div>{{ $participant['city'] }}</div>
                            <div class="text-neutral-400 text-[11px]">{{ $participant['occupation'] }}</div>
                        </td>
                        <td class="py-4 px-6 text-neutral-400">
                            {{ $participant['created_at']->format('d M Y, H:i') }}
                        </td>
                        <td class="py-4 px-6">
                            <span class="px-2.5 py-1 rounded-full text-[11px] font-semibold bg-[#EBF2EA] text-[#5E745D]">
                                {{ $participant['status'] ?? 'Terverifikasi' }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-10 text-neutral-400 text-xs">
                            Belum ada pendaftar event relawan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
