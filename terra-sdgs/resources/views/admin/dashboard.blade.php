@extends('admin.layout')

@section('title', 'Admin Dashboard')
@section('page_title', 'Dashboard Overview')

@section('content')
<div class="space-y-8">
    <!-- Top KPI Metrics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($admin['stats'] as $stat)
        <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col justify-between">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">{{ $stat['title'] }}</span>
                <span class="inline-flex items-center gap-1 text-xs font-bold px-2 py-1 rounded-full {{ $stat['trend_positive'] ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-700' }}">
                    {{ $stat['trend'] }}
                </span>
            </div>
            <div>
                <div class="text-2xl font-extrabold text-slate-900 tracking-tight">{{ $stat['value'] }}</div>
                <div class="text-xs text-slate-400 mt-1">{{ $stat['period'] }}</div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Middle Section: Chart & Recent Projects Preview -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Monthly Performance Chart Card -->
        <div class="lg:col-span-2 bg-white p-6 rounded-2xl border border-slate-200/85 shadow-sm">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-base font-bold text-slate-900">Performa Penghimpunan & Relawan</h2>
                    <p class="text-xs text-slate-400">Statistik bulanan kontribusi pelestarian lingkungan</p>
                </div>
                <select class="text-xs border border-slate-200 rounded-lg px-3 py-1.5 bg-slate-50 text-slate-600 focus:outline-none">
                    <option>Tahun 2026</option>
                    <option>Tahun 2025</option>
                </select>
            </div>

            <!-- Custom CSS Bar Chart Preview -->
            <div class="h-64 flex items-end justify-between gap-4 pt-6 px-4 border-b border-slate-100">
                @foreach($admin['chart_data'] as $item)
                <div class="flex-1 flex flex-col items-center gap-2 h-full justify-end group">
                    <div class="w-full flex items-end justify-center gap-1 h-52">
                        <!-- Donations Bar -->
                        <div style="height: {{ $item['donations'] * 1.2 }}%" class="w-4 bg-forest-600 rounded-t-lg transition-all group-hover:bg-forest-700 relative">
                            <span class="absolute -top-7 left-1/2 -translate-x-1/2 bg-slate-900 text-white text-[10px] px-1.5 py-0.5 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
                                {{ $item['donations'] }} jt
                            </span>
                        </div>
                        <!-- Volunteers Bar -->
                        <div style="height: {{ $item['volunteers'] * 0.7 }}%" class="w-4 bg-emerald-300 rounded-t-lg transition-all group-hover:bg-emerald-400"></div>
                    </div>
                    <span class="text-xs font-semibold text-slate-500">{{ $item['month'] }}</span>
                </div>
                @endforeach
            </div>
            
            <div class="flex items-center justify-center gap-6 pt-4 text-xs font-medium text-slate-600">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-forest-600"></span>
                    <span>Dana Donasi (Jutaan Rp)</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-emerald-300"></span>
                    <span>Jumlah Relawan</span>
                </div>
            </div>
        </div>

        <!-- Quick Activity / Audit Summary -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200/85 shadow-sm flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-base font-bold text-slate-900">Aktivitas Sistem</h2>
                    <a href="{{ route('admin.projects') }}" class="text-xs font-semibold text-forest-700 hover:underline">Lihat Semua</a>
                </div>
                <div class="space-y-4">
                    @foreach($admin['audit_logs'] as $log)
                    <div class="flex items-start gap-3 pb-3 border-b border-slate-100 last:border-0 last:pb-0">
                        <div class="w-8 h-8 rounded-full bg-forest-50 text-forest-700 flex items-center justify-center font-bold text-xs shrink-0 mt-0.5">
                            {{ substr($log['user'], 0, 1) }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="text-xs font-bold text-slate-900">{{ $log['action'] }}</div>
                            <div class="text-xs text-slate-500 truncate mt-0.5">{{ $log['target'] }}</div>
                            <div class="text-[10px] text-slate-400 mt-1">{{ $log['user'] }} • {{ $log['time'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="mt-6 pt-4 border-t border-slate-100">
                <a href="{{ route('admin.projects') }}" class="w-full py-2.5 rounded-xl border border-slate-200 text-xs font-bold text-slate-700 hover:bg-slate-50 flex items-center justify-center gap-2 transition-colors">
                    <span>Kelola Data Proyek</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Bottom Section: Recent Donations Table -->
    <div class="bg-white rounded-2xl border border-slate-200/85 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h2 class="text-base font-bold text-slate-900">Donasi & Transaksi Terbaru</h2>
                <p class="text-xs text-slate-400">Daftar kontribusi donatur yang masuk ke berbagai program konservasi</p>
            </div>
            <a href="{{ route('admin.donations') }}" class="text-xs font-semibold text-forest-700 hover:bg-forest-50 px-3 py-1.5 rounded-lg transition-colors">
                Kelola Semua Donasi &rarr;
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/70 border-b border-slate-100 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                        <th class="py-3 px-6">ID Transaksi</th>
                        <th class="py-3 px-6">Donatur</th>
                        <th class="py-3 px-6">Proyek Tujuan</th>
                        <th class="py-3 px-6">Nominal</th>
                        <th class="py-3 px-6">Metode</th>
                        <th class="py-3 px-6">Waktu</th>
                        <th class="py-3 px-6">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs">
                    @foreach($admin['recent_donations'] as $donation)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="py-4 px-6 font-semibold text-slate-900">{{ $donation['id'] }}</td>
                        <td class="py-4 px-6">
                            <div class="font-medium text-slate-900">{{ $donation['donor_name'] }}</div>
                            <div class="text-slate-400 text-[11px]">{{ $donation['donor_email'] }}</div>
                        </td>
                        <td class="py-4 px-6 text-slate-600 max-w-xs truncate">{{ $donation['project'] }}</td>
                        <td class="py-4 px-6 font-bold text-forest-700">{{ $donation['amount'] }}</td>
                        <td class="py-4 px-6 text-slate-600">{{ $donation['payment_method'] }}</td>
                        <td class="py-4 px-6 text-slate-400">{{ $donation['date'] }}</td>
                        <td class="py-4 px-6">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-semibold bg-emerald-50 text-emerald-700">
                                {{ $donation['status'] }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
