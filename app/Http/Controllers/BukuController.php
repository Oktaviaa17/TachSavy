<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    // Semua user bisa lihat daftar & detail
    public function index()
    {
        return view('buku.index', [
            'buku' => Buku::with('kategori')->get()
        ]);
    }

    public function show(Buku $buku)
    {
        return view('buku.show', compact('buku'));
    }

    // Admin + Penjaga bisa create
    public function create()
    {
        abort_if(!in_array(auth()->user()->role, ['admin','penjaga']), 403);

        return view('buku.create', [
            'categories' => Kategori::all()
        ]);
    }

    public function store(Request $request)
    {
        abort_if(!in_array(auth()->user()->role, ['admin','penjaga']), 403);

        $data = $request->validate([
            'title'       => 'required',
            'author'      => 'required',
            'publisher'   => 'required',
            'category_id' => 'required|exists:kategori,id',
            'stok'        => 'required|integer|min:0',
            'cover'       => 'nullable|image|mimes:jpg,jpeg,png,jfif|max:2048'
        ]);

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        Buku::create($data);

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil ditambahkan');
    }

    // Admin + Penjaga bisa edit
    public function edit(Buku $buku)
    {
        abort_if(!in_array(auth()->user()->role, ['admin','penjaga']), 403);

        return view('buku.edit', [
            'buku' => $buku,
            'categories' => Kategori::all()
        ]);
    }

    public function update(Request $request, Buku $buku)
    {
        abort_if(!in_array(auth()->user()->role, ['admin','penjaga']), 403);

        $data = $request->validate([
            'title'       => 'required',
            'author'      => 'required',
            'publisher'   => 'required',
            'category_id' => 'required|exists:kategori,id',
            'stok'        => 'required|integer|min:0',
            'cover'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('cover')) {
            if ($buku->cover) {
                Storage::disk('public')->delete($buku->cover);
            }
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        $buku->update($data);

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil diupdate');
    }

    // Hapus cuma Admin
    public function destroy(Buku $buku)
    {
        abort_if(auth()->user()->role !== 'admin', 403);

        if ($buku->cover) {
            Storage::disk('public')->delete($buku->cover);
        }

        $buku->delete();

        return back()->with('success', 'Buku berhasil dihapus');
    }
}