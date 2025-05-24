@extends('user.layouts.layout')

@section('content')
    <section class="container min-vh-100">
        <h1 class="fw-bold">Selamat Datang di Resepku <br> {{ Auth::user()->name }}</h1>
        <p>Berikut adalah menu yang telah kamu simpan</p>
        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4 mt-3">
            @forelse($favoriteRecipes as $recipe)
                <div class="col">
                    <a href="{{ route('recipe.show', $recipe['slug']) }}" class="text-decoration-none">
                        <img src="{{ asset('storage/thumbnail/' . $recipe['image']) }}"
                            class="img-fluid rounded-4 w-100 h-75 mb-3" alt="{{ $recipe['title'] }}">
                        <h5 class="fw-bold text-dark">{{ $recipe['title'] }}</h5>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-warning text-center">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        Belum ada resep yang tersimpan
                    </div>
                </div>
            @endforelse
        </div>
    </section>
@endsection
