@extends('layouts.layout')

@section('content')
<section class="container py-5" style="margin-top: 120px;">
    <h1 class="fs-3 fw-bold text-center mb-4">Menu Resep</h1>


    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        @forelse($recipes as $recipe)
            <div class="col d-flex">
                <div class="card w-100 border-0 shadow-sm">
                    @if($recipe->image)
                        <img src="{{ asset('storage/thumbnail/'.$recipe->image) }}" alt="{{ $recipe->title }}"
                            class="card-img-top rounded-top-4" style="object-fit: cover; height: 180px;">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center rounded-top-4" style="height: 180px;">
                            <i class="fas fa-image fa-2x text-muted"></i>
                        </div>
                    @endif

                    <div class="card-body">
                        <h5 class="fw-bold text-capitalize">{{ $recipe->title }}</h5>
                        <a href="#" class="btn btn-outline-primary btn-sm">Lihat Resep</a>
                    </div>
                </div>
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