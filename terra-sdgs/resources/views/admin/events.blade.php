@extends('admin.layout')

@section('title', 'Daftar Event')
@section('breadcrumb', 'Event')

@section('content')
<div class="space-y-6">
    <!-- Header with Search, Category Filter Tabs & Tambah Event CTA -->
    <div class="bg-white p-4 rounded-2xl border border-[#E5E7EB] shadow-sm flex flex-col sm:flex-row items-center justify-between gap-4">
        <!-- Exact Category Filter Tabs -->
        <div class="flex items-center gap-1.5 bg-[#F9FAF9] p-1.5 rounded-xl text-xs font-semibold overflow-x-auto max-w-full">
            <a href="{{ route('admin.events') }}" class="px-3.5 py-1.5 rounded-lg transition-all {{ ($selectedCategory ?? 'All') === 'All' ? 'bg-white text-[#131713] shadow-sm font-bold' : 'text-[#646464] hover:text-[#131713]' }}">
                Semua ({{ $all_events->count() }})
            </a>
            <a href="{{ route('admin.events', ['category' => 'Clean Up']) }}" class="px-3.5 py-1.5 rounded-lg transition-all {{ ($selectedCategory ?? '') === 'Clean Up' ? 'bg-white text-[#131713] shadow-sm font-bold' : 'text-[#646464] hover:text-[#131713]' }}">
                Clean Up ({{ $all_events->where('category', 'Clean Up')->count() }})
            </a>
            <a href="{{ route('admin.events', ['category' => 'Workshop']) }}" class="px-3.5 py-1.5 rounded-lg transition-all {{ ($selectedCategory ?? '') === 'Workshop' ? 'bg-white text-[#131713] shadow-sm font-bold' : 'text-[#646464] hover:text-[#131713]' }}">
                Workshop ({{ $all_events->where('category', 'Workshop')->count() }})
            </a>
            <a href="{{ route('admin.events', ['category' => 'Reboisasi']) }}" class="px-3.5 py-1.5 rounded-lg transition-all {{ ($selectedCategory ?? '') === 'Reboisasi' ? 'bg-white text-[#131713] shadow-sm font-bold' : 'text-[#646464] hover:text-[#131713]' }}">
                Reboisasi ({{ $all_events->where('category', 'Reboisasi')->count() }})
            </a>
            <a href="{{ route('admin.events', ['category' => 'Edukasi']) }}" class="px-3.5 py-1.5 rounded-lg transition-all {{ ($selectedCategory ?? '') === 'Edukasi' ? 'bg-white text-[#131713] shadow-sm font-bold' : 'text-[#646464] hover:text-[#131713]' }}">
                Edukasi ({{ $all_events->where('category', 'Edukasi')->count() }})
            </a>
        </div>

        <div class="flex items-center gap-3 w-full sm:w-auto">
            <div class="relative flex-1 sm:w-60">
                <input type="text" placeholder="Filter nama event..." class="w-full pl-9 pr-3 py-1.5 text-xs rounded-xl border border-[#E5E7EB] bg-[#F9FAF9] focus:outline-none focus:border-[#5E745D]">
                <svg class="w-4 h-4 text-neutral-400 absolute left-3 top-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>

            <button onclick="document.getElementById('modal-add-event').classList.remove('hidden')" class="px-4 py-2 bg-[#5E745D] hover:bg-[#4B5D4A] text-white rounded-xl text-xs font-bold flex items-center gap-2 shadow-sm transition-all shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>+ Tambah event</span>
            </button>
        </div>
    </div>

    <!-- Live Events Data Table Container -->
    <div class="bg-white rounded-2xl border border-[#E5E7EB] shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#F9FAF9] border-b border-neutral-100 text-[11px] font-bold text-neutral-400 uppercase tracking-wider">
                        <th class="py-3.5 px-6">Informasi Event</th>
                        <th class="py-3.5 px-6">Kategori</th>
                        <th class="py-3.5 px-6">Waktu & Tempat</th>
                        <th class="py-3.5 px-6">Kuota</th>
                        <th class="py-3.5 px-6">Status</th>
                        <th class="py-3.5 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-100 text-xs">
                    @forelse($events_list as $event)
                    <tr class="hover:bg-[#F9FAF9]/50 transition-colors">
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-3">
                                <img src="{{ asset($event['image']) }}" alt="{{ $event['title'] }}" class="w-12 h-12 rounded-xl object-cover border border-neutral-200 shrink-0">
                                <div>
                                    <div class="font-bold text-[#131713]">{{ $event['title'] }}</div>
                                    <div class="text-[11px] text-neutral-400">{{ $event['time'] }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            @php
                                $catBadge = match($event['category']) {
                                    'Clean Up' => 'bg-blue-50 text-blue-700 border-blue-200/60',
                                    'Workshop' => 'bg-emerald-50 text-emerald-700 border-emerald-200/60',
                                    'Reboisasi' => 'bg-amber-50 text-amber-700 border-amber-200/60',
                                    'Edukasi' => 'bg-purple-50 text-purple-700 border-purple-200/60',
                                    default => 'bg-neutral-100 text-neutral-700 border-neutral-200'
                                };
                            @endphp
                            <span class="px-2.5 py-1 rounded-full text-[11px] font-semibold border {{ $catBadge }}">
                                {{ $event['category'] }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-[#646464]">
                            <div class="font-medium text-[#131713]">{{ $event['date'] }}</div>
                            <div class="text-neutral-400 text-[11px]">{{ $event['location'] }}</div>
                        </td>
                        <td class="py-4 px-6">
                            <div class="font-bold text-[#131713]">{{ $event['quota'] }}</div>
                            <div class="w-24 bg-neutral-100 h-1.5 rounded-full overflow-hidden mt-1">
                                <div class="bg-[#5E745D] h-1.5 rounded-full" style="width: 70%"></div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            @if(str_contains(strtolower($event['status']), 'open') || $event['status'] === 'Aktif')
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-semibold bg-[#EBF2EA] text-[#5E745D]">Open Registration</span>
                            @else
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-semibold bg-neutral-100 text-neutral-600">{{ $event['status'] }}</span>
                            @endif
                        </td>
                        <td class="py-4 px-6 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <form action="{{ route('admin.events.destroy', $event['id']) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus event ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 rounded-lg text-neutral-400 hover:text-red-600 hover:bg-red-50 transition-colors" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-10 text-neutral-400 text-xs">
                            Tidak ada event pada kategori ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Event (Sesuai Frame Figma: Tambah event) -->
<div id="modal-add-event" class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl border border-[#E5E7EB] shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="p-6 border-b border-neutral-100 flex items-center justify-between">
            <div>
                <h3 class="text-sm font-bold text-[#131713]">Tambah Event Baru</h3>
                <p class="text-xs text-neutral-400">Event yang ditambahkan akan otomatis tayang di halaman publik dan portal admin</p>
            </div>
            <button onclick="document.getElementById('modal-add-event').classList.add('hidden')" class="p-2 text-neutral-400 hover:text-neutral-600 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <form action="{{ route('admin.events.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-[#131713] mb-1">Judul Event</label>
                <input type="text" name="title" required placeholder="Contoh: Beach Clean-up at Ancol" class="w-full px-3.5 py-2 text-xs rounded-xl border border-[#E5E7EB] focus:outline-none focus:border-[#5E745D] bg-[#F9FAF9]">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-[#131713] mb-1">Kategori Event</label>
                    <select name="category" required class="w-full px-3.5 py-2 text-xs rounded-xl border border-[#E5E7EB] focus:outline-none focus:border-[#5E745D] bg-white">
                        <option value="Clean Up">Clean Up (Pembersihan)</option>
                        <option value="Workshop">Workshop (Pelatihan)</option>
                        <option value="Reboisasi">Reboisasi (Penanaman Pohon)</option>
                        <option value="Edukasi">Edukasi (Sosialisasi Lingkungan)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#131713] mb-1">Kuota Peserta</label>
                    <input type="text" name="quota" required placeholder="Contoh: 50/100 participants" class="w-full px-3.5 py-2 text-xs rounded-xl border border-[#E5E7EB] focus:outline-none focus:border-[#5E745D] bg-[#F9FAF9]">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-[#131713] mb-1">Tanggal Kegiatan</label>
                    <input type="text" name="date" required placeholder="Contoh: 15 November 2024" class="w-full px-3.5 py-2 text-xs rounded-xl border border-[#E5E7EB] focus:outline-none focus:border-[#5E745D] bg-[#F9FAF9]">
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#131713] mb-1">Waktu</label>
                    <input type="text" name="time" required placeholder="Contoh: 07:00 - 12:00 WIB" class="w-full px-3.5 py-2 text-xs rounded-xl border border-[#E5E7EB] focus:outline-none focus:border-[#5E745D] bg-[#F9FAF9]">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-[#131713] mb-1">Lokasi Kegiatan</label>
                <input type="text" name="location" required placeholder="Contoh: Ancol Beach, Jakarta Utara" class="w-full px-3.5 py-2 text-xs rounded-xl border border-[#E5E7EB] focus:outline-none focus:border-[#5E745D] bg-[#F9FAF9]">
            </div>

            <div>
                <label class="block text-xs font-bold text-[#131713] mb-1">Deskripsi Kegiatan</label>
                <textarea rows="3" name="description" placeholder="Jelaskan agenda aksi, perlengkapan yang disiapkan, dan manfaat kegiatan..." class="w-full px-3.5 py-2 text-xs rounded-xl border border-[#E5E7EB] focus:outline-none focus:border-[#5E745D] bg-[#F9FAF9]"></textarea>
            </div>

            <div class="pt-4 flex items-center justify-end gap-3">
                <button type="button" onclick="document.getElementById('modal-add-event').classList.add('hidden')" class="px-4 py-2 text-xs font-semibold text-neutral-600 hover:text-neutral-900">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-[#5E745D] hover:bg-[#4B5D4A] text-white text-xs font-bold shadow-md transition-all">
                    Simpan & Publikasikan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
