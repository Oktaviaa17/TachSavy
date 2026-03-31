@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm col-md-6">
        <div class="card-body">
            <h4 class="mb-3">Edit Penjaga</h4>

            <form action="{{ route('penjaga.update', $penjaga->id) }}" method="POST">
                @csrf @method('PUT')

                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="name" value="{{ $penjaga->name }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ $penjaga->email }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Password (opsional)</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <button class="btn btn-warning">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection