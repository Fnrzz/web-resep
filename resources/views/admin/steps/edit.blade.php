@extends('admin.layouts.layout')


@section('content')
    <a href="{{ route('admin.recipes.steps.index', $step->recipe->slug) }}" class="text-decoration-none">Kembali</a>

    <h1 class="h3 my-3"><strong>Edit</strong> Steps</h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.recipes.steps.update', $step->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Masukkan deskripsi"
                                required>{{ old('description') ? old('description') : $step->description }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
