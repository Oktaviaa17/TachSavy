@extends('layouts.app')

@section('content')
<h1>Daftar Ulasan</h1>

<a href="{{ route('ulasans.create') }}" class="btn">Tambah Ulasan</a>

@if(session('success'))
    <div class="alert">{{ session('success') }}</div>
@endif

<table class="table">
    <thead>
        <tr>
            <th>Buku</th>
            <th>User</th>
            <th>Rating</th>
            <th>Comment</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($ulasans as $u)
        <tr>
            {{-- Buku --}}
            <td>{{ $u->buku->title ?? '-' }}</td>

            {{-- USER (FIX DI SINI) --}}
            <td>{{ $u->user->name ?? '-' }}</td>

            {{-- Rating --}}
            <td>{{ $u->rating }}/5</td>

            {{-- Comment --}}
            <td>{{ $u->comment }}</td>

            {{-- Aksi --}}
            <td>
                <div style="display:flex; gap:10px;">

                    {{-- Edit --}}
                    <a href="{{ route('ulasans.edit', $u->id) }}"
                       style="
                           background:#facc15;
                           padding:8px 12px;
                           border-radius:6px;
                           text-decoration:none;
                           color:black;
                       ">
                        Edit
                    </a>

                    {{-- Hapus --}}
                    <form action="{{ route('ulasans.destroy', $u->id) }}"
                          method="POST"
                          onsubmit="return confirm('Yakin mau hapus data ini?')">
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
                            Hapus
                        </button>
                    </form>

                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<style>
/* Table Styling */
.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

.table th, .table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}

.table th {
    background-color: #f4f4f4;
}

.table tr:nth-child(even) {
    background-color: #fafafa;
}

.table tr:hover {
    background-color: #f1f1f1;
}

/* Buttons */
.btn {
    display: inline-block;
    margin-bottom: 10px;
    padding: 6px 12px;
    background-color: #1abc9c;
    color: white;
    text-decoration: none;
    border-radius: 4px;
}

.btn:hover {
    background-color: #16a085;
}

/* Alert */
.alert {
    color: green;
    margin-top: 5px;
    margin-bottom: 5px;
}
</style>
@endsection