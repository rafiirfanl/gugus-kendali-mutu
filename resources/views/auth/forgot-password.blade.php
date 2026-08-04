@extends('layouts.guest')

@section('auth-title', 'Lupa Password')
@section('auth-subtitle', 'Masukkan email untuk menerima link reset password')

@section('content')
<x-auth-session-status class="auth-msg auth-msg-success" :status="session('status')" />

<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <div class="form-group">
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Masukkan email terdaftar">
        @error('email') <div class="form-error">{{ $message }}</div> @enderror
    </div>

    <div class="form-footer" style="justify-content: flex-end;">
        <button type="submit" class="auth-btn">Kirim Link Reset</button>
    </div>
</form>
@endsection
