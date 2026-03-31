@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header fw-bold">
            Edit Buku
        </div>

        <div class="card-body">

            {{-- ERROR --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Judul --}}
                <div class="mb-3">
                    <label class="form-label">Judul Buku</label>
                    <input type="text" name="title" class="form-control"
                           value="{{ old('title', $buku->title) }}" required>
                </div>

                {{-- Penulis --}}
                <div class="mb-3">
                    <label class="form-label">Penulis</label>
                    <input type="text" name="author" class="form-control"
                           value="{{ old('author', $buku->author) }}" required>
                </div>

                {{-- Penerbit --}}
                <div class="mb-3">
                    <label class="form-label">Penerbit</label>
                    <input type="text" name="publisher" class="form-control"
                           value="{{ old('publisher', $buku->publisher) }}" required>
                </div>

                {{-- Stok --}}
                <div class="mb-3">
                    <label class="form-label">Stok</label>
                    <input type="number" name="stok" class="form-control"
                           value="{{ old('stok', $buku->stok) }}" required>
                </div>

                {{-- Kategori --}}
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="category_id" class="form-select" required>
                        @foreach ($categories as $c)
                            <option value="{{ $c->id }}"
                               {{ $buku->category_id == $c->id ? 'selected' : '' }}>
                                {{ $c->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Cover Lama --}}
                <div class="mb-3">
                    <label class="form-label">Cover Lama</label><br>
                    <img src="{{ $buku->cover_url }}"
                         class="border rounded"
                         style="width:120px; height:160px; object-fit:cover;">
                </div>

                {{-- Ganti Cover --}}
                <div class="mb-3">
                    <label class="form-label">Ganti Cover</label>
                    <input type="file" name="cover" class="form-control">
                </div>

                {{-- Tombol --}}
                <div class="d-flex gap-2 mt-4">
                    <button class="btn btn-success px-4">Update</button>
                    <a href="{{ route('buku.index') }}" class="btn btn-secondary px-4">Kembali</a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection