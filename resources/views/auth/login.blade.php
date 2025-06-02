@extends('auth.layouts.layout')

@section('content')
<img src="{{ asset('images/elemen.png') }}" alt="Sayuran Atas" class="header-image" />

<div class="login-box text-center">
  <h4 class="fw-bold mb-4">LOGIN</h4>
  <form action="{{ route('login') }}" method="POST">
    @csrf
    <div class="mb-3 text-start">
      <label for="email" class="form-label">Email :</label>
      <input
        type="email"
        class="form-control"
        id="email"
        name="email"
        placeholder="Masukkan email"
        required
      />
    </div>
    <div class="mb-3 text-start">
      <label for="password" class="form-label">Password :</label>
      <input
        type="password"
        class="form-control"
        id="password"
        name="password"
        placeholder="Masukkan password"
        required
      />
    </div>
   @if(session('error'))
    <div class="mb-3">
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
          </div>
    </div>
   @endif
    <div class="d-grid">
      <button type="submit" class="btn btn-orange">Login</button>
    </div>
    <div class="text-center mt-3 link-register">
      <a href="{{ route('register') }}">Belum Punya Akun ?</a>
    </div>
  </form>
</div>

<img src="{{ asset('images/elemen.png') }}" alt="Sayuran Bawah" class="footer-image" />
@endsection