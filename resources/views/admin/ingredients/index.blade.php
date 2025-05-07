@extends('admin.layouts.layout')

@section('style')
    <link href="{{ asset('css/responsive-layout.css') }}" rel="stylesheet">
@endsection

@section('content')
    <a href="{{ route('admin.recipes.index') }}" class="text-decoration-none">Kembali</a>
    <h1 class="h3 my-3">Kelola Ingredients untuk <strong>{{ $title }}</strong></h1>
    <a href="{{ route('admin.recipes.ingredients.create', $slug) }}" class="btn btn-primary mb-3">Tambah Ingredients</a>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
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
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ route('admin.recipes.ingredients.edit', $ingredient->id) }}"
                                                   class="btn btn-warning">Edit</a>
                                                <a href="{{ route('admin.recipes.ingredients.destroy', $ingredient->id) }}"
                                                   class="btn btn-danger" data-confirm-delete="true">Hapus</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/responsive-layout.js') }}"></script>
@endsection