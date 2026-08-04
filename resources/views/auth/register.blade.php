@extends('layouts.guest')

@section('auth-title', 'Daftar Akun')
@section('auth-subtitle', 'Buat akun baru untuk mengakses sistem')

@section('content')
<form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="form-group">
        <label for="name">Nama Lengkap</label>
        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Masukkan nama lengkap">
        @error('name') <div class="form-error">{{ $message }}</div> @enderror
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="Masukkan email">
        @error('email') <div class="form-error">{{ $message }}</div> @enderror
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Masukkan password">
        @error('password') <div class="form-error">{{ $message }}</div> @enderror
    </div>

    <div class="form-group">
        <label for="password_confirmation">Konfirmasi Password</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi password">
        @error('password_confirmation') <div class="form-error">{{ $message }}</div> @enderror
    </div>

    <div class="form-footer">
        <a href="{{ route('login') }}">Sudah punya akun?</a>
        <button type="submit" class="auth-btn">Daftar</button>
    </div>
</form>
@endsection
