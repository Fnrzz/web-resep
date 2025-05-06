@extends('admin.layouts.layout')


@section('content')
    <a href="{{ route('admin.recipes.index') }}" class="text-decoration-none">Kembali</a>
    <h1 class="h3 my-3">Kelola Ingredients untuk <strong> {{ $title }} </strong></h1>
    <a href="{{ route('admin.recipes.ingredients.create', $slug) }}" class="btn btn-primary">Tambah Ingredients</a>

    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Ingredients</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ingredients as $ingredient)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $ingredient->name }}</td>
                                    <td>{{ $ingredient->amount }}</td>
                                    <td>
                                        <a href="{{ route('admin.recipes.ingredients.edit', $ingredient->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <a href="{{ route('admin.recipes.ingredients.destroy', $ingredient->id) }}"
                                            class="btn btn-danger btn-sm" data-confirm-delete="true">Hapus</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
