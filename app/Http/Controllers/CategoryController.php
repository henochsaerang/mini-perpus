<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class CategoryController extends Controller
{
    /**
     * Tampilkan daftar kategori
     */
    public function index()
    {
        $categories = Category::withCount('books')->latest()->get();
        // Memanggil file resources/views/categories/index.blade.php
        return view('categories.index', compact('categories'));
    }

    /**
     * Tampilkan form untuk menambah kategori baru
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Simpan kategori baru ke database
     */
    public function store(Request $request)
    {
        // Validasi Server-Side
        $validated = $request->validate([
            'name'        => 'required|string|max:100|unique:categories,name',
            'description' => 'nullable|string',
        ]);

        Category::create($validated);

        return redirect()->route('categories.index')
                         ->with('success', 'Kategori berhasil ditambahkan!');
    }

    /**
     * Tampilkan form edit kategori
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update data kategori
     */
    public function update(Request $request, Category $category)
    {
        // Validasi Server-Side (Abaikan nama kategori milik sendiri saat unik)
        $validated = $request->validate([
            'name'        => 'required|string|max:100|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        $category->update($validated);

        return redirect()->route('categories.index')
                         ->with('success', 'Kategori berhasil diperbarui!');
    }

    /**
     * Hapus kategori dari database
     */
    public function destroy(Category $category)
    {
        try {
            // Cek jika kategori masih memiliki buku terkait
            if ($category->books()->count() > 0) {
                return redirect()->route('categories.index')
                                 ->with('error', 'Gagal menghapus! Kategori ini masih memiliki daftar buku terkait.');
            }

            $category->delete();

            return redirect()->route('categories.index')
                             ->with('success', 'Kategori berhasil dihapus!');
        } catch (QueryException $e) {
            return redirect()->route('categories.index')
                             ->with('error', 'Gagal menghapus kategori karena masalah relasi database.');
        }
    }
}