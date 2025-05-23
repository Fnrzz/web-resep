@extends('layouts.layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/formRating.css') }}">
@endsection

@section('content')
    <section class="container min-vh-100 py-3">
        <!-- Konten Resep -->
        <div class="row mb-4">
            <!-- Gambar Resep -->
            <div class="col-lg-4 mb-3">
                <img src="{{ asset('storage/thumbnail/' . $recipe->image) }}" alt="{{ $recipe->title }}"
                    class="img-fluid rounded-4 " style="width:100%; height: 300px; object-fit: cover">
            </div>

            <!-- Deskripsi dan Tombol -->
            <div class="col-lg-8">
                <h1 class="fs-3 fw-bold">{{ $recipe->title }}</h1>
                <h5 class="fs-6 fw-bold">
                    Rating:
                    @if ($recipe->rating == 0)
                        -
                    @else
                        @for ($i = 0; $i < floor($recipe->rating); $i++)
                            ⭐️
                        @endfor
                    @endif
                </h5>
                <p class="text-muted">{{ $recipe->description }}</p>

                <div class="d-flex align-items-center mb-3">
                    @php
                        $alreadyRated =
                            auth()->check() &&
                            $recipe
                                ->favorites()
                                ->where('user_id', auth()->id())
                                ->exists();
                    @endphp
                    @auth
                        @if ($alreadyRated)
                            <a type="button" class="btn btn-warning text-white me-3">
                                <i class="bi bi-bookmark-check"></i> Tersimpan
                            </a>
                        @else
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-warning text-white me-3" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                Simpan Resep
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Berikan Rating</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('recipe.save', $recipe->slug) }}" method="POST"
                                                id="rating-form">
                                                @csrf
                                                <div class="star-rating d-flex justify-content-center">
                                                    <span class="star" data-value="1">&#9733;</span>
                                                    <span class="star" data-value="2">&#9733;</span>
                                                    <span class="star" data-value="3">&#9733;</span>
                                                    <span class="star" data-value="4">&#9733;</span>
                                                    <span class="star" data-value="5">&#9733;</span>
                                                </div>
                                                <input type="hidden" name="rating" id="ratingValue" value="0">
                                                <br>
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary ">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        <a class="btn btn-warning text-white fw-bold me-3" href="{{ route('login') }}">Simpan
                            Resep</a>
                    @endauth

                    @if ($recipe->video)
                        <a href="{{ $recipe->video }}" class="btn btn-outline-warning fw-bold" target="_blank">Nonton
                            Video</a>
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
                    @foreach ($recipe->ingredients as $ingredient)
                        <li class="mb-2 "> <b>{{ $ingredient->amount }}</b> {{ $ingredient->name }}</li>
                    @endforeach
                </ul>
            </div>

            <!-- Langkah -->
            <div class="col-md-8">
                <h5 class="fw-bold mb-3">Cara Membuat</h5>

                @foreach ($recipe->steps as $step)
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-2">
                            <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 32px; height: 32px;">
                                {{ $loop->iteration }}
                            </div>
                            <strong class="ms-2">Langkah {{ $loop->iteration }}</strong>
                        </div>
                        <p>{{ $step->description }}</p>
                        @if ($step->images->count() > 0)
                            <div class="d-flex flex-wrap gap-2">
                                @foreach ($step->images as $image)
                                    <img src="{{ asset('storage/step-images/' . $image->path) }}" class="img-thumbnail"
                                        style="width: 100px; height: 100px; object-fit: cover;"
                                        alt="Langkah {{ $loop->parent->iteration }}">
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="{{ asset('js/formRating.js') }}"></script>
@endsection
