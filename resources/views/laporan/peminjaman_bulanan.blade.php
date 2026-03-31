@extends('layouts.app')

@section('content')
<div class="container">

    <h3 class="mb-3 fw-bold text-center">
        Laporan Peminjaman Buku Bulanan
    </h3>

    {{-- 🔥 FORM FILTER + CETAK --}}
    <form method="GET" class="mb-3">
        <div class="row align-items-end">

            {{-- INPUT BULAN --}}
            <div class="col-md-4">
                <label>Pilih Bulan</label>
                <input type="month" name="bulan" class="form-control"
                       value="{{ request('bulan', $bulan) }}">
            </div>

            {{-- TOMBOL --}}
            <div class="col-md-4 d-flex gap-2">
                <button class="btn btn-primary mt-4">Filter</button>

                <button type="button" onclick="window.print()" class="btn btn-success mt-4">
                    🖨️ Cetak
                </button>
            </div>

        </div>
    </form>

    {{-- 🔥 PERIODE --}}
    <p>
        Periode:
        <strong>
            {{ \Carbon\Carbon::parse($bulan)->translatedFormat('F Y') }}
        </strong>
    </p>

    {{-- 🔥 TANGGAL CETAK --}}
    <p class="text-end">
        Dicetak pada: {{ now()->translatedFormat('d F Y') }}
    </p>

    {{-- 🔥 JUMLAH PEMINJAM --}}
    <div class="alert alert-info">
        Jumlah Peminjam Bulan Ini:
        <strong>{{ $jumlahPeminjam }} orang</strong>
    </div>

    {{-- 🔥 TABEL REKAP BUKU --}}
    <table class="table table-bordered table-striped">
        <thead class="table-dark text-center">
            <tr>
                <th width="5%">No</th>
                <th>Judul Buku</th>
                <th width="20%">Jumlah Dipinjam</th>
                <th width="20%">Sisa Stok</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($bukuDipinjam as $buku)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $buku->title }}</td>
                <td class="text-center">{{ $buku->total_dipinjam }}</td>
                <td class="text-center">{{ $buku->stok }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">
                    Tidak ada data peminjaman bulan ini.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- 🔥 DETAIL PEMINJAM --}}
    <h5 class="mt-4 fw-bold">Detail Peminjam</h5>

    <table class="table table-bordered table-striped">
        <thead class="table-dark text-center">
            <tr>
                <th width="5%">No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Judul Buku</th>
                <th width="20%">Tanggal Pinjam</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($detailPeminjam as $d)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $d->name }}</td>
                <td>{{ $d->email }}</td>
                <td>{{ $d->title }}</td>
                <td class="text-center">
                    {{ \Carbon\Carbon::parse($d->tanggal_pinjam)->translatedFormat('d M Y') }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">
                    Tidak ada detail peminjam bulan ini.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>

{{-- 🔥 STYLE KHUSUS PRINT --}}
<style>
@media print {

    /* ❌ HILANGKAN LAYOUT ADMIN */
    nav,
    header,
    aside,
    .sidebar,
    .navbar,
    .btn,
    form,
    footer {
        display: none !important;
    }

    body {
        background: white !important;
        margin: 0;
    }

    .container {
        width: 100% !important;
        margin: 0;
        padding: 0 20px;
    }

    h3 {
        text-align: center;
        margin-bottom: 20px;
    }

    h5 {
        margin-top: 25px;
    }

    .alert {
        border: none;
    }

    table {
        font-size: 12px;
    }
}
</style>

@endsection