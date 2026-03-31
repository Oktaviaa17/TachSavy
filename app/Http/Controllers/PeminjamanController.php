<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    // ===============================
    // LIST PEMINJAMAN
    // ===============================
    public function index()
    {
        if (auth()->user()->role == 'user') {
            $peminjamans = Peminjaman::with('buku')
                ->where('user_id', auth()->id())
                ->latest()
                ->get();
        } else {
            $peminjamans = Peminjaman::with(['user','buku'])
                ->latest()
                ->get();
        }

        return view('peminjam.index', compact('peminjamans'));
    }

    // ===============================
    // FORM PINJAM
    // ===============================
    public function create()
    {
        $buku = Buku::where('stok', '>', 0)->get();
        return view('peminjam.create', compact('buku'));
    }

    // ===============================
    // SIMPAN PEMINJAMAN
    // ===============================
    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:bukus,id'
        ]);

        $buku = Buku::findOrFail($request->buku_id);

        if ($buku->stok <= 0) {
            return back()->with('error', 'Stok buku habis');
        }

        Peminjaman::create([
            'user_id' => Auth::id(),
            'buku_id' => $buku->id,
            'tanggal_pinjam' => now(),
            'tanggal_kembali' => now()->addDays(7),
            'status' => 'pending'
        ]);

        return redirect()->route('peminjaman.index')
            ->with('success', 'Menunggu konfirmasi admin / penjaga');
    }

    // ===============================
    // ACC PEMINJAMAN (ADMIN & PENJAGA)
    // ===============================
    public function acc($id)
    {
        if (!in_array(auth()->user()->role, ['admin','penjaga'])) {
            abort(403);
        }

        $pinjam = Peminjaman::findOrFail($id);

        if ($pinjam->status != 'pending') {
            return back()->with('info', 'Peminjaman sudah diproses');
        }

        $pinjam->update([
            'status' => 'dipinjam'
        ]);

        $pinjam->buku->decrement('stok');

        return back()->with('success', 'Peminjaman disetujui');
    }

    // ===============================
    // TOLAK PEMINJAMAN (ADMIN & PENJAGA)
    // ===============================
    public function tolak($id)
    {
        if (!in_array(auth()->user()->role, ['admin','penjaga'])) {
            abort(403);
        }

        $pinjam = Peminjaman::findOrFail($id);

        if ($pinjam->status != 'pending') {
            return back()->with('info', 'Peminjaman sudah diproses');
        }

        $pinjam->update([
            'status' => 'ditolak'
        ]);

        return back()->with('success', 'Peminjaman ditolak');
    }

    // ===============================
    // USER AJUKAN PENGEMBALIAN
    // ===============================
    public function ajukanKembali($id)
    {
        $pinjam = Peminjaman::findOrFail($id);

        if ($pinjam->user_id != auth()->id()) {
            abort(403);
        }

        if ($pinjam->status != 'dipinjam') {
            return back()->with('info', 'Tidak bisa ajukan pengembalian');
        }

        $pinjam->update([
            'status' => 'menunggu_pengembalian'
        ]);

        return back()->with('success', 'Pengembalian diajukan, menunggu ACC admin / penjaga');
    }

    // ===============================
    // ACC PENGEMBALIAN (ADMIN & PENJAGA)
    // ===============================
    public function kembalikan($id)
    {
        if (!in_array(auth()->user()->role, ['admin','penjaga'])) {
            abort(403);
        }

        $pinjam = Peminjaman::findOrFail($id);

        if ($pinjam->status != 'menunggu_pengembalian') {
            return back()->with('info', 'Belum ada pengajuan pengembalian');
        }

        $pinjam->update([
            'status' => 'dikembalikan',
            'tanggal_kembali' => now()
        ]);

        $pinjam->buku->increment('stok');

        return back()->with('success', 'Buku berhasil dikembalikan');
    }

    // ===============================
    // CETAK STRUK
    // ===============================
    public function cetak($id)
    {
        $peminjaman = Peminjaman::with(['user','buku'])->findOrFail($id);
        return view('peminjam.cetak', compact('peminjaman'));
    }

    // ===============================
    // RIWAYAT PEMINJAMAN
    // ===============================
    public function riwayat(Request $request)
    {
        $query = Peminjaman::with(['user','buku']);

        if(auth()->user()->role == 'user'){
            $query->where('user_id', auth()->id());
        }

        if($request->dari){
            $query->whereDate('tanggal_pinjam','>=',$request->dari);
        }

        if($request->sampai){
            $query->whereDate('tanggal_pinjam','<=',$request->sampai);
        }

        if($request->status){
            $query->where('status',$request->status);
        }

        $riwayat = $query->latest()->get();

        return view('peminjaman.riwayat', compact('riwayat'));
    }
}