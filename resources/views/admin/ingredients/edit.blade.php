@extends('admin.layouts.layout')


@section('content')
    <a href="{{ route('admin.recipes.ingredients.index', $ingredient->recipe->slug) }}"
        class="text-decoration-none">Kembali</a>

    <h1 class="h3 my-3"><strong>Edit</strong> Ingredients</h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.recipes.ingredients.update', $ingredient->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Masukkan Nama" value="{{ old('name') ?? $ingredient->name }}" required />
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="amount" class="form-label">Jumlah</label>
                            <input type="number" class="form-control" id="amount" name="amount"
                                placeholder="Masukkan Nama" value="{{ old('amount') ?? $ingredient->amount }}" required />
                            @error('amount')
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
