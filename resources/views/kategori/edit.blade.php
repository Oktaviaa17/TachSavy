@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h2 class="mb-0">Edit Kategori</h2>
        </div>
        <div class="card-body">

            {{-- Error validasi --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Kategori</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        value="{{ old('name', $kategori->name) }}"
                        class="form-control"
                        required
                    >
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection