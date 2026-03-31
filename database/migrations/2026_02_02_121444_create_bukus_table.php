<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->string('title');      // judul buku
            $table->string('author');     // penulis
            $table->string('publisher');  // penerbit
            $table->string('cover')->nullable(); // cover buku
            $table->foreignId('category_id')       // foreign key ke kategori
                  ->constrained('kategori')       // nama tabel kategori
                  ->cascadeOnDelete();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};