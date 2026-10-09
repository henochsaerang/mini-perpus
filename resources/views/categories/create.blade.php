@extends('layouts.app')

@section('title', 'Tambah Kategori')
@section('page_title', 'Tambah Kategori Baru')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 md:p-8 space-y-6">
        <div>
            <h2 class="text-base font-bold text-slate-800">Form Tambah Kategori</h2>
            <p class="text-xs text-slate-500 mt-0.5">Isi rincian kategori buku yang ingin ditambahkan</p>
        </div>

        <form action="{{ route('categories.store') }}" method="POST" class="space-y-5">
            @csrf

            <!-- Nama Kategori -->
            <div>
                <label for="name" class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Kategori <span class="text-rose-500">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" 
                       class="w-full text-xs px-3.5 py-2.5 rounded-xl border @error('name') border-rose-500 bg-rose-50/30 @else border-slate-200 @enderror focus:outline-none focus:ring-2 focus:ring-sky-500 transition-all"
                       placeholder="Contoh: Pemrograman, Fiksi, Sains">
                @error('name')
                    <p class="text-xs text-rose-600 mt-1 font-medium"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi Kategori -->
            <div>
                <label for="description" class="block text-xs font-semibold text-slate-700 mb-1.5">Deskripsi</label>
                <textarea name="description" id="description" rows="4" 
                          class="w-full text-xs px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 transition-all"
                          placeholder="Deskripsi singkat mengenai kategori buku...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-xs text-rose-600 mt-1 font-medium"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-end space-x-3 pt-4 border-t border-slate-100">
                <a href="{{ route('categories.index') }}" class="px-4 py-2.5 rounded-xl bg-slate-100 text-slate-600 hover:bg-slate-200 text-xs font-semibold transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-4 py-2.5 rounded-xl bg-sky-600 hover:bg-sky-700 text-white text-xs font-semibold shadow-sm transition-colors">
                    Simpan Kategori
                </button>
            </div>
        </form>
    </div>
</div>
@endsection