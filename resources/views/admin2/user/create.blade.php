@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm col-md-6">
        <div class="card-body">
            <h4 class="mb-3">Tambah User</h4>

            <form action="{{ route('user.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="name" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <button class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection