<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kategori', function (Blueprint $table) {
            $table->id(); // kolom id
            $table->string('name'); // nama kategori
            $table->timestamps();
            $table->engine = 'InnoDB'; // pastikan engine InnoDB
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kategori');
    }
};