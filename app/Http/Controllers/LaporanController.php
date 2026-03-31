<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function peminjamanBulanan(Request $request)
    {
        // 🔥 BATASIN AKSES ROLE
        if (!in_array(auth()->user()->role, ['admin', 'penjaga'])) {
            abort(403);
        }

        // Ambil bulan (default sekarang)
        $bulan = $request->bulan ?? now()->format('Y-m');

        $tahun = date('Y', strtotime($bulan));
        $bulanAngka = date('m', strtotime($bulan));

        // 🔹 Jumlah peminjam unik
        $jumlahPeminjam = DB::table('peminjamans')
            ->whereYear('tanggal_pinjam', $tahun)
            ->whereMonth('tanggal_pinjam', $bulanAngka)
            ->distinct('user_id')
            ->count('user_id');

        // 🔹 Rekap buku dipinjam
        $bukuDipinjam = DB::table('peminjamans')
            ->join('bukus', 'peminjamans.buku_id', '=', 'bukus.id')
            ->whereYear('tanggal_pinjam', $tahun)
            ->whereMonth('tanggal_pinjam', $bulanAngka)
            ->select(
                'bukus.id',
                'bukus.title',
                'bukus.stok',
                DB::raw('COUNT(peminjamans.id) as total_dipinjam')
            )
            ->groupBy('bukus.id', 'bukus.title', 'bukus.stok')
            ->get();

        // 🆕 Detail peminjam (nama + email)
        $detailPeminjam = DB::table('peminjamans')
            ->join('users', 'peminjamans.user_id', '=', 'users.id')
            ->join('bukus', 'peminjamans.buku_id', '=', 'bukus.id')
            ->whereYear('tanggal_pinjam', $tahun)
            ->whereMonth('tanggal_pinjam', $bulanAngka)
            ->select(
                'users.name',
                'users.email',
                'bukus.title',
                'peminjamans.tanggal_pinjam'
            )
            ->latest('peminjamans.tanggal_pinjam')
            ->get();

        return view('laporan.peminjaman_bulanan', compact(
            'jumlahPeminjam',
            'bukuDipinjam',
            'detailPeminjam',
            'bulan'
        ));
    }
}