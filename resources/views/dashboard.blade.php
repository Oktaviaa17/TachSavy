@extends('layouts.app')

@section('content')
<header style="background-color:white; padding:20px; border-bottom:1px solid #ddd;">
    <h2>Dashboard</h2>
</header>

<main style="padding:40px; display:flex; justify-content:center;">
    <div style="
        background-color:white;
        padding:30px;
        border-radius:8px;
        box-shadow:0 10px 25px rgba(0,0,0,0.1);
        text-align:center;
        width:500px;
    ">
        <h3>Selamat datang, {{ Auth::user()->name }} 👋</h3>
        <p>Anda berhasil login ke TachSavvy Library</p>

        @php
            $role = Auth::user()->role;
        @endphp

        {{-- Info Kategori & Buku --}}
        <div style="display:flex; justify-content:space-around; margin:20px 0;">
            <div style="
                background:#f1f5f9;
                padding:15px;
                border-radius:6px;
                width:45%;
            ">
                <h3>{{ $totalKategori ?? 0 }}</h3>
                <p>Kategori Buku</p>
            </div>

            <div style="
                background:#f1f5f9;
                padding:15px;
                border-radius:6px;
                width:45%;
            ">
                <h3>{{ $totalBuku ?? 0 }}</h3>
                <p>Total Buku</p>
            </div>
        </div>

        {{-- Info tambahan sesuai role --}}
        @if($role === 'admin' || $role === 'penjaga')
            <div style="margin-top:20px;">
                {{-- Total Peminjaman Keseluruhan --}}
                <div style="
                    background:#f1f5f9;
                    padding:15px;
                    border-radius:6px;
                    margin-bottom:10px;
                ">
                    <h3>{{ $totalPeminjaman ?? 0 }}</h3>
                    <p>Peminjaman Buku</p>
                </div>

                {{-- Total Peminjaman Bulanan --}}
                <div style="
                    background:#f1f5f9;
                    padding:15px;
                    border-radius:6px;
                    margin-bottom:10px;
                ">
                    <h3>{{ $totalPeminjamanBulanan ?? 0 }}</h3>
                    <p>Peminjaman Bulan Ini</p>
                </div>

        @elseif($role === 'user')
            {{-- Untuk user: tampilkan jumlah ulasan --}}
            <div style="margin-top:20px;">
                <div style="
                    background:#f1f5f9;
                    padding:15px;
                    border-radius:6px;
                ">
                    <h3>{{ $totalUlasan ?? 0 }}</h3>
                    <p>Jumlah Ulasan</p>
                </div>
            </div>
        @endif
    </div>
</main>
@endsection