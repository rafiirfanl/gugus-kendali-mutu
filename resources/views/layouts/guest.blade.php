<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

            body {
                font-family: 'Figtree', 'Segoe UI', sans-serif;
                min-height: 100vh;
                background: #f1f5f9;
                display: flex;
            }

            .auth-left {
                flex: 1;
                background: #0c3366;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 40px;
                color: white;
            }

            .auth-left .brand-icon {
                width: 64px;
                height: 64px;
                background: rgba(255, 255, 255, 0.15);
                border-radius: 16px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 800;
                font-size: 24px;
                margin-bottom: 24px;
            }

            .auth-left h1 {
                font-size: 1.6rem;
                font-weight: 700;
                margin-bottom: 8px;
                text-align: center;
            }

            .auth-left p {
                color: rgba(255, 255, 255, 0.6);
                font-size: 0.9rem;
                text-align: center;
                max-width: 320px;
                line-height: 1.6;
            }

            .auth-right {
                width: 480px;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
                padding: 40px 60px;
                background: white;
            }

            .auth-card-header {
                margin-bottom: 32px;
            }

            .auth-card-header h2 {
                font-size: 1.35rem;
                font-weight: 700;
                color: #0c3366;
                margin-bottom: 6px;
            }

            .auth-card-header p {
                color: #64748b;
                font-size: 0.88rem;
            }

            .auth-form .form-group {
                margin-bottom: 18px;
            }

            .auth-form label {
                display: block;
                font-weight: 600;
                font-size: 0.82rem;
                color: #334155;
                margin-bottom: 6px;
            }

            .auth-form input[type="text"],
            .auth-form input[type="email"],
            .auth-form input[type="password"] {
                width: 100%;
                padding: 10px 14px;
                border: 1px solid #d1d5db;
                border-radius: 8px;
                font-size: 0.88rem;
                color: #1e293b;
                background: #f9fafb;
                transition: border-color 0.15s, box-shadow 0.15s;
                outline: none;
            }

            .auth-form input:focus {
                border-color: #0c3366;
                box-shadow: 0 0 0 3px rgba(12, 51, 102, 0.1);
                background: white;
            }

            .auth-form .form-check {
                display: flex;
                align-items: center;
                gap: 8px;
                margin-top: 4px;
            }

            .auth-form .form-check input[type="checkbox"] {
                accent-color: #0c3366;
                width: 16px;
                height: 16px;
            }

            .auth-form .form-check label {
                font-weight: 400;
                font-size: 0.84rem;
                color: #64748b;
                margin-bottom: 0;
            }

            .auth-form .form-error {
                color: #dc2626;
                font-size: 0.78rem;
                margin-top: 4px;
            }

            .auth-form .form-footer {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-top: 24px;
            }

            .auth-form .form-footer a {
                color: #64748b;
                font-size: 0.84rem;
                text-decoration: none;
                transition: color 0.15s;
            }

            .auth-form .form-footer a:hover {
                color: #0c3366;
            }

            .auth-btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 10px 28px;
                background: #0c3366;
                color: white;
                border: none;
                border-radius: 8px;
                font-weight: 600;
                font-size: 0.85rem;
                cursor: pointer;
                transition: background 0.15s, transform 0.1s;
            }

            .auth-btn:hover {
                background: #1a5276;
            }

            .auth-btn:active {
                transform: scale(0.98);
            }

            .auth-msg {
                padding: 12px 16px;
                border-radius: 8px;
                font-size: 0.84rem;
                margin-bottom: 20px;
            }

            .auth-msg-success {
                background: #ecfdf5;
                color: #065f46;
                border: 1px solid #a7f3d0;
            }

            .auth-msg-error {
                background: #fef2f2;
                color: #991b1b;
                border: 1px solid #fecaca;
            }

            .auth-link {
                color: #0c3366;
                text-decoration: none;
                font-weight: 500;
                transition: color 0.15s;
            }

            .auth-link:hover {
                color: #1a5276;
            }

            @media (max-width: 767.98px) {
                .auth-left { display: none; }
                .auth-right {
                    width: 100%;
                    min-height: 100vh;
                    padding: 30px 24px;
                }
            }
        </style>
    </head>
    <body>
        <div class="auth-left">
            <div class="brand-icon">GKM</div>
            <h1>Gugus Kendali Mutu</h1>
            <p>Sistem manajemen akademik untuk monitoring dan evaluasi kualitas perkuliahan.</p>
        </div>

        <div class="auth-right">
            <div class="auth-card-header">
                <h2>@yield('auth-title', 'Selamat Datang')</h2>
                <p>@yield('auth-subtitle', 'Silakan masuk ke akun Anda')</p>
            </div>

            <div class="auth-form">
                @yield('content')
                {{ $slot ?? '' }}
            </div>
        </div>
    </body>
</html>
