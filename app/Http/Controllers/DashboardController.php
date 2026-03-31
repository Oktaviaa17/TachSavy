<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kategori;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Ulasan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $role = strtolower(auth()->user()->role);

        // Statistik umum
        $totalKategori = Kategori::count();
        $totalBuku = Buku::count();
        $totalPeminjaman = null;
        $totalPeminjamanMingguan = null;
        $totalPeminjamanBulanan = null;
        $totalUlasan = null;

        // Admin & Penjaga
        if($role === 'admin' || $role === 'penjaga') {
            $totalPeminjaman = Peminjaman::count();

            // Total peminjaman bulanan
            $startOfMonth = Carbon::now()->startOfMonth();
            $endOfMonth = Carbon::now()->endOfMonth();
            $totalPeminjamanBulanan = Peminjaman::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();

            // Total peminjaman mingguan (khusus admin)
            if($role === 'admin'){
                $startOfWeek = Carbon::now()->startOfWeek();
                $endOfWeek = Carbon::now()->endOfWeek();
                $totalPeminjamanMingguan = Peminjaman::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
            }
        }

        // User biasa
        if($role === 'user'){
            $totalUlasan = Ulasan::where('user_id', auth()->id())->count();
        }

        // Kirim semua variabel ke view
        return view('dashboard', compact(
            'totalKategori',
            'totalBuku',
            'totalPeminjaman',
            'totalPeminjamanMingguan',
            'totalPeminjamanBulanan',
            'totalUlasan',
            'role'
        ));
    }

    // Opsional: laporan mingguan terpisah (jika dibutuhkan route admin)
    public function laporanMingguan()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $totalPeminjamanMingguan = Peminjaman::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();

        return view('laporan.mingguan', compact('totalPeminjamanMingguan'));
    }

    // Opsional: laporan bulanan terpisah (jika mau route admin)
    public function laporanBulanan()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $totalPeminjamanBulanan = Peminjaman::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();

        return view('laporan.bulanan', compact('totalPeminjamanBulanan'));
    }
}