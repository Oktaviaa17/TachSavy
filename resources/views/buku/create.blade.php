@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="card shadow-sm">
        <div class="card-body">

            <h4 class="mb-4 fw-bold">Tambah Buku</h4>

            {{-- Error --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Judul --}}
                <div class="mb-3">
                    <label class="form-label">Judul Buku</label>
                    <input
                        type="text"
                        name="title"
                        value="{{ old('title') }}"
                        class="form-control"
                        required
                    >
                </div>

                {{-- Penulis --}}
                <div class="mb-3">
                    <label class="form-label">Penulis</label>
                    <input
                        type="text"
                        name="author"
                        value="{{ old('author') }}"
                        class="form-control"
                        required
                    >
                </div>

                {{-- Penerbit --}}
                <div class="mb-3">
                    <label class="form-label">Penerbit</label>
                    <input
                        type="text"
                        name="publisher"
                        value="{{ old('publisher') }}"
                        class="form-control"
                        required
                    >
                </div>

                {{-- Stok --}}
                <div class="mb-3">
                    <label class="form-label">Stok Buku</label>
                    <input
                        type="number"
                        name="stok"
                        min="0"
                        value="{{ old('stok') }}"
                        class="form-control"
                        required
                    >
                </div>

                {{-- Kategori --}}
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="category_id" class="form-select" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($categories as $kategori)
                            <option value="{{ $kategori->id }}"
                                {{ old('category_id') == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Cover --}}
                <div class="mb-4">
                    <label class="form-label">Cover Buku</label>
                    <input
                        type="file"
                        name="cover"
                        class="form-control"
                    >
                </div>

                {{-- Tombol --}}
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                    <a href="{{ route('buku.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection