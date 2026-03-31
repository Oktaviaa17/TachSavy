@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Data Penjaga</h3>

    <a href="{{ route('penjaga.create') }}" class="btn btn-primary mb-3">
        + Tambah Penjaga
    </a>

    <div class="card shadow-sm">
        <div class="card-body">

            <table class="table table-bordered table-striped">
                <thead class="table-light text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th width="200">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($penjagas as $p)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->name }}</td>
                        <td>{{ $p->email }}</td>
                        <td>
                            <a href="{{ route('penjaga.edit', $p->id) }}"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('penjaga.destroy', $p->id) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin hapus?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection