<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Buku; // ✅ WAJIB ADA

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $fillable = ['name'];

    public function buku()
    {
        return $this->hasMany(Buku::class, 'category_id');
    }
}