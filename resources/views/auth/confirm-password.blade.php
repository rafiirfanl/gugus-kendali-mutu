@extends('layouts.guest')

@section('auth-title', 'Konfirmasi Password')
@section('auth-subtitle', 'Ini adalah area aman. Masukkan password untuk melanjutkan')

@section('content')
<form method="POST" action="{{ route('password.confirm') }}">
    @csrf

    <div class="form-group">
        <label for="password">Password</label>
        <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Masukkan password Anda">
        @error('password') <div class="form-error">{{ $message }}</div> @enderror
    </div>

    <div class="form-footer" style="justify-content: flex-end;">
        <button type="submit" class="auth-btn">Konfirmasi</button>
    </div>
</form>
@endsection
