@extends('admin.layout')

@section('title', 'Daftar Event')
@section('breadcrumb', 'Event')

@section('content')
<div class="space-y-6">
    <!-- Header with Search, Filter & Tambah Event CTA -->
    <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-1 bg-slate-100/70 p-1 rounded-xl text-xs font-semibold">
            <button class="px-3.5 py-1.5 rounded-lg bg-white text-slate-900 shadow-sm">Semua (12)</button>
            <button class="px-3.5 py-1.5 rounded-lg text-slate-500 hover:text-slate-900">Aktif (8)</button>
            <button class="px-3.5 py-1.5 rounded-lg text-slate-500 hover:text-slate-900">Selesai (4)</button>
        </div>

        <div class="flex items-center gap-3 w-full sm:w-auto">
            <div class="relative flex-1 sm:w-64">
                <input type="text" placeholder="Cari nama event..." class="w-full pl-9 pr-3 py-1.5 text-xs rounded-xl border border-slate-200 bg-slate-50 focus:outline-none focus:border-forest-600">
                <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>

            <button onclick="document.getElementById('modal-add-event').classList.remove('hidden')" class="px-4 py-2 bg-forest-600 hover:bg-forest-700 text-white rounded-xl text-xs font-bold flex items-center gap-2 shadow-sm transition-all shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>+ Tambah event</span>
            </button>
        </div>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/70 border-b border-slate-100 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                        <th class="py-3.5 px-6">Informasi Event</th>
                        <th class="py-3.5 px-6">Kategori</th>
                        <th class="py-3.5 px-6">Waktu & Tempat</th>
                        <th class="py-3.5 px-6">Kuota</th>
                        <th class="py-3.5 px-6">Status</th>
                        <th class="py-3.5 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs">
                    @foreach($admin['events_list'] as $event)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-3">
                                <img src="{{ $event['image'] }}" alt="{{ $event['title'] }}" class="w-12 h-12 rounded-xl object-cover border border-slate-200 shrink-0">
                                <div>
                                    <div class="font-bold text-slate-900">{{ $event['title'] }}</div>
                                    <div class="text-[11px] text-slate-400">{{ $event['time'] }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-slate-100 text-slate-700">
                                {{ $event['category'] }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-slate-600">
                            <div class="font-medium text-slate-900">{{ $event['date'] }}</div>
                            <div class="text-slate-400 text-[11px]">{{ $event['location'] }}</div>
                        </td>
                        <td class="py-4 px-6">
                            <div class="font-bold text-slate-900">{{ $event['registered'] }} / {{ $event['quota'] }}</div>
                            <div class="w-24 bg-slate-100 h-1.5 rounded-full overflow-hidden mt-1">
                                <div class="bg-forest-600 h-1.5 rounded-full" style="width: {{ round(($event['registered'] / $event['quota']) * 100) }}%"></div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            @if($event['status'] === 'Aktif')
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-semibold bg-emerald-50 text-emerald-700">Aktif</span>
                            @elseif($event['status'] === 'Penuh')
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-semibold bg-amber-50 text-amber-700">Penuh</span>
                            @else
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-semibold bg-slate-100 text-slate-600">Selesai</span>
                            @endif
                        </td>
                        <td class="py-4 px-6 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button class="p-1.5 rounded-lg text-slate-400 hover:text-slate-700 hover:bg-slate-100" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                    </svg>
                                </button>
                                <form action="{{ route('admin.events.destroy', $event['id']) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus event ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Event (Sesuai Frame Figma: Tambah event) -->
<div id="modal-add-event" class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h3 class="text-sm font-bold text-slate-900">Tambah Event Baru</h3>
                <p class="text-xs text-slate-400">Lengkapi jadwal, lokasi, dan kuota kegiatan</p>
            </div>
            <button onclick="document.getElementById('modal-add-event').classList.add('hidden')" class="p-2 text-slate-400 hover:text-slate-600 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <form action="{{ route('admin.events.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Judul Event</label>
                <input type="text" name="title" required placeholder="Contoh: Beach Clean-up at Ancol" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:border-forest-600">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Kategori</label>
                    <select name="category" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:border-forest-600 bg-white">
                        <option>Pembersihan Pesisir</option>
                        <option>Edukasi & Workshop</option>
                        <option>Konservasi Sungai</option>
                        <option>Reboisasi Mangrove</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Kuota Peserta</label>
                    <input type="number" name="quota" required placeholder="100" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:border-forest-600">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Tanggal Kegiatan</label>
                    <input type="text" name="date" required placeholder="Contoh: 15 Nov 2026" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:border-forest-600">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Waktu</label>
                    <input type="text" name="time" required placeholder="Contoh: 08:00 - 12:00 WIB" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:border-forest-600">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Lokasi Kegiatan</label>
                <input type="text" name="location" required placeholder="Pantai Ancol, Jakarta Utara" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:border-forest-600">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Deskripsi Kegiatan</label>
                <textarea rows="3" name="description" placeholder="Jelaskan agenda aksi, perlengkapan yang disiapkan, dan manfaat kegiatan..." class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:border-forest-600"></textarea>
            </div>

            <div class="pt-4 flex items-center justify-end gap-3">
                <button type="button" onclick="document.getElementById('modal-add-event').classList.add('hidden')" class="px-4 py-2 text-xs font-semibold text-slate-600 hover:text-slate-900">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-forest-600 hover:bg-forest-700 text-white text-xs font-bold shadow-md transition-all">
                    Simpan & Publikasikan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
