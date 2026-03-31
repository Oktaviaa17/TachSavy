@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">📦 Pinjam Buku</h2>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('peminjaman.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="buku_id" class="form-label">Pilih Buku</label>
            <select name="buku_id" id="buku_id" class="form-select" required>
                <option value="">-- Pilih Buku --</option>
                @foreach($buku as $b)
                    <option value="{{ $b->id }}">
                        {{ $b->title }} (stok: {{ $b->stok }})
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Pinjam Buku</button>
        <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection