@extends('layouts.app')

@section('content')
<h2 style="font-size:28px; font-weight:bold; margin-bottom:20px;">
    Data Buku
</h2>

{{-- Tombol Tambah (Admin + Penjaga) --}}
@if(in_array(auth()->user()->role, ['admin','penjaga']))
<a href="{{ route('buku.create') }}"
   style="display:inline-block;
          background:#2563eb;
          color:white;
          padding:12px 18px;
          border-radius:8px;
          text-decoration:none;
          margin-bottom:25px;">
    Tambah Buku
</a>
@endif

<div style="background:white; border-radius:10px; box-shadow:0 8px 20px rgba(0,0,0,0.08); overflow-x:auto;">
    <table style="width:100%; border-collapse:collapse;">
        <thead style="background:#0f766e; color:white;">
            <tr>
                <th style="padding:12px;">Cover</th>
                <th style="padding:12px;">Judul</th>
                <th style="padding:12px;">Penulis</th>
                <th style="padding:12px;">Penerbit</th>
                <th style="padding:12px;">Kategori</th>
                <th style="padding:12px;">Stok</th>
                @if(auth()->user()->role != 'user')
                    <th style="padding:12px;">Aksi</th>
                @endif
            </tr>
        </thead>

        <tbody>
        @forelse($buku as $b)
            <tr style="border-bottom:1px solid #eee;">

                {{-- Cover --}}
                <td style="padding:12px;">
                    @if($b->cover)
                        <img src="{{ $b->cover_url }}"
                             style="width:50px; height:70px; object-fit:cover; border-radius:4px;">
                    @else
                        <img src="{{ asset('images/no-cover.svg') }}"
                             style="width:50px; height:70px; object-fit:cover; border-radius:4px;">
                    @endif
                </td>

                <td style="padding:12px;">{{ $b->title }}</td>
                <td style="padding:12px;">{{ $b->author }}</td>
                <td style="padding:12px;">{{ $b->publisher }}</td>
                <td style="padding:12px;">{{ $b->kategori?->name ?? '-' }}</td>
                <td style="padding:12px; font-weight:bold;">{{ $b->stok == 0 ? 'Kosong' : $b->stok }}</td>

                {{-- Aksi --}}
                @if(auth()->user()->role != 'user')
                <td style="padding:12px; display:flex; gap:8px;">

                    {{-- Edit (Admin + Penjaga) --}}
                    @if(in_array(auth()->user()->role, ['admin','penjaga']))
                    <a href="{{ route('buku.edit', $b->id) }}"
                       style="background:#facc15;
                              padding:6px 10px;
                              border-radius:6px;
                              text-decoration:none;
                              color:black;">
                        ✏️ Edit
                    </a>
                    @endif

                    {{-- Hapus (Admin Only) --}}
                    @if(auth()->user()->role == 'admin')
                    <form action="{{ route('buku.destroy', $b->id) }}"
                          method="POST"
                          onsubmit="return confirm('Hapus buku ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                style="background:#ef4444;
                                       color:white;
                                       padding:6px 10px;
                                       border:none;
                                       border-radius:6px;
                                       cursor:pointer;">
                            🗑 Hapus
                        </button>
                    </form>
                    @endif

                </td>
                @endif
            </tr>

        @empty
            <tr>
                <td colspan="7" style="padding:20px; text-align:center; color:#777;">
                    Belum ada data buku
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection