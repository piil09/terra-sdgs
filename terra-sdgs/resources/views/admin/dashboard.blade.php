@extends('admin.layout')

@section('title', 'Admin Dashboard')
@section('breadcrumb', 'Dashboard')

@section('content')
<div class="space-y-8">
    <!-- Page Heading (Figma: Page heading w=1152, h=62) -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-[#131713] tracking-tight">Dashboard Ringkasan</h1>
            <p class="text-xs text-[#646464] mt-1">Pantau seluruh aktivitas kegiatan pelestarian, pendaftar, dan publikasi artikel Terra SDGs.</p>
        </div>
        <div class="flex items-center gap-3">
            <button class="px-4 py-2 border border-[#E5E7EB] hover:bg-[#F9FAF9] text-[#131713] rounded-xl text-xs font-bold transition-all">
                Unduh laporan
            </button>
            <a href="{{ route('admin.events') }}" class="px-4 py-2 bg-[#5E745D] hover:bg-[#4B5D4A] text-white rounded-xl text-xs font-bold flex items-center gap-2 shadow-sm transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>+ Tambah event</span>
            </a>
        </div>
    </div>

    <!-- Overview 4 Metrics Row (Figma: Overview metrics w=1152, h=135) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($admin['stats'] as $stat)
        <div class="bg-white p-5 rounded-2xl border border-[#E5E7EB] shadow-sm flex flex-col justify-between">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold text-[#646464]">{{ $stat['title'] }}</span>
                <span class="text-[11px] font-bold px-2 py-0.5 rounded-full {{ $stat['trend_positive'] ? 'bg-[#EBF2EA] text-[#5E745D]' : 'bg-neutral-100 text-neutral-600' }}">
                    {{ $stat['trend'] }}
                </span>
            </div>
            <div>
                <div class="text-3xl font-extrabold text-[#131713] tracking-tight">{{ $stat['value'] }}</div>
                <div class="text-[11px] text-neutral-400 mt-1.5">{{ $stat['period'] }}</div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Middle Grid: Chart Pendaftar Bulanan & Log Aktivitas -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Chart Card (Pendaftar per bulan) -->
        <div class="lg:col-span-2 bg-white p-6 rounded-2xl border border-[#E5E7EB] shadow-sm flex flex-col justify-between">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-sm font-bold text-[#131713]">Pertumbuhan Pendaftar Kegiatan</h2>
                    <p class="text-xs text-neutral-400">Tren antusiasme relawan mengikuti program lingkungan tahun 2026</p>
                </div>
                <span class="text-xs font-semibold px-3 py-1 bg-[#F9FAF9] border border-[#E5E7EB] rounded-lg text-neutral-600">2026</span>
            </div>

            <!-- Custom Bar Chart Visualizing Registrations -->
            <div class="h-60 flex items-end justify-between gap-4 pt-6 px-4 border-b border-neutral-100">
                @foreach($admin['chart_data'] as $item)
                <div class="flex-1 flex flex-col items-center gap-2 h-full justify-end group">
                    <div class="w-full flex items-end justify-center h-48">
                        <div style="height: {{ ($item['registrations'] / 200) * 100 }}%" class="w-6 bg-[#5E745D] rounded-t-lg transition-all group-hover:bg-[#4B5D4A] relative">
                            <span class="absolute -top-7 left-1/2 -translate-x-1/2 bg-[#131713] text-white text-[10px] px-1.5 py-0.5 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
                                {{ $item['registrations'] }} orang
                            </span>
                        </div>
                    </div>
                    <span class="text-xs font-semibold text-[#646464]">{{ $item['month'] }}</span>
                </div>
                @endforeach
            </div>
            
            <div class="flex items-center gap-4 pt-4 text-xs font-medium text-[#646464]">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-md bg-[#5E745D]"></span>
                    <span>Pendaftar Terverifikasi per Bulan</span>
                </div>
            </div>
        </div>

        <!-- Log Aktivitas Terakhir -->
        <div class="bg-white p-6 rounded-2xl border border-[#E5E7EB] shadow-sm flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-sm font-bold text-[#131713]">Log Aktivitas Terbaru</h2>
                    <a href="{{ route('admin.logs') }}" class="text-xs font-semibold text-[#5E745D] hover:underline">Lihat Semua</a>
                </div>
                <div class="space-y-4">
                    @foreach($admin['audit_logs'] as $log)
                    <div class="flex items-start gap-3 pb-3 border-b border-neutral-100 last:border-0 last:pb-0">
                        <div class="w-7 h-7 rounded-full bg-[#EBF2EA] text-[#5E745D] flex items-center justify-center font-bold text-xs shrink-0 mt-0.5">
                            {{ substr($log['user'], 0, 1) }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="text-xs font-bold text-[#131713]">{{ $log['action'] }}</div>
                            <div class="text-xs text-neutral-500 truncate mt-0.5">{{ $log['target'] }}</div>
                            <div class="text-[10px] text-neutral-400 mt-1">{{ $log['user'] }} • {{ $log['time'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="mt-6 pt-4 border-t border-neutral-100">
                <a href="{{ route('admin.events') }}" class="w-full py-2.5 rounded-xl border border-[#E5E7EB] text-xs font-bold text-[#131713] hover:bg-[#F9FAF9] flex items-center justify-center gap-2 transition-colors">
                    <span>Kelola Semua Event</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Bottom Section: Daftar Event Aktif & Pendaftar Terkini -->
    <div class="bg-white rounded-2xl border border-[#E5E7EB] shadow-sm overflow-hidden">
        <div class="p-5 border-b border-neutral-100 flex items-center justify-between">
            <div>
                <h2 class="text-sm font-bold text-[#131713]">Event & Pendaftar Terkini</h2>
                <p class="text-xs text-neutral-400">Status kuota kegiatan yang sedang berjalan</p>
            </div>
            <a href="{{ route('admin.events') }}" class="text-xs font-semibold text-[#5E745D] hover:bg-[#EBF2EA] px-3 py-1.5 rounded-lg transition-colors">
                Lihat Semua Event &rarr;
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#F9FAF9] border-b border-neutral-100 text-[11px] font-bold text-neutral-400 uppercase tracking-wider">
                        <th class="py-3 px-6">Nama Event</th>
                        <th class="py-3 px-6">Kategori</th>
                        <th class="py-3 px-6">Waktu & Lokasi</th>
                        <th class="py-3 px-6">Kuota Terisi</th>
                        <th class="py-3 px-6">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-100 text-xs">
                    @foreach($admin['events_list'] as $event)
                    <tr class="hover:bg-[#F9FAF9]/50 transition-colors">
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-3">
                                <img src="{{ $event['image'] }}" alt="{{ $event['title'] }}" class="w-10 h-10 rounded-xl object-cover border border-neutral-200 shrink-0">
                                <span class="font-bold text-[#131713]">{{ $event['title'] }}</span>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-neutral-100 text-neutral-700">
                                {{ $event['category'] }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-[#646464]">
                            <div>{{ $event['date'] }}</div>
                            <div class="text-neutral-400 text-[11px]">{{ $event['location'] }}</div>
                        </td>
                        <td class="py-4 px-6">
                            <div class="font-bold text-[#131713]">{{ $event['registered'] }} / {{ $event['quota'] }}</div>
                            <div class="w-24 bg-neutral-100 h-1.5 rounded-full overflow-hidden mt-1">
                                <div class="bg-[#5E745D] h-1.5 rounded-full" style="width: {{ round(($event['registered'] / $event['quota']) * 100) }}%"></div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            @if($event['status'] === 'Aktif')
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-semibold bg-[#EBF2EA] text-[#5E745D]">Aktif</span>
                            @elseif($event['status'] === 'Penuh')
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-semibold bg-amber-50 text-amber-700">Penuh</span>
                            @else
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-semibold bg-neutral-100 text-neutral-600">Selesai</span>
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
