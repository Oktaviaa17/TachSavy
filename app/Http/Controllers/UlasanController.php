<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UlasanController extends Controller
{
    public function __construct()
    {
        // Wajib login
        $this->middleware('auth');
    }

    // ===============================
    // INDEX
    // ===============================
    public function index()
    {
        $ulasans = Ulasan::with(['buku', 'user'])
            ->latest()
            ->paginate(10); // pagination biar pro

        return view('ulasan.index', compact('ulasans'));
    }

    // ===============================
    // CREATE
    // ===============================
    public function create()
    {
        $bukus = Buku::all();
        return view('ulasan.create', compact('bukus'));
    }

    // ===============================
    // STORE
    // ===============================
    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:bukus,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        Ulasan::create([
            'buku_id' => $request->buku_id,
            'user_id' => Auth::id(), // auto user login
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('ulasans.index')
            ->with('success', 'Ulasan berhasil ditambahkan!');
    }

    // ===============================
    // EDIT
    // ===============================
    public function edit(Ulasan $ulasan)
    {
        // Cek hak akses
        if ($ulasan->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403);
        }

        $bukus = Buku::all();
        return view('ulasan.edit', compact('ulasan', 'bukus'));
    }

    // ===============================
    // UPDATE
    // ===============================
    public function update(Request $request, Ulasan $ulasan)
    {
        // Cek hak akses
        if ($ulasan->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'buku_id' => 'required|exists:bukus,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        $ulasan->update([
            'buku_id' => $request->buku_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('ulasans.index')
            ->with('success', 'Ulasan berhasil diupdate!');
    }

    // ===============================
    // DELETE
    // ===============================
    public function destroy(Ulasan $ulasan)
    {
        // Cek hak akses
        if ($ulasan->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403);
        }

        $ulasan->delete();

        return redirect()->route('ulasans.index')
            ->with('success', 'Ulasan berhasil dihapus!');
    }
}