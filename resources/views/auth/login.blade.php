@extends('layouts.guest')

@section('auth-title', 'Masuk')
@section('auth-subtitle', 'Silakan masuk ke akun Anda')

@section('content')
<x-auth-session-status class="auth-msg auth-msg-success" :status="session('status')" />

<form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="form-group">
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Masukkan email">
        @error('email') <div class="form-error">{{ $message }}</div> @enderror
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Masukkan password">
        @error('password') <div class="form-error">{{ $message }}</div> @enderror
    </div>

    <div class="form-group form-check">
        <input id="remember_me" type="checkbox" name="remember">
        <label for="remember_me">Ingat saya</label>
    </div>

    <div class="form-footer">
        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}">Lupa password?</a>
        @endif
        <button type="submit" class="auth-btn">Masuk</button>
    </div>
</form>
@endsection
