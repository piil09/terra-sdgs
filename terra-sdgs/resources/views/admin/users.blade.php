@extends('admin.layout')

@section('title', 'Kelola Pengguna & Tim')
@section('page_title', 'Pengguna & Hak Akses Tim')

@section('content')
<div class="space-y-6">
    <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between">
        <div class="flex items-center gap-3">
            <input type="text" placeholder="Cari nama atau email tim..." class="w-72 pl-3 py-1.5 text-xs rounded-xl border border-slate-200 bg-slate-50 focus:outline-none focus:border-forest-600">
            <select class="text-xs border border-slate-200 rounded-xl px-3 py-1.5 bg-slate-50 text-slate-600 focus:outline-none">
                <option>Semua Peran</option>
                <option>Super Admin</option>
                <option>Project Manager</option>
                <option>Content Editor</option>
            </select>
        </div>
        <button class="px-4 py-2 bg-forest-600 hover:bg-forest-700 text-white rounded-xl text-xs font-bold flex items-center gap-2 shadow-sm transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            <span>+ Undang Anggota</span>
        </button>
    </div>

    <!-- Users Table -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/70 border-b border-slate-100 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                        <th class="py-3.5 px-6">Anggota Tim</th>
                        <th class="py-3.5 px-6">Peran Akses</th>
                        <th class="py-3.5 px-6">Tanggal Bergabung</th>
                        <th class="py-3.5 px-6">Status Akun</th>
                        <th class="py-3.5 px-6 text-right">Opsi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs">
                    @foreach($admin['users'] as $user)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-3">
                                <img src="{{ $user['avatar'] }}" alt="{{ $user['name'] }}" class="w-9 h-9 rounded-full object-cover">
                                <div>
                                    <div class="font-bold text-slate-900">{{ $user['name'] }}</div>
                                    <div class="text-slate-400 text-[11px]">{{ $user['email'] }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-forest-50 text-forest-700 border border-forest-200/60">
                                {{ $user['role'] }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-slate-500">{{ $user['joined_at'] }}</td>
                        <td class="py-4 px-6">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-emerald-50 text-emerald-700">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                Aktif
                            </span>
                        </td>
                        <td class="py-4 px-6 text-right">
                            <button class="p-1.5 rounded-lg text-slate-400 hover:text-slate-700 hover:bg-slate-100">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                </svg>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
