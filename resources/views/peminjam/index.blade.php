@extends('layouts.app')

@section('content')
<div class="container">

    <h2 class="mb-4 fw-bold">📚 Data Peminjaman</h2>

    {{-- Tombol Pinjam --}}
    @if(auth()->user()->role == 'user')
        <a href="{{ route('peminjaman.create') }}" class="btn btn-primary mb-3">
            + Pinjam Buku
        </a>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped bg-white">
            <thead class="table-success text-center">
                <tr>
                    <th>User</th>
                    <th>Buku</th>
                    <th>Tgl Pinjam</th>
                    <th>Tgl Kembali</th>
                    <th>Status</th>
                    <th width="200">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($peminjamans as $p)
                <tr>
                    <td>{{ $p->user->name }}</td>
                    <td>{{ $p->buku->title }}</td>

                    <td class="text-center">
                        {{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d M Y') }}
                    </td>

                    <td class="text-center">
                        @if($p->status == 'dikembalikan')
                            {{ \Carbon\Carbon::parse($p->tanggal_kembali)->format('d M Y') }}
                        @else
                            -
                        @endif
                    </td>

                    <td class="text-center">
                        @if($p->status == 'pending')
                            <span class="badge bg-warning text-dark">Pending</span>

                        @elseif($p->status == 'dipinjam')
                            <span class="badge bg-success">Dipinjam</span>

                        @elseif($p->status == 'menunggu_pengembalian')
                            <span class="badge bg-info text-dark">
                                Menunggu ACC Pengembalian
                            </span>

                        @elseif($p->status == 'dikembalikan')
                            <span class="badge bg-primary">Dikembalikan</span>

                        @elseif($p->status == 'ditolak')
                            <span class="badge bg-danger">Ditolak</span>
                        @endif
                    </td>

                    <td class="text-center">
                        <div class="d-flex flex-column gap-1 align-items-center">

                            {{-- CETAK --}}
                            <a href="{{ route('peminjaman.cetak', $p->id) }}"
                               class="btn btn-secondary btn-sm w-100"
                               target="_blank">
                               🧾 Cetak
                            </a>

                            {{-- ================= ADMIN & PENJAGA ================= --}}
                            @if(in_array(auth()->user()->role, ['admin','penjaga']))

                                {{-- ACC / TOLAK PINJAM --}}
                                @if($p->status == 'pending')
                                    <form action="{{ route('peminjaman.acc', $p->id) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-success btn-sm w-100">ACC</button>
                                    </form>

                                    <form action="{{ route('peminjaman.tolak', $p->id) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-danger btn-sm w-100">Tolak</button>
                                    </form>
                                @endif

                                {{-- ACC PENGEMBALIAN --}}
                                @if($p->status == 'menunggu_pengembalian')
                                    <form action="{{ route('peminjaman.kembalikan', $p->id) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-primary btn-sm w-100">
                                            ACC Pengembalian
                                        </button>
                                    </form>
                                @endif

                                {{-- SELESAI --}}
                                @if($p->status == 'dikembalikan')
                                    <span class="text-success fw-bold">Selesai</span>
                                @endif

                            {{-- ================= USER ================= --}}
                            @else

                                @if($p->status == 'pending')
                                    <span class="text-warning">Menunggu ACC Admin</span>

                                @elseif($p->status == 'dipinjam')
                                    <span class="text-success">Sedang Dipinjam</span>

                                    <form action="{{ route('peminjaman.ajukan', $p->id) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-warning btn-sm w-100">
                                            Ajukan Pengembalian
                                        </button>
                                    </form>

                                @elseif($p->status == 'menunggu_pengembalian')
                                    <span class="text-info">
                                        Menunggu Konfirmasi Admin / Penjaga
                                    </span>

                                @elseif($p->status == 'dikembalikan')
                                    <span class="text-success fw-bold">Selesai</span>

                                @elseif($p->status == 'ditolak')
                                    <span class="text-danger">Ditolak</span>
                                @endif

                            @endif

                        </div>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">
                        Belum ada data peminjaman
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection