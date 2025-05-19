@extends('layouts.layout')

@section('content')
    <section class="container min-vh-100 py-3">
        <h1 class="fs-3 fw-bold text-center mb-4">Menu Resep</h1>
        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
            @forelse($data as $recipe)
                <div class="col">
                    <a href="{{ route('recipe.show', $recipe['slug']) }}" class="text-decoration-none text-dark">
                        <div class="card h-100 border-0 shadow-sm">
                            <img src="{{ asset('storage/thumbnail/' . $recipe['image']) }}"
                                class="card-img-top img-fluid rounded-top-4" 
                                alt="{{ $recipe['title'] }}"
                                style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">{{ $recipe['title'] }}</h5>
                                <p class="card-text text-muted mb-2">
                                    Rating:
                                    @if ($recipe['rating'] == 0)
                                        -
                                    @else
                                        @for ($i = 0; $i < floor($recipe['rating']); $i++)
                                            ⭐️
                                        @endfor
                                    @endif
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-warning text-center">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        Belum ada resep tersedia
                    </div>
                </div>
            @endforelse
        </div>
    </section>
@endsection