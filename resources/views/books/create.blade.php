@extends('layouts.app')

@section('title', 'Tambah Buku')
@section('page_title', 'Tambah Buku Baru')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
        
        <!-- Header Card -->
        <div class="px-6 py-5 bg-gradient-to-r from-slate-900 to-slate-800 text-white flex items-center justify-between">
            <div>
                <h2 class="text-sm font-bold tracking-wide">Form Tambah Buku Baru</h2>
                <p class="text-xs text-slate-300 mt-0.5">Isi rincian buku ke dalam sistem inventaris perpustakaan</p>
            </div>
            <div class="w-9 h-9 rounded-xl bg-white/10 flex items-center justify-center text-sky-400">
                <i class="fa-solid fa-book-medical text-base"></i>
            </div>
        </div>

        <!-- Form Body -->
        <form action="{{ route('books.store') }}" method="POST" class="p-6 md:p-8 space-y-6">
            @csrf

            <!-- CUSTOM SEARCHABLE DROPDOWN KATEGORI -->
            <div class="relative" id="custom-dropdown-container">
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                    Kategori Buku <span class="text-rose-500">*</span>
                </label>

                <!-- Hidden Input -->
                <input type="hidden" name="category_id" id="real-category-id" value="{{ old('category_id') }}">

                <!-- Trigger Button Dropdown -->
                <button type="button" 
                        id="dropdown-trigger-btn"
                        class="w-full text-xs pl-12 pr-10 py-3 rounded-xl border bg-slate-50/50 font-medium text-left transition-all duration-150 flex items-center justify-between cursor-pointer focus:outline-none relative @error('category_id') border-rose-500 bg-rose-50/20 focus:ring-4 focus:ring-rose-500/10 @else border-slate-200 focus:border-sky-500 focus:bg-white focus:ring-4 focus:ring-sky-500/10 @enderror">
                    
                    <!-- Icon Kategori (Posisi Kiri Disesuaikan) -->
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none w-5 text-center">
                        <i class="fa-solid fa-layer-group text-sm"></i>
                    </span>

                    <!-- Label Terpilih -->
                    <span id="selected-category-label" class="block truncate {{ old('category_id') ? 'text-slate-800 font-semibold' : 'text-slate-400' }}">
                        @if(old('category_id'))
                            {{ $categories->firstWhere('id', old('category_id'))->name ?? 'Pilih Kategori Buku...' }}
                        @else
                            Pilih Kategori Buku...
                        @endif
                    </span>

                    <!-- Arrow Indikator (Posisi Kanan) -->
                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none transition-transform duration-200" id="dropdown-arrow">
                        <i class="fa-solid fa-chevron-down text-xs"></i>
                    </span>
                </button>

                <!-- Floating Menu Options -->
                <div id="dropdown-menu" 
                     class="hidden absolute z-50 w-full mt-2 bg-white rounded-2xl border border-slate-200/90 shadow-xl shadow-slate-200/60 p-2 max-h-64 overflow-hidden flex-col transition-all">
                    
                    <!-- Input Search di dalam Dropdown -->
                    <div class="relative p-1.5 border-b border-slate-100 mb-1">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none w-4 text-center">
                            <i class="fa-solid fa-magnifying-glass text-xs"></i>
                        </span>
                        <input type="text" 
                               id="category-search-input" 
                               placeholder="Cari nama kategori..." 
                               class="w-full text-xs pl-10 pr-3 py-2 rounded-xl bg-slate-50 border border-slate-200 focus:border-sky-500 focus:bg-white focus:outline-none transition-all">
                    </div>

                    <!-- List Opsi Kategori -->
                    <div class="overflow-y-auto max-h-44 space-y-0.5" id="category-options-list">
                        @foreach ($categories as $category)
                            <button type="button"
                                    data-id="{{ $category->id }}"
                                    data-name="{{ $category->name }}"
                                    class="category-option-item w-full text-left px-3.5 py-2.5 text-xs font-medium rounded-xl flex items-center justify-between transition-colors hover:bg-sky-50 hover:text-sky-700 text-slate-700">
                                <span>{{ $category->name }}</span>
                                <i class="fa-solid fa-check text-sky-600 text-xs {{ old('category_id') == $category->id ? '' : 'hidden' }} check-icon"></i>
                            </button>
                        @endforeach
                        
                        <div id="no-result-msg" class="hidden px-3.5 py-4 text-center text-xs text-slate-400">
                            Kategori tidak ditemukan.
                        </div>
                    </div>
                </div>

                @error('category_id')
                    <p class="text-xs text-rose-600 mt-1.5 font-medium flex items-center gap-1">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <span>{{ $message }}</span>
                    </p>
                @enderror
            </div>

            <!-- Judul Buku -->
            <div>
                <label for="title" class="block text-xs font-semibold text-slate-700 mb-1.5">
                    Judul Buku <span class="text-rose-500">*</span>
                </label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none w-5 text-center">
                        <i class="fa-solid fa-heading text-sm"></i>
                    </span>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" 
                           class="w-full text-xs pl-12 pr-3.5 py-3 rounded-xl border bg-slate-50/50 font-medium text-slate-700 placeholder-slate-400 transition-all duration-150 @error('title') border-rose-500 bg-rose-50/20 focus:ring-rose-500/20 @else border-slate-200 focus:border-sky-500 focus:bg-white focus:ring-4 focus:ring-sky-500/10 @enderror focus:outline-none"
                           placeholder="Contoh: Pemrograman Web dengan Laravel">
                </div>
                @error('title')
                    <p class="text-xs text-rose-600 mt-1.5 font-medium flex items-center gap-1">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <span>{{ $message }}</span>
                    </p>
                @enderror
            </div>

            <!-- Penulis / Author -->
            <div>
                <label for="author" class="block text-xs font-semibold text-slate-700 mb-1.5">
                    Penulis / Author <span class="text-rose-500">*</span>
                </label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none w-5 text-center">
                        <i class="fa-solid fa-user-pen text-sm"></i>
                    </span>
                    <input type="text" name="author" id="author" value="{{ old('author') }}" 
                           class="w-full text-xs pl-12 pr-3.5 py-3 rounded-xl border bg-slate-50/50 font-medium text-slate-700 placeholder-slate-400 transition-all duration-150 @error('author') border-rose-500 bg-rose-50/20 focus:ring-rose-500/20 @else border-slate-200 focus:border-sky-500 focus:bg-white focus:ring-4 focus:ring-sky-500/10 @enderror focus:outline-none"
                           placeholder="Nama lengkap penulis">
                </div>
                @error('author')
                    <p class="text-xs text-rose-600 mt-1.5 font-medium flex items-center gap-1">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <span>{{ $message }}</span>
                    </p>
                @enderror
            </div>

            <!-- Grid Tahun Terbit & Stok -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label for="published_year" class="block text-xs font-semibold text-slate-700 mb-1.5">
                        Tahun Terbit <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none w-5 text-center">
                            <i class="fa-regular fa-calendar-days text-sm"></i>
                        </span>
                        <input type="number" name="published_year" id="published_year" value="{{ old('published_year') }}" 
                               class="w-full text-xs pl-12 pr-3.5 py-3 rounded-xl border bg-slate-50/50 font-medium text-slate-700 placeholder-slate-400 transition-all duration-150 @error('published_year') border-rose-500 bg-rose-50/20 focus:ring-rose-500/20 @else border-slate-200 focus:border-sky-500 focus:bg-white focus:ring-4 focus:ring-sky-500/10 @enderror focus:outline-none"
                               placeholder="Contoh: 2024">
                    </div>
                    @error('published_year')
                        <p class="text-xs text-rose-600 mt-1.5 font-medium flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="stock" class="block text-xs font-semibold text-slate-700 mb-1.5">
                        Jumlah Stok <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none w-5 text-center">
                            <i class="fa-solid fa-boxes-stacked text-sm"></i>
                        </span>
                        <input type="number" name="stock" id="stock" value="{{ old('stock', 0) }}" min="0"
                               class="w-full text-xs pl-12 pr-3.5 py-3 rounded-xl border bg-slate-50/50 font-medium text-slate-700 placeholder-slate-400 transition-all duration-150 @error('stock') border-rose-500 bg-rose-50/20 focus:ring-rose-500/20 @else border-slate-200 focus:border-sky-500 focus:bg-white focus:ring-4 focus:ring-sky-500/10 @enderror focus:outline-none">
                    </div>
                    @error('stock')
                        <p class="text-xs text-rose-600 mt-1.5 font-medium flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex items-center justify-end space-x-3 pt-6 border-t border-slate-100">
                <a href="{{ route('books.index') }}" 
                   class="inline-flex items-center space-x-2 px-5 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-semibold transition-all">
                    <i class="fa-solid fa-xmark"></i>
                    <span>Batal</span>
                </a>
                <button type="submit" 
                        class="inline-flex items-center space-x-2 px-6 py-2.5 rounded-xl bg-sky-600 hover:bg-sky-700 active:bg-sky-800 text-white text-xs font-semibold shadow-sm shadow-sky-600/30 transition-all">
                    <i class="fa-solid fa-floppy-disk"></i>
                    <span>Simpan Buku</span>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- SCRIPT NATIVE JAVASCRIPT DROPDOWN SEARCHABLE -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const triggerBtn = document.getElementById('dropdown-trigger-btn');
    const dropdownMenu = document.getElementById('dropdown-menu');
    const arrow = document.getElementById('dropdown-arrow');
    const searchInput = document.getElementById('category-search-input');
    const optionItems = document.querySelectorAll('.category-option-item');
    const selectedLabel = document.getElementById('selected-category-label');
    const realInput = document.getElementById('real-category-id');
    const noResultMsg = document.getElementById('no-result-msg');
    const container = document.getElementById('custom-dropdown-container');

    triggerBtn.addEventListener('click', function(e) {
        e.preventDefault();
        const isHidden = dropdownMenu.classList.contains('hidden');
        if (isHidden) {
            dropdownMenu.classList.remove('hidden');
            dropdownMenu.classList.add('flex');
            arrow.classList.add('rotate-180', 'text-sky-600');
            searchInput.focus();
        } else {
            closeDropdown();
        }
    });

    document.addEventListener('click', function(e) {
        if (!container.contains(e.target)) {
            closeDropdown();
        }
    });

    function closeDropdown() {
        dropdownMenu.classList.add('hidden');
        dropdownMenu.classList.remove('flex');
        arrow.classList.remove('rotate-180', 'text-sky-600');
        searchInput.value = '';
        filterOptions('');
    }

    searchInput.addEventListener('input', function(e) {
        filterOptions(e.target.value.toLowerCase());
    });

    function filterOptions(query) {
        let matches = 0;
        optionItems.forEach(item => {
            const name = item.getAttribute('data-name').toLowerCase();
            if (name.includes(query)) {
                item.classList.remove('hidden');
                matches++;
            } else {
                item.classList.add('hidden');
            }
        });

        if (matches === 0) {
            noResultMsg.classList.remove('hidden');
        } else {
            noResultMsg.classList.add('hidden');
        }
    }

    optionItems.forEach(item => {
        item.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');

            realInput.value = id;

            selectedLabel.textContent = name;
            selectedLabel.classList.remove('text-slate-400');
            selectedLabel.classList.add('text-slate-800', 'font-semibold');

            document.querySelectorAll('.check-icon').forEach(icon => icon.classList.add('hidden'));
            this.querySelector('.check-icon').classList.remove('hidden');

            closeDropdown();
        });
    });
});
</script>
@endsection