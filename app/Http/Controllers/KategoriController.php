<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    // Tampilkan semua kategori (SEMUA ROLE BOLEH)
    public function index()
    {
        $kategori = Kategori::with('buku')->get();
        return view('kategori.index', compact('kategori'));
    }

    // 🔒 ADMIN ONLY
    public function create()
    {
        $this->cekAdmin();
        return view('kategori.create');
    }

    // 🔒 ADMIN ONLY
    public function store(Request $request)
    {
        $this->cekAdmin();

        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        Kategori::create([
            'name' => $request->name
        ]);

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan!');
    }

    // 🔒 ADMIN ONLY
    public function edit(Kategori $kategori)
    {
        $this->cekAdmin();
        return view('kategori.edit', compact('kategori'));
    }

    // 🔒 ADMIN ONLY
    public function update(Request $request, Kategori $kategori)
    {
        $this->cekAdmin();

        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $kategori->update([
            'name' => $request->name
        ]);

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil diupdate!');
    }

    // 🔒 ADMIN ONLY
    public function destroy(Kategori $kategori)
    {
        $this->cekAdmin();

        $kategori->delete();
        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil dihapus!');
    }

    // 🔥 HELPER CEK ROLE
    private function cekAdmin()
    {
        if(auth()->user()->role !== 'admin'){
            abort(403, 'AKSES DITOLAK');
        }
    }
}