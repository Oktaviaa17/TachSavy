@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header fw-bold">
            Tambah Ulasan
        </div>

        <div class="card-body">
            <form action="{{ route('ulasans.store') }}" method="POST">
                @csrf

                {{-- Buku --}}
                <div class="mb-3">
                    <label class="form-label">Buku</label>
                    <select name="buku_id" class="form-select" required>
                        @foreach($bukus as $buku)
                            <option value="{{ $buku->id }}">{{ $buku->title }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Nama User (auto dari login) --}}
                <div class="mb-3">
                    <label class="form-label">Nama User</label>
                    <input type="text"
                           class="form-control"
                           value="{{ auth()->user()->name }}"
                           readonly>

                    {{-- kirim user_id diam-diam --}}
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                </div>

                {{-- Rating --}}
                <div class="mb-3">
                    <label class="form-label">Rating (1–5)</label>
                    <input type="number"
                           name="rating"
                           class="form-control"
                           min="1"
                           max="5"
                           required>
                </div>

                {{-- Comment --}}
                <div class="mb-3">
                    <label class="form-label">Komentar</label>
                    <textarea name="comment"
                              class="form-control"
                              rows="3"
                              required></textarea>
                </div>

                <button class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection