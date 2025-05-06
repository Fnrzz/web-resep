@extends('admin.layouts.layout')


@section('content')
    <a href="{{ route('admin.recipes.index') }}" class="text-decoration-none">Kembali</a>
    <h1 class="h3 my-3">Kelola Steps untuk <strong> {{ $title }} </strong></h1>
    <a href="{{ route('admin.recipes.steps.create', $slug) }}" class="btn btn-primary">Tambah Step</a>

    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Steps</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($steps as $step)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $step->description }}</td>
                                    <td>
                                        <a href="{{ route('admin.recipes.steps.images.index', $step->id) }}"
                                            class="btn btn-primary btn-sm">Detail</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.recipes.steps.edit', $step->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('admin.recipes.steps.destroy', $step->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
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
