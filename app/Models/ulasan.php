<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Buku;

class Ulasan extends Model
{
    // ===============================
    // FILLABLE (WAJIB)
    // ===============================
    protected $fillable = [
        'buku_id',
        'user_id',
        'rating',
        'comment'
    ];

    // ===============================
    // RELASI KE BUKU
    // ===============================
    public function buku()
    {
        return $this->belongsTo(Buku::class)
            ->withDefault([
                'title' => 'Buku tidak ditemukan'
            ]);
    }

    // ===============================
    // RELASI KE USER
    // ===============================
    public function user()
    {
        return $this->belongsTo(User::class)
            ->withDefault([
                'name' => 'User tidak ditemukan'
            ]);
    }
}