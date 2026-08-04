@extends('layouts.guest')

@section('auth-title', 'Verifikasi Email')
@section('auth-subtitle', 'Sebelum melanjutkan, silakan verifikasi email Anda')

@section('content')
<div class="auth-msg auth-msg-success">
    {{ __('Terima kasih telah mendaftar! Sebelum memulai, silakan verifikasi alamat email Anda dengan mengklik link yang kami kirimkan ke email Anda.') }}
</div>

@if (session('status') == 'verification-link-sent')
    <div class="auth-msg auth-msg-success">
        {{ __('Link verifikasi baru telah dikirim ke alamat email yang Anda daftarkan.') }}
    </div>
@endif

<div class="form-footer" style="margin-top: 20px;">
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="auth-btn">Kirim Ulang Email Verifikasi</button>
    </form>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="auth-link" style="background:none; border:none; cursor:pointer; font-family:inherit; font-size:0.88rem;">
            {{ __('Keluar') }}
        </button>
    </form>
</div>
@endsection
