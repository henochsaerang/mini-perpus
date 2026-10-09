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
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // BigInt, Auto Increment[cite: 3]
            $table->string('name', 100); // Varchar, 100[cite: 3]
            $table->text('description')->nullable(); // Text, Nullable[cite: 3]
            $table->timestamps(); // created_at & updated_at[cite: 3]
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};