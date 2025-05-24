@extends('layouts.layout')

@section('content')
    <section class="container min-vh-100 py-3">
        <h1 class="fs-3 fw-bold text-center mb-4">Menu Resep</h1>
        <div class="d-flex justify-content-end">
            <form action="{{ route('menu') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari Resep" name="search"
                        value="{{ request('search') }}">
                    <button class="btn btn-warning text-white" type="submit">Cari</button>
                </div>
            </form>
        </div>
        @if ($data->isEmpty())
            <h6 class="text-center">Resep tidak ditemukan</h6>
        @endif
        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach ($data as $recipe)
                <div class="col">
                    <a href="{{ route('recipe.show', $recipe->slug) }}" class="text-decoration-none">
                        <img src="{{ asset('storage/thumbnail/' . $recipe->image) }}"
                            class="img-fluid rounded-4 w-100 h-75 mb-3" alt="{{ $recipe->title }}">
                        <h5 class="fw-bold text-dark">{{ $recipe->title }}</h5>
                        <p class="text-muted">
                            Rating:
                            @if ($recipe->rating == 0)
                                -
                            @else
                                @for ($i = 0; $i < floor($recipe->rating); $i++)
                                    ⭐️
                                @endfor
                            @endif
                        </p>
                    </a>
                </div>
            @endforeach
        </div>

    </section>
@endsection
