@extends('admin.layout')

@section('title', 'Pengguna dan admin')
@section('breadcrumb', 'Pengguna dan admin')

@section('content')
<div class="space-y-6">
    <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between">
        <div class="flex items-center gap-3">
            <input type="text" placeholder="Cari nama atau email admin..." class="w-72 pl-3 py-1.5 text-xs rounded-xl border border-slate-200 bg-slate-50 focus:outline-none focus:border-forest-600">
            <select class="text-xs border border-slate-200 rounded-xl px-3 py-1.5 bg-slate-50 text-slate-600 focus:outline-none">
                <option>Semua Peran</option>
                <option>Super Admin</option>
                <option>Event Coordinator</option>
                <option>Content Editor</option>
            </select>
        </div>
        <button onclick="document.getElementById('modal-add-admin').classList.remove('hidden')" class="px-4 py-2 bg-forest-600 hover:bg-forest-700 text-white rounded-xl text-xs font-bold flex items-center gap-2 shadow-sm transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            <span>+ Tambah admin</span>
        </button>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/70 border-b border-slate-100 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                        <th class="py-3.5 px-6">Pengguna / Admin</th>
                        <th class="py-3.5 px-6">Peran Akses</th>
                        <th class="py-3.5 px-6">Tanggal Ditambahkan</th>
                        <th class="py-3.5 px-6">Status Akun</th>
                        <th class="py-3.5 px-6 text-right">Opsi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs">
                    @foreach($admin['admins_list'] as $user)
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
                            <form action="{{ route('admin.users.destroy', $user['id']) }}" method="POST" onsubmit="return confirm('Nonaktifkan akses admin ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50" title="Nonaktifkan">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Admin (Sesuai Frame Figma: Tambah admin) -->
<div id="modal-add-admin" class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-2xl max-w-md w-full">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h3 class="text-sm font-bold text-slate-900">Tambah Admin Baru</h3>
                <p class="text-xs text-slate-400">Berikan akses manajemen sistem portal Terra</p>
            </div>
            <button onclick="document.getElementById('modal-add-admin').classList.add('hidden')" class="p-2 text-slate-400 hover:text-slate-600 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <form action="{{ route('admin.users.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Nama Lengkap</label>
                <input type="text" name="name" required placeholder="Nama lengkap admin..." class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:border-forest-600">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Email Resmi</label>
                <input type="email" name="email" required placeholder="admin@terra-sdgs.id" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:border-forest-600">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Peran Akses</label>
                <select name="role" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:border-forest-600 bg-white">
                    <option>Super Admin</option>
                    <option>Event Coordinator</option>
                    <option>Content Editor</option>
                    <option>Admin</option>
                </select>
            </div>

            <div class="pt-4 flex items-center justify-end gap-3">
                <button type="button" onclick="document.getElementById('modal-add-admin').classList.add('hidden')" class="px-4 py-2 text-xs font-semibold text-slate-600 hover:text-slate-900">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-forest-600 hover:bg-forest-700 text-white text-xs font-bold shadow-md transition-all">
                    Kirim Undangan Akses
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
