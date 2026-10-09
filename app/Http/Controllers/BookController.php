<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Tampilkan daftar buku
     */
    public function index()
    {
        // Mengambil buku beserta data relasi kategorinya
        $books = Book::with('category')->latest()->get();
        return view('books.index', compact('books'));
    }

    /**
     * Tampilkan form untuk menambah buku baru
     */
    public function create()
    {
        // Mengambil semua kategori untuk pilihan dropdown dinamis
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    /**
     * Simpan buku baru ke database
     */
    public function store(Request $request)
    {
        // Validasi Server-Side sesuai aturan minimum UTS
        $validated = $request->validate([
            'category_id'    => 'required|exists:categories,id',
            'title'          => 'required|string|max:255',
            'author'         => 'required|string|max:100',
            'published_year' => 'required|numeric|digits:4',
            'stock'          => 'required|numeric|min:0',
        ]);

        Book::create($validated);

        return redirect()->route('books.index')
                         ->with('success', 'Buku berhasil ditambahkan!');
    }

    /**
     * Tampilkan form edit buku
     */
    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    /**
     * Update data buku
     */
    public function update(Request $request, Book $book)
    {
        // Validasi Server-Side
        $validated = $request->validate([
            'category_id'    => 'required|exists:categories,id',
            'title'          => 'required|string|max:255',
            'author'         => 'required|string|max:100',
            'published_year' => 'required|numeric|digits:4',
            'stock'          => 'required|numeric|min:0',
        ]);

        $book->update($validated);

        return redirect()->route('books.index')
                         ->with('success', 'Data buku berhasil diperbarui!');
    }

    /**
     * Hapus data buku dari sistem
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')
                         ->with('success', 'Buku berhasil dihapus!');
    }
}