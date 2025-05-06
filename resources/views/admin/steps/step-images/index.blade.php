@extends('admin.layouts.layout')


@section('content')
    <a href="{{ route('admin.recipes.steps.index', $step->recipe->slug) }}" class="text-decoration-none">Kembali</a>
    <h1 class="h3 my-3">Kelola <strong> Gambar </strong></h1>
    <p>Untuk step ( {{ $step->description }} )</p>
    <a href="{{ route('admin.recipes.steps.images.create', $id) }}" class="btn btn-primary">Tambah Gambar</a>

    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($images as $image)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ asset('storage/step-images/' . $image->path) }}" alt=""
                                            class="img-fluid">
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.recipes.steps.images.destroy', $image->id) }}"
                                            method="POST" class="d-inline">
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
