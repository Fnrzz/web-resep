@extends('admin.layouts.layout')


@section('content')
    <h1 class="h3 mb-3"><strong>Kelola</strong> Resep</h1>
    <a href="{{ route('admin.recipes.create') }}" class="btn btn-primary">Tambah Resep</a>

    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Judul</th>
                                <th scope="col">Steps</th>
                                <th scope="col">Ingredients</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recipes as $recipe)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $recipe->title }}</td>
                                    <td>
                                        <a href="{{ route('admin.recipes.steps.index', $recipe->slug) }}"
                                            class="btn btn-primary btn-sm">Detail</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.recipes.ingredients.index', $recipe->slug) }}"
                                            class="btn btn-primary btn-sm">Detail</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.recipes.edit', $recipe->slug) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <a href="{{ route('admin.recipes.destroy', $recipe->slug) }}"
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
