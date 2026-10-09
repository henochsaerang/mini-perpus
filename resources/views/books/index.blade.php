@extends('layouts.app')

@section('title', 'Katalog Buku')
@section('page_title', 'Manajemen Katalog Buku')

@section('content')
<div class="space-y-6">
    
    <!-- Action & Search Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs">
        <div>
            <h2 class="text-base font-bold text-slate-800">Daftar Inventaris Buku</h2>
            <p class="text-xs text-slate-500 mt-0.5">Kelola seluruh item buku dan ketersediaan stok perpustakaan</p>
        </div>
        <a href="{{ route('books.create') }}" 
           class="inline-flex items-center justify-center space-x-2 px-4 py-2.5 rounded-xl bg-sky-600 hover:bg-sky-700 active:bg-sky-800 text-white text-xs font-semibold shadow-xs transition-all">
            <i class="fa-solid fa-plus"></i>
            <span>Tambah Buku Baru</span>
        </a>
    </div>

    <!-- Data Table Card -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200/80 text-[11px] uppercase tracking-wider font-semibold text-slate-500">
                        <th class="py-4 px-6 w-12 text-center">#</th>
                        <th class="py-4 px-6">Judul Buku</th>
                        <th class="py-4 px-6">Kategori</th>
                        <th class="py-4 px-6">Penulis / Author</th>
                        <th class="py-4 px-6 text-center">Tahun Terbit</th>
                        <th class="py-4 px-6 text-center">Stok</th>
                        <th class="py-4 px-6 text-right w-40">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs text-slate-700 font-medium">
                    @forelse ($books as $index => $book)
                        <tr class="hover:bg-slate-50/70 transition-colors">
                            
                            <!-- Nomor Urut -->
                            <td class="py-4 px-6 text-center text-slate-400 font-mono text-[11px]">
                                {{ $index + 1 }}
                            </td>

                            <!-- Judul Buku -->
                            <td class="py-4 px-6">
                                <div class="font-bold text-slate-800 text-xs">{{ $book->title }}</div>
                            </td>

                            <!-- Nama Kategori (Teks, bukan ID) -->
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center space-x-1.5 px-2.5 py-1 rounded-lg text-[11px] font-semibold bg-sky-50 text-sky-700 border border-sky-200/60">
                                    <i class="fa-solid fa-tag text-[10px]"></i>
                                    <span>{{ $book->category->name ?? 'Tanpa Kategori' }}</span>
                                </span>
                            </td>

                            <!-- Penulis / Author -->
                            <td class="py-4 px-6 text-slate-600">
                                <div class="flex items-center space-x-2">
                                    <i class="fa-solid fa-user-pen text-slate-400 text-xs"></i>
                                    <span>{{ $book->author }}</span>
                                </div>
                            </td>

                            <!-- Tahun Terbit -->
                            <td class="py-4 px-6 text-center font-mono text-slate-600">
                                {{ $book->published_year }}
                            </td>

                            <!-- Indikator Stok -->
                            <td class="py-4 px-6 text-center">
                                @if ($book->stock > 5)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        {{ $book->stock }} Unit
                                    </span>
                                @elseif ($book->stock > 0)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-amber-50 text-amber-700 border border-amber-200/60">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                        {{ $book->stock }} Unit
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-rose-50 text-rose-700 border border-rose-200/60">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                        Habis
                                    </span>
                                @endif
                            </td>

                            <!-- Tombol Aksi -->
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('books.edit', $book->id) }}" 
                                       class="inline-flex items-center space-x-1 px-2.5 py-1.5 rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-700 border border-amber-200/60 text-xs font-semibold transition-colors">
                                        <i class="fa-solid fa-pen-to-square text-[11px]"></i>
                                        <span>Edit</span>
                                    </a>

                                    <form action="{{ route('books.destroy', $book->id) }}" 
                                          method="POST" 
                                          class="inline-block"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center space-x-1 px-2.5 py-1.5 rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200/60 text-xs font-semibold transition-colors">
                                            <i class="fa-solid fa-trash text-[11px]"></i>
                                            <span>Hapus</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-slate-400">
                                <div class="flex flex-col items-center justify-center space-y-3">
                                    <div class="w-12 h-12 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-400">
                                        <i class="fa-solid fa-book-open text-xl"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold text-slate-600">Belum Ada Data Buku</p>
                                        <p class="text-[11px] text-slate-400 mt-0.5">Tambahkan buku pertama Anda melalui tombol di atas.</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection