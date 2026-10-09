<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Rute untuk Aplikasi Mini-Perpus UTS Framework Programming.
| Menggunakan Route::resource untuk mengelompokkan fungsionalitas CRUD
| secara terstruktur.
|
*/

// Redirect halaman utama langsung ke halaman Kategori
Route::get('/', function () {
    return redirect()->route('categories.index');
});

// Resource Route untuk Modul Kategori
Route::resource('categories', CategoryController::class);

// Resource Route untuk Modul Buku
Route::resource('books', BookController::class);