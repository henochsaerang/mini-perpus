@extends('layouts.app')

@section('title', 'Daftar Kategori')
@section('page_title', 'Manajemen Kategori Buku')

@section('content')
<div class="space-y-6">
    <!-- Action Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm">
        <div>
            <h2 class="text-base font-bold text-slate-800">Daftar Kategori Buku</h2>
            <p class="text-xs text-slate-500 mt-0.5">Kelola kategori untuk pengelompokan buku inventaris</p>
        </div>
        <a href="{{ route('categories.create') }}" 
           class="inline-flex items-center justify-center space-x-2 px-4 py-2.5 rounded-xl bg-sky-600 hover:bg-sky-700 text-white text-xs font-semibold shadow-sm transition-all duration-150">
            <i class="fa-solid fa-plus"></i>
            <span>Tambah Kategori</span>
        </a>
    </div>

    <!-- Data Table -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200/80 text-[11px] uppercase tracking-wider font-semibold text-slate-500">
                        <th class="py-3.5 px-6">#</th>
                        <th class="py-3.5 px-6">Nama Kategori</th>
                        <th class="py-3.5 px-6">Deskripsi</th>
                        <th class="py-3.5 px-6 text-center">Jumlah Buku</th>
                        <th class="py-3.5 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs text-slate-700 font-medium">
                    @forelse ($categories as $index => $category)
                        <tr class="hover:bg-slate-50/70 transition-colors">
                            <td class="py-4 px-6 text-slate-400 font-mono">{{ $index + 1 }}</td>
                            <td class="py-4 px-6 font-semibold text-slate-800">{{ $category->name }}</td>
                            <td class="py-4 px-6 text-slate-500 max-w-xs truncate">
                                {{ $category->description ?? '-' }}
                            </td>
                            <td class="py-4 px-6 text-center">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-sky-50 text-sky-700 ring-1 ring-inset ring-sky-600/20">
                                    {{ $category->books_count }} Buku
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right space-x-2">
                                <a href="{{ route('categories.edit', $category->id) }}" 
                                   class="inline-flex items-center px-2.5 py-1.5 rounded-lg bg-amber-50 text-amber-700 hover:bg-amber-100 transition-colors">
                                    <i class="fa-solid fa-pen-to-square mr-1"></i> Edit
                                </a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-2.5 py-1.5 rounded-lg bg-rose-50 text-rose-700 hover:bg-rose-100 transition-colors">
                                        <i class="fa-solid fa-trash mr-1"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-slate-400">
                                <i class="fa-solid fa-folder-open text-3xl mb-2 text-slate-300 block"></i>
                                Belum ada data kategori. Klik tombol tambah untuk memasukkan data.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection