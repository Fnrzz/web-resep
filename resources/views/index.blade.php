@extends('layouts.layout')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container py-5">
            <div class="row row-cols-1 row-cols-lg-2 g-5 align-items-center">
                <div class="col hero-content">
                    <h1 class="fw-bold mb-3">Temukan Resep Masakan Nusantara di ResepKu</h1>
                    <p class="mb-4">ResepKu adalah website penyedia menu resep makanan lengkap dan terjamin enak dari chef
                        ternama.</p>
                    <a href="{{ route('menu') }}" class="btn btn-warning fw-bold text-white px-4 py-2">Cari Menu</a>
                </div>
                <div class="col text-center">
                    <img src="{{ asset('images/nasi-tumpeng.png') }}" alt="Nasi Tumpeng" class="rounded shadow"
                        style="width: 100%; height: 400px;">
                </div>
            </div>
        </div>
    </section>

    <!-- AI Section -->
    <section class="py-5 text-center">
        <div class="container">
            <h3 class="fw-bold mb-3">Temukan Resep Dengan AI</h3>
            <p class="mb-4 px-md-5 mx-auto" style="max-width: 800px;">Website Resepku memiliki fitur tanya AI. Dengan upload
                foto atau menuliskan nama resep beserta langkah-langkahnya, fitur menggunakan AI akan segera mencarikan
                resep dengan cepat dan akurat.</p>
            <a href="{{ route('tanya-ai') }}" class="btn btn-warning text-white fw-bold px-4 py-2">Coba Sekarang!</a>
        </div>
    </section>

    <!-- Simpan Resep -->
    <section class="py-5">
        <div class="container">
            <div class="row row-cols-1 row-cols-lg-2 g-5 align-items-center">
                <div class="col section-content">
                    <h4 class="fw-bold mb-3">Simpan Resep</h4>
                    <p class="mb-4">Melalui fitur simpan resep, kamu dapat menyimpan resep untuk dibaca di kemudian hari.
                    </p>
                    <a href="#" class="btn btn-warning text-white fw-bold px-4 py-2">Coba Sekarang!</a>
                </div>
                <div class="col text-center simpan-resep-img">
                    <img src="{{ asset('images/kumpulan-makanan.png') }}" alt="Kumpulan Makanan"
                        class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- Menu Resep Section -->
    <section class="container min-vh-100 py-3">
        <h1 class="fs-3 fw-bold text-center mb-4">Menu Resep</h1>
        @if ($featuredRecipes->isEmpty())
            <h6 class="text-center">Resep tidak ditemukan</h6>
        @endif
        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach ($featuredRecipes as $recipe)
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
        <div class="text-center mt-4">
            <a href="{{ route('menu') }}" class="btn btn-warning fw-bold text-white px-4 py-2">Lihat Semua Resep</a>
        </div>
    </section>
@endsection
