<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'author',
        'published_year',
        'stock',
    ];

    /**
     * Relasi Inverse One-to-Many: Setiap Buku merujuk pada satu Kategori[cite: 3, 5]
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}