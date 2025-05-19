@extends('layouts.layout')

@section('content')
    <section class="container min-vh-100 py-3">
        <!-- Konten Resep -->
        <div class="row mb-4">
            <!-- Gambar Resep -->
            <div class="col-lg-4 mb-3">
                <img src="{{ asset('storage/thumbnail/' . $recipe->image) }}" alt="{{ $recipe->title }}" class="img-fluid rounded-4 w-100">
            </div>

            <!-- Deskripsi dan Tombol -->
            <div class="col-lg-8">
                <h1 class="fs-3 fw-bold">{{ $recipe->title }}</h1>
                <p class="text-muted">{{ $recipe->description }}</p>
                
                <div class="d-flex align-items-center mb-3">
                    @auth
                        <form action="{{ route('recipe.save', $recipe->id) }}" method="POST" class="d-inline me-3">
                            @csrf
                            <button type="submit" class="btn btn-warning text-white fw-bold">Simpan Resep</button>
                        </form>
                    @else
                        <button class="btn btn-warning text-white fw-bold me-3" onclick="alert('Silakan login terlebih dahulu untuk menyimpan resep')">Simpan Resep</button>
                    @endauth
                    
                    @if($recipe->video)
                        <a href="{{ $recipe->video }}" class="btn btn-outline-warning fw-bold" target="_blank">Nonton Video</a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Bahan dan Langkah -->
        <div class="row">
            <!-- Bahan -->
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold mb-3">Bahan Bahan</h5>
                <ul class="list-unstyled">
                    @foreach($recipe->ingredients as $ingredient)
                        <li class="mb-2">{{ $ingredient->name }}</li>
                    @endforeach
                </ul>
            </div>

            <!-- Langkah -->
            <div class="col-md-8">
                <h5 class="fw-bold mb-3">Cara Membuat</h5>

                @foreach($recipe->steps as $step)
                <div class="mb-4">
                    <div class="d-flex align-items-center mb-2">
                        <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                            {{ $loop->iteration }}
                        </div>
                        <strong class="ms-2">Langkah {{ $loop->iteration }}</strong>
                    </div>
                    <p>{{ $step->description }}</p>
                    @if($step->images->count() > 0)
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($step->images as $image)
                            <img src="{{ asset('storage/step-images/' . $image->path) }}" class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;" alt="Langkah {{ $loop->parent->iteration }}">
                        @endforeach
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection