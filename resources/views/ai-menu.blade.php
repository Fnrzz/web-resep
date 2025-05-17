@extends('layouts.layout')

@section('content')
    <section class="min-vh-100 w-100 container py-5">
        <h1 class="fs-3 fw-bold">Hasil Pencarian AI</h1>
        <p>{{ $reason }}</p>
        <div class="row row-cols-1 row-cols-md-4 g-3 mt-3">
            @foreach ($outputRecipe as $recipe)
                <div class="col">
                    <img src="{{ asset('/storage/thumbnail/' . $recipe['image']) }}"
                        class="img-fluid rounded-4 w-100 h-75 mb-3">
                    <h5 class="fw-bold">{{ $recipe['title'] }}</h5>
                    <p class="text-muted">
                        Rating :
                        @if ($recipe['rating'] == 0)
                            -
                        @else
                            @for ($i = 0; $i < floor($recipe['rating']); $i++)
                                ⭐️
                            @endfor
                        @endif
                    </p>
                </div>
            @endforeach
        </div>
    </section>
@endsection
