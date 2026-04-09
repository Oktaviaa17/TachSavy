@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">📚 Riwayat Peminjaman</h3>
    </div>

    {{-- ================= FILTER ================= --}}
    <form method="GET" class="row g-2 mb-4">

        <div class="col-md-3">
            <input type="date" name="dari" value="{{ request('dari') }}"
                class="form-control">
        </div>

        <div class="col-md-3">
            <input type="date" name="sampai" value="{{ request('sampai') }}"
                class="form-control">
        </div>

        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">Semua Status</option>
                <option value="dipinjam" {{ request('status')=='dipinjam'?'selected':'' }}>
                    Dipinjam
                </option>
                <option value="dikembalikan" {{ request('status')=='dikembalikan'?'selected':'' }}>
                    Dikembalikan
                </option>
            </select>
        </div>

        <div class="col-md-3">
            <button class="btn btn-primary w-100">
                Filter
            </button>
        </div>

    </form>

    {{-- ================= TABLE ================= --}}
    <div class="card shadow-sm">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle text-center">

                    <thead class="table-light">
                        <tr>

                            {{-- Kolom nama cuma buat admin & penjaga --}}
                            @if(auth()->user()->role != 'user')
                                <th class="text-start">Peminjam</th>
                            @endif

                            <th class="text-start">Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($riwayat as $r)
                        <tr>

                            {{-- Nama + Email --}}
                            @if(auth()->user()->role != 'user')
                            <td class="text-start">
                                <div class="fw-semibold">
                                    {{ $r->user->name }}
                                </div>
                                <small class="text-muted">
                                    {{ $r->user->email }}
                                </small>
                            </td>
                            @endif

                            {{-- Buku --}}
                            <td class="text-start fw-semibold">
                                {{ $r->buku->title }}
                            </td>

                            {{-- Tanggal Pinjam --}}
                            <td>
                                {{ \Carbon\Carbon::parse($r->tanggal_pinjam)->format('d M Y') }}
                            </td>

                            {{-- Tanggal Kembali --}}
                            <td>
                                {{ $r->tanggal_kembali
                                    ? \Carbon\Carbon::parse($r->tanggal_kembali)->format('d M Y')
                                    : '-' }}
                            </td>

                            {{-- Status --}}
                            <td>
                                @if($r->status == 'pending')
                                    <span class="badge bg-warning text-dark">
                                        Pending
                                    </span>
                                @elseif($r->status == 'dipinjam')
                                    <span class="badge bg-warning text-dark">
                                        Dipinjam
                                    </span>
                                @elseif($r->status == 'menunggu_pengembalian')
                                    <span class="badge bg-info text-dark">
                                        Menunggu Pengembalian
                                    </span>
                                @elseif($r->status == 'dikembalikan')
                                    <span class="badge bg-success">
                                        Dikembalikan
                                    </span>
                                @elseif($r->status == 'ditolak')
                                    <span class="badge bg-danger">
                                        Ditolak
                                    </span>
                                @else
                                    <span class="badge bg-secondary">
                                        {{ $r->status }}
                                    </span>
                                @endif
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-muted py-4">
                                Belum ada riwayat peminjaman
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>
@endsection