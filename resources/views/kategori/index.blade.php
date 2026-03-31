@extends('layouts.app')

@section('content')
    <h2 style="font-size:28px; font-weight:bold; margin-bottom:20px;">
        Data Kategori Buku
    </h2>

    {{-- 🔒 ADMIN ONLY: TAMBAH --}}
    @if(auth()->user()->role == 'admin')
    <a href="{{ route('kategori.create') }}"
       style="
           display:inline-block;
           background:#2563eb;
           color:white;
           padding:12px 18px;
           border-radius:8px;
           text-decoration:none;
           margin-bottom:25px;
       ">
        Tambah Kategori
    </a>
    @endif

    @if($kategori->isEmpty())
        <p style="color:#666;">Belum ada kategori buku.</p>
    @else
        <div style="
            display:grid;
            grid-template-columns:repeat(auto-fill, minmax(250px, 1fr));
            gap:20px;
        ">
            @foreach($kategori as $c)
                <div style="
                    background:white;
                    padding:20px;
                    border-radius:10px;
                    box-shadow:0 8px 20px rgba(0,0,0,0.08);
                ">
                    <h3 style="font-size:20px; font-weight:bold; margin-bottom:10px;">
                        {{ $c->name }}
                    </h3>

                    {{-- 🔒 ADMIN ONLY: EDIT + HAPUS --}}
                    @if(auth()->user()->role == 'admin')
                    <div style="display:flex; gap:10px; margin-bottom:12px;">
                        <a href="{{ route('kategori.edit', $c->id) }}"
                           style="
                               background:#facc15;
                               padding:8px 12px;
                               border-radius:6px;
                               text-decoration:none;
                               color:black;
                           ">
                            ✏️ Edit
                        </a>

                        <form action="{{ route('kategori.destroy', $c->id) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    style="
                                        background:#ef4444;
                                        color:white;
                                        padding:8px 12px;
                                        border:none;
                                        border-radius:6px;
                                        cursor:pointer;
                                    ">
                                🗑 Hapus
                            </button>
                        </form>
                    </div>
                    @endif

                    {{-- LIST BUKU (SEMUA ROLE BOLEH LIHAT) --}}
                    @if($c->buku->isEmpty())
                        <p style="color:#777; font-style:italic;">
                            Belum ada buku di kategori ini.
                        </p>
                    @else
                        <ul style="padding-left:18px;">
                            @foreach($c->buku as $b)
                                <li>
                                    <strong>{{ $b->title }}</strong>
                                    <span style="color:#666;">
                                        ({{ $b->author }})
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
@endsection