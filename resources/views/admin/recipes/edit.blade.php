@extends('admin.layouts.layout')


@section('content')
    <a href="{{ route('admin.recipes.index') }}" class="text-decoration-none">Kembali</a>

    <h1 class="h3 my-3"><strong>Edit</strong> Resep</h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.recipes.update', $recipe->slug) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="title" name="title"
                                placeholder="Masukkan judul" value="{{ old('title') ? old('title') : $recipe->title }}"
                                required />
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Masukkan deskripsi"
                                required>{{ old('description') ? old('description') : $recipe->description }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="video" class="form-label">Url Video</label>
                            <input type="text" class="form-control" id="video" name="video"
                                placeholder="Masukkan url video" value="{{ old('video') ? old('video') : $recipe->video }}"
                                required />
                            @error('video')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar</label>
                            <img src="{{ asset('/storage/thumbnail/' . $recipe->image) }}" alt="gambar"
                                class="img-fluid mb-3 d-block" style="max-width: 400px;" />
                            <input type="file" class="form-control" id="image" name="image" accept="image/*" />
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        @error('slug' || 'upload')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
