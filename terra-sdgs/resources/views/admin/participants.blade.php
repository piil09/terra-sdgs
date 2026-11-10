@extends('admin.layout')

@section('title', 'Pengelolaan Peserta')
@section('breadcrumb', 'Peserta')

@section('content')
<div class="space-y-6">
    <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-2">
            <input type="text" placeholder="Cari nama, email, atau no. telp..." class="w-72 pl-3 py-1.5 text-xs rounded-xl border border-slate-200 bg-slate-50 focus:outline-none focus:border-forest-600">
            <select class="text-xs border border-slate-200 rounded-xl px-3 py-1.5 bg-slate-50 text-slate-600 focus:outline-none">
                <option>Semua Event</option>
                <option>Beach Clean-up at Ancol</option>
                <option>Zero Waste Living Workshop</option>
                <option>River Clean Up Action</option>
            </select>
        </div>
        <button class="px-4 py-2 border border-slate-200 rounded-xl text-xs font-bold text-slate-700 hover:bg-slate-50 flex items-center gap-2">
            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
            </svg>
            <span>Export CSV</span>
        </button>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/70 border-b border-slate-100 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                        <th class="py-3.5 px-6">ID & Nama Peserta</th>
                        <th class="py-3.5 px-6">Kontak</th>
                        <th class="py-3.5 px-6">Event yang Diikuti</th>
                        <th class="py-3.5 px-6">Kota / Profesi</th>
                        <th class="py-3.5 px-6">Waktu Daftar</th>
                        <th class="py-3.5 px-6">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs">
                    @foreach($admin['participants_list'] as $participant)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="py-4 px-6">
                            <div class="font-mono text-[11px] text-slate-400">{{ $participant['id'] }}</div>
                            <div class="font-bold text-slate-900">{{ $participant['name'] }}</div>
                        </td>
                        <td class="py-4 px-6">
                            <div class="text-slate-800">{{ $participant['email'] }}</div>
                            <div class="text-slate-400 text-[11px]">{{ $participant['phone'] }}</div>
                        </td>
                        <td class="py-4 px-6 font-medium text-slate-800">
                            {{ $participant['event_title'] }}
                        </td>
                        <td class="py-4 px-6 text-slate-600">
                            <div>{{ $participant['city'] }}</div>
                            <div class="text-slate-400 text-[11px]">{{ $participant['occupation'] }}</div>
                        </td>
                        <td class="py-4 px-6 text-slate-400">
                            {{ $participant['registered_at'] }}
                        </td>
                        <td class="py-4 px-6">
                            @if($participant['status'] === 'Terverifikasi')
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-semibold bg-emerald-50 text-emerald-700">Terverifikasi</span>
                            @else
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-semibold bg-amber-50 text-amber-700">Menunggu</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
