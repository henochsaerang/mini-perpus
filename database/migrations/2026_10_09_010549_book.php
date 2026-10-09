<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id(); // BigInt, Auto Increment[cite: 3]
            
            // Foreign Key yang terhubung ke tabel categories[cite: 3]
            $table->foreignId('category_id')
                  ->constrained('categories')
                  ->onDelete('restrict'); // Mengatur constraint agar penanganan error saat hapus kategori yang masih memiliki relasi buku dapat berjalan
            
            $table->string('title', 255); // Varchar, 255[cite: 3]
            $table->string('author', 100); // Varchar, 100[cite: 3]
            $table->integer('published_year'); // Integer[cite: 3]
            $table->integer('stock'); // Integer[cite: 3]
            $table->timestamps(); // created_at & updated_at[cite: 3]
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};