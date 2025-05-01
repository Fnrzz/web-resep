@extends('auth.layouts.layout')

@section('content')
<img src="{{ asset('images/elemen.png') }}" alt="Dekorasi Atas" class="header-image" />

<div class="login-box text-center">
  <h4 class="fw-bold mb-4">REGISTER</h4>
  
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  
  @if (session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif

  <form method="POST" action="{{ route('register.submit') }}">
    @csrf
    <div class="mb-3 text-start">
      <label for="name" class="form-label">Nama :</label>
      <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan nama" required>
      @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    <div class="mb-3 text-start">
      <label for="email" class="form-label">Email :</label>
      <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email" required>
      @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    <div class="mb-3 text-start">
      <label for="password" class="form-label">Password :</label>
      <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Minimal 8 karakter" required>
      @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    <div class="mb-3 text-start">
      <label for="password_confirmation" class="form-label">Konfirmasi Password :</label>
      <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Ketik ulang password" required>
      @error('password_confirmation')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    <div class="d-grid">
      <button type="submit" class="btn btn-orange">Register</button>
    </div>
    <div class="text-center mt-3 link-login">
      Sudah punya akun? <a href="{{ route('login') }}" class="text-orange">Login disini</a>
    </div>
  </form>
</div>

<img src="{{ asset('images/elemen.png') }}" alt="Dekorasi Bawah" class="footer-image" />
@endsection