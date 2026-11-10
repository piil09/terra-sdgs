@extends('admin.layout')

@section('title', 'Donasi & Transaksi')
@section('page_title', 'Donasi & Rekapitulasi Keuangan')

@section('content')
<div class="space-y-6">
    <!-- Top Summary Banner -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm">
            <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Total Transaksi Berhasil</span>
            <div class="text-2xl font-extrabold text-slate-900 mt-2">Rp 128.450.000</div>
            <div class="text-xs text-emerald-600 font-semibold mt-1">↑ 148 Donasi Terverifikasi</div>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm">
            <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Menunggu Pembayaran</span>
            <div class="text-2xl font-extrabold text-amber-600 mt-2">Rp 4.250.000</div>
            <div class="text-xs text-slate-400 mt-1">6 Transaksi dalam batas waktu</div>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm">
            <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Rata-rata Donasi</span>
            <div class="text-2xl font-extrabold text-slate-900 mt-2">Rp 867.900</div>
            <div class="text-xs text-slate-400 mt-1">Per transaksi donatur</div>
        </div>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="p-4 border-b border-slate-100 flex items-center justify-between gap-4">
            <div class="flex items-center gap-2">
                <input type="text" placeholder="Cari kode transaksi atau nama donatur..." class="w-72 pl-3 py-1.5 text-xs rounded-xl border border-slate-200 bg-slate-50 focus:outline-none focus:border-forest-600">
                <select class="text-xs border border-slate-200 rounded-xl px-3 py-1.5 bg-slate-50 text-slate-600 focus:outline-none">
                    <option>Semua Metode</option>
                    <option>QRIS</option>
                    <option>Virtual Account</option>
                    <option>Bank Transfer</option>
                </select>
            </div>
            <button class="px-3.5 py-1.5 rounded-xl border border-slate-200 text-xs font-bold text-slate-700 hover:bg-slate-50 flex items-center gap-2">
                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                </svg>
                <span>Export CSV</span>
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/70 border-b border-slate-100 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                        <th class="py-3.5 px-6">Invoice</th>
                        <th class="py-3.5 px-6">Donatur</th>
                        <th class="py-3.5 px-6">Alokasi Proyek</th>
                        <th class="py-3.5 px-6">Nominal</th>
                        <th class="py-3.5 px-6">Metode</th>
                        <th class="py-3.5 px-6">Waktu Transaksi</th>
                        <th class="py-3.5 px-6">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs">
                    @foreach($admin['recent_donations'] as $donation)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="py-4 px-6 font-mono font-bold text-slate-900">{{ $donation['id'] }}</td>
                        <td class="py-4 px-6">
                            <div class="font-bold text-slate-900">{{ $donation['donor_name'] }}</div>
                            <div class="text-slate-400 text-[11px]">{{ $donation['donor_email'] }}</div>
                        </td>
                        <td class="py-4 px-6 text-slate-600 font-medium">{{ $donation['project'] }}</td>
                        <td class="py-4 px-6 font-bold text-forest-700">{{ $donation['amount'] }}</td>
                        <td class="py-4 px-6">
                            <span class="px-2 py-0.5 rounded-lg bg-slate-100 text-slate-700 text-[11px] font-medium">{{ $donation['payment_method'] }}</span>
                        </td>
                        <td class="py-4 px-6 text-slate-400">{{ $donation['date'] }}</td>
                        <td class="py-4 px-6">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-semibold bg-emerald-50 text-emerald-700">
                                Berhasil
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
