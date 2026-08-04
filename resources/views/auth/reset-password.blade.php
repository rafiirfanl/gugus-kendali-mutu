@extends('layouts.guest')

@section('auth-title', 'Reset Password')
@section('auth-subtitle', 'Masukkan password baru Anda')

@section('content')
<form method="POST" action="{{ route('password.store') }}">
    @csrf

    <input type="hidden" name="token" value="{{ $request->route('token') }}">

    <div class="form-group">
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username" placeholder="Masukkan email">
        @error('email') <div class="form-error">{{ $message }}</div> @enderror
    </div>

    <div class="form-group">
        <label for="password">Password Baru</label>
        <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Masukkan password baru">
        @error('password') <div class="form-error">{{ $message }}</div> @enderror
    </div>

    <div class="form-group">
        <label for="password_confirmation">Konfirmasi Password</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi password baru">
        @error('password_confirmation') <div class="form-error">{{ $message }}</div> @enderror
    </div>

    <div class="form-footer" style="justify-content: flex-end;">
        <button type="submit" class="auth-btn">Reset Password</button>
    </div>
</form>
@endsection
