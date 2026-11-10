@extends('admin.layout')

@section('title', 'Log Aktivitas')
@section('breadcrumb', 'Log aktivitas')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold text-slate-900 tracking-tight">Log Aktivitas Sistem</h1>
            <p class="text-xs text-slate-500 mt-0.5">Catatan audit perubahan data, penambahan event, dan aksi admin secara real-time</p>
        </div>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/70 border-b border-slate-100 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                        <th class="py-3.5 px-6">Aktivitas</th>
                        <th class="py-3.5 px-6">Objek / Target</th>
                        <th class="py-3.5 px-6">Pelaksana (Admin)</th>
                        <th class="py-3.5 px-6">Waktu</th>
                        <th class="py-3.5 px-6">Alamat IP</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs">
                    @foreach($admin['audit_logs'] as $log)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="py-4 px-6">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full font-semibold text-[11px] bg-slate-100 text-slate-700">
                                {{ $log['action'] }}
                            </span>
                        </td>
                        <td class="py-4 px-6 font-medium text-slate-900">
                            {{ $log['target'] }}
                        </td>
                        <td class="py-4 px-6 text-slate-700 font-semibold">
                            {{ $log['user'] }}
                        </td>
                        <td class="py-4 px-6 text-slate-400">
                            {{ $log['time'] }}
                        </td>
                        <td class="py-4 px-6 font-mono text-[11px] text-slate-400">
                            {{ $log['ip'] }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
