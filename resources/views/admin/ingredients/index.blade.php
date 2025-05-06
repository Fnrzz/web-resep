@extends('admin.layouts.layout')

@section('content')
    <a href="{{ route('admin.recipes.index') }}" class="text-decoration-none">Kembali</a>
    <h1 class="h3 my-3">Kelola Ingredients untuk <strong>{{ $title }}</strong></h1>
    <a href="{{ route('admin.recipes.ingredients.create', $slug) }}" class="btn btn-primary mb-3">Tambah Ingredients</a>

    <div class="row">
        @forelse ($ingredients as $ingredient)
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <table class="table table-bordered mb-0"> {{-- Ganti borderless ke bordered --}}
                            <tr>
                                <th scope="row" style="width: 30%;">No</th>
                                <td>{{ $loop->iteration }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Amount</th>
                                <td>{{ $ingredient->amount }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Ingredient</th>
                                <td>{{ $ingredient->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Aksi</th>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.recipes.ingredients.edit', $ingredient->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('admin.recipes.ingredients.destroy', $ingredient->id) }}"
                                            method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">Belum ada ingredients.</div>
            </div>
        @endforelse
    </div>
@endsection
