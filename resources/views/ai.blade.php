@extends('layouts.layout')

@section('content')
    <section class="vh-100 w-100 d-flex flex-column align-items-center justify-content-center">
        <h1 class="fs-3 fw-bold">Mau Tanya Apa?</h1>
        <p class="fs-5">Saya siap mencarikan resep untuk kamu !</p>
        <div class="w-50">
            <form action="{{ route('ai.ask') }}" method="post">
                @csrf
                <div class="mb-3">
                    <textarea name="question" id="question" class="form-control rounded-3 shadow p-3" rows="5"
                        placeholder="Masukkan pertanyaanmu disini"></textarea>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </section>
@endsection
