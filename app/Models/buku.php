<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'bukus'; // pastikan tabel plural

    protected $fillable = [
        'title',
        'author',
        'publisher',
        'cover',
        'category_id',
        'stok'
    ];

    // RELASI KE KATEGORI
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'category_id');
    }

    // RELASI KE PEMINJAMAN
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'buku_id');
    }

    // ACCESSOR COVER URL
    public function getCoverUrlAttribute()
    {
        if ($this->cover) {
            return asset('storage/' . $this->cover);
        }
        return asset('images/no-cover.svg');
    }
}