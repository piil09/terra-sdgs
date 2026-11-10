@extends('admin.layout')

@section('title', 'Kelola Proyek Konservasi')
@section('page_title', 'Proyek Konservasi & Lingkungan')

@section('content')
<div class="space-y-6">
    <!-- Action Bar & Filters -->
    <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-4">
        <!-- Status Tabs -->
        <div class="flex items-center gap-1 bg-slate-100/70 p-1 rounded-xl text-xs font-semibold">
            <button class="px-3.5 py-1.5 rounded-lg bg-white text-slate-900 shadow-sm">Semua (12)</button>
            <button class="px-3.5 py-1.5 rounded-lg text-slate-500 hover:text-slate-900">Aktif (8)</button>
            <button class="px-3.5 py-1.5 rounded-lg text-slate-500 hover:text-slate-900">Dalam Review (2)</button>
            <button class="px-3.5 py-1.5 rounded-lg text-slate-500 hover:text-slate-900">Selesai (2)</button>
        </div>

        <!-- Search and Add CTA Button -->
        <div class="flex items-center gap-3 w-full sm:w-auto">
            <div class="relative flex-1 sm:w-64">
                <input type="text" placeholder="Filter proyek..." class="w-full pl-9 pr-3 py-1.5 text-xs rounded-xl border border-slate-200 bg-slate-50 focus:outline-none focus:border-forest-600">
                <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>

            <button onclick="document.getElementById('modal-add-project').classList.remove('hidden')" class="px-4 py-2 bg-forest-600 hover:bg-forest-700 text-white rounded-xl text-xs font-bold flex items-center gap-2 shadow-sm shadow-forest-600/30 transition-all shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>+ Tambah Proyek</span>
            </button>
        </div>
    </div>

    <!-- Data Table Card -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/70 border-b border-slate-100 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                        <th class="py-3.5 px-6">Informasi Proyek</th>
                        <th class="py-3.5 px-6">Kategori & Lokasi</th>
                        <th class="py-3.5 px-6">Progres Dana</th>
                        <th class="py-3.5 px-6">Capaian Pohon</th>
                        <th class="py-3.5 px-6">Status</th>
                        <th class="py-3.5 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs">
                    @foreach($admin['projects'] as $project)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-3">
                                <img src="{{ $project['image'] }}" alt="{{ $project['name'] }}" class="w-12 h-12 rounded-xl object-cover border border-slate-200 shrink-0">
                                <div class="min-w-0">
                                    <div class="font-bold text-slate-900 line-clamp-1">{{ $project['name'] }}</div>
                                    <div class="text-[11px] font-mono text-slate-400">{{ $project['code'] }} • Sejak {{ $project['start_date'] }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="inline-block px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-slate-100 text-slate-700 mb-1">
                                {{ $project['category'] }}
                            </span>
                            <div class="text-slate-400 text-[11px] flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                </svg>
                                <span>{{ $project['location'] }}</span>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div class="w-36">
                                <div class="flex justify-between text-[11px] mb-1 font-semibold">
                                    <span class="text-slate-900">Rp {{ number_format($project['collected_amount'], 0, ',', '.') }}</span>
                                    <span class="text-forest-700">{{ round(($project['collected_amount'] / $project['target_amount']) * 100) }}%</span>
                                </div>
                                <div class="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden">
                                    <div class="bg-forest-600 h-1.5 rounded-full" style="width: {{ min(100, round(($project['collected_amount'] / $project['target_amount']) * 100)) }}%"></div>
                                </div>
                                <div class="text-[10px] text-slate-400 mt-1">Target: Rp {{ number_format($project['target_amount'], 0, ',', '.') }}</div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div class="font-bold text-slate-900">{{ number_format($project['trees_planted'], 0, ',', '.') }} / {{ number_format($project['trees_target'], 0, ',', '.') }}</div>
                            <div class="text-[10px] text-slate-400">Pohon Tertanam</div>
                        </td>
                        <td class="py-4 px-6">
                            @if($project['status'] === 'Active')
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-semibold bg-emerald-50 text-emerald-700">Aktif</span>
                            @elseif($project['status'] === 'Completed')
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-semibold bg-blue-50 text-blue-700">Selesai</span>
                            @else
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-semibold bg-amber-50 text-amber-700">Dalam Review</span>
                            @endif
                        </td>
                        <td class="py-4 px-6 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button class="p-1.5 rounded-lg text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition-colors" title="Edit Proyek">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                    </svg>
                                </button>
                                <form action="{{ route('admin.projects.destroy', $project['id']) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus proyek ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50 transition-colors" title="Hapus">
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

        <!-- Pagination Bar -->
        <div class="p-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
            <span>Menampilkan 1-5 dari 12 proyek konservasi</span>
            <div class="flex items-center gap-1">
                <button class="px-3 py-1 rounded-lg border border-slate-200 text-slate-400 cursor-not-allowed">Sebelumnya</button>
                <button class="px-3 py-1 rounded-lg bg-forest-600 text-white font-bold">1</button>
                <button class="px-3 py-1 rounded-lg border border-slate-200 hover:bg-slate-50">2</button>
                <button class="px-3 py-1 rounded-lg border border-slate-200 hover:bg-slate-50">Selanjutnya</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Create Project (Split Screen 70/30 Pattern as in Figma) -->
<div id="modal-add-project" class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between sticky top-0 bg-white z-10">
            <div>
                <h3 class="text-base font-bold text-slate-900">Tambah Proyek Konservasi Baru</h3>
                <p class="text-xs text-slate-400">Lengkapi data target penanaman, anggaran, dan lokasi kegiatan</p>
            </div>
            <button onclick="document.getElementById('modal-add-project').classList.add('hidden')" class="p-2 text-slate-400 hover:text-slate-600 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <form action="{{ route('admin.projects.store') }}" method="POST" class="p-6">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left 70% Column: General Info -->
                <div class="lg:col-span-2 space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Nama Proyek</label>
                        <input type="text" name="name" required placeholder="Contoh: Reboisasi Kawasan Mata Air Bromo" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:border-forest-600">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Kategori</label>
                            <select name="category" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:border-forest-600 bg-white">
                                <option>Konservasi Pesisir</option>
                                <option>Reboisasi Hutan</option>
                                <option>Pengelolaan Limbah</option>
                                <option>Edukasi SDGs</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Lokasi Wilayah</label>
                            <input type="text" name="location" required placeholder="Kabupaten / Provinsi" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:border-forest-600">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Deskripsi Proyek</label>
                        <textarea rows="4" placeholder="Jelaskan tujuan ekologis, manfaat untuk masyarakat sekitar, dan durasi proyek..." class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:border-forest-600"></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Target Anggaran (Rp)</label>
                            <input type="number" name="target_amount" required placeholder="50000000" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:border-forest-600">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Target Jumlah Pohon</label>
                            <input type="number" name="trees_target" required placeholder="2500" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:border-forest-600">
                        </div>
                    </div>
                </div>

                <!-- Right 30% Column: Metadata & Upload -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Foto Sampul Proyek</label>
                        <div class="border-2 border-dashed border-slate-200 rounded-xl p-6 text-center hover:border-forest-500 transition-colors cursor-pointer bg-slate-50/50">
                            <svg class="w-8 h-8 text-slate-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <div class="text-[11px] font-semibold text-slate-700">Unggah Gambar</div>
                            <div class="text-[10px] text-slate-400 mt-1">PNG, JPG hingga 5MB</div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Status Publikasi</label>
                        <select name="status" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:border-forest-600 bg-white">
                            <option value="Active">Publikasikan Langsung (Aktif)</option>
                            <option value="Pending">Simpan Sebagai Draft</option>
                        </select>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full py-2.5 rounded-xl bg-forest-600 hover:bg-forest-700 text-white text-xs font-bold shadow-md shadow-forest-600/30 transition-all">
                            Simpan & Publikasikan
                        </button>
                        <button type="button" onclick="document.getElementById('modal-add-project').classList.add('hidden')" class="w-full mt-2 py-2 text-xs font-semibold text-slate-500 hover:text-slate-800">
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
