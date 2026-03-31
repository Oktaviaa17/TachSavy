@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header fw-bold">
            Edit Ulasan
        </div>

        <div class="card-body">

            {{-- Error Validation --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('ulasans.update', $ulasan->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Buku --}}
                <div class="mb-3">
                    <label class="form-label">Buku</label>
                    <select name="buku_id" class="form-select" required>
                        @foreach($bukus as $b)
                            <option value="{{ $b->id }}"
                                {{ $ulasan->buku_id == $b->id ? 'selected' : '' }}>
                                {{ $b->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- USER (FIX DI SINI) --}}
                <div class="mb-3">
                    <label class="form-label">User Name</label>
                    <input type="text"
                           class="form-control"
                           value="{{ $ulasan->user->name }}"
                           readonly>

                    {{-- tetap kirim user_id biar update aman --}}
                    <input type="hidden" name="user_id" value="{{ $ulasan->user_id }}">
                </div>

                {{-- Rating --}}
                <div class="mb-3">
                    <label class="form-label">Rating (1-5)</label>
                    <input type="number"
                           name="rating"
                           min="1"
                           max="5"
                           class="form-control"
                           value="{{ $ulasan->rating }}"
                           required>
                </div>

                {{-- Comment --}}
                <div class="mb-3">
                    <label class="form-label">Comment</label>
                    <textarea name="comment"
                              class="form-control"
                              rows="3"
                              required>{{ $ulasan->comment }}</textarea>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>
                    <a href="{{ route('ulasans.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
