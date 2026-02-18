<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sistem Kios &amp; Kontrakan</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        /* Animated background elements */
        body::before,
        body::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            opacity: 0.08;
            animation: float 20s infinite ease-in-out;
        }

        body::before {
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, #2563eb, transparent);
            top: -100px;
            right: -100px;
            animation-delay: -5s;
        }

        body::after {
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, #7c3aed, transparent);
            bottom: -80px;
            left: -80px;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(30px, -30px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
        }

        /* Main container */
        .login-container {
            position: relative;
            z-index: 1;
            max-width: 440px;
            width: 100%;
        }

        /* Login card */
        .login-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow:
                0 20px 60px rgba(0,0,0,0.3),
                0 0 0 1px rgba(255,255,255,0.1);
            overflow: hidden;
            animation: slideUp 0.5s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Header section */
        .login-header {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            padding: 36px 32px 32px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .login-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(255,255,255,0.15), transparent);
            border-radius: 50%;
        }

        .login-logo {
            width: 56px;
            height: 56px;
            background: rgba(255,255,255,0.2);
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.3);
        }

        .login-logo svg {
            width: 28px;
            height: 28px;
            color: #ffffff;
        }

        .login-header h1 {
            font-size: 22px;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 6px;
            letter-spacing: -0.5px;
        }

        .login-header p {
            font-size: 13.5px;
            color: rgba(255,255,255,0.85);
            font-weight: 500;
        }

        /* Form section */
        .login-body {
            padding: 32px;
        }

        .welcome-text {
            text-align: center;
            margin-bottom: 28px;
        }

        .welcome-text h2 {
            font-size: 18px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 4px;
            letter-spacing: -0.3px;
        }

        .welcome-text p {
            font-size: 13px;
            color: #64748b;
        }

        /* Alert messages */
        .alert {
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background: #f0fdf4;
            color: #15803d;
            border: 1px solid #bbf7d0;
        }

        .alert-danger {
            background: #fff1f2;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }

        .alert svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
        }

        /* Form elements */
        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 7px;
            letter-spacing: 0.1px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            width: 18px;
            height: 18px;
            color: #94a3b8;
            pointer-events: none;
            transition: color 0.2s;
        }

        input {
            width: 100%;
            padding: 11px 14px 11px 44px;
            border-radius: 10px;
            border: 1.5px solid #e2e8f0;
            font-size: 14px;
            font-family: 'DM Sans', sans-serif;
            color: #0f172a;
            background: #f8fafc;
            transition: all 0.2s ease;
        }

        input::placeholder {
            color: #94a3b8;
        }

        input:focus {
            outline: none;
            border-color: #2563eb;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        input:focus + .input-icon {
            color: #2563eb;
        }

        /* Login button */
        .btn-login {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: none;
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            color: #ffffff;
            font-size: 14.5px;
            font-weight: 700;
            font-family: 'DM Sans', sans-serif;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.4);
            margin-top: 8px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.5);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* Footer */
        .login-footer {
            padding: 20px 32px 24px;
            text-align: center;
            border-top: 1px solid #f1f5f9;
        }

        .footer-text {
            font-size: 12px;
            color: #94a3b8;
            line-height: 1.6;
        }

        .footer-text strong {
            color: #64748b;
            font-weight: 600;
        }

        /* Decorative elements */
        .decorative-dots {
            position: fixed;
            z-index: 0;
            opacity: 0.6;
        }

        .decorative-dots.top-right {
            top: 40px;
            right: 40px;
        }

        .decorative-dots.bottom-left {
            bottom: 40px;
            left: 40px;
        }

        .dot {
            width: 4px;
            height: 4px;
            background: rgba(255,255,255,0.3);
            border-radius: 50%;
            margin: 6px;
            display: inline-block;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-card {
                border-radius: 16px;
            }

            .login-header {
                padding: 28px 24px 24px;
            }

            .login-body {
                padding: 24px;
            }

            .login-footer {
                padding: 16px 24px 20px;
            }
        }
    </style>
</head>
<body>

    <!-- Decorative background elements -->
    <div class="decorative-dots top-right">
        <span class="dot"></span><span class="dot"></span><span class="dot"></span><br>
        <span class="dot"></span><span class="dot"></span><span class="dot"></span><br>
        <span class="dot"></span><span class="dot"></span><span class="dot"></span>
    </div>
    <div class="decorative-dots bottom-left">
        <span class="dot"></span><span class="dot"></span><span class="dot"></span><br>
        <span class="dot"></span><span class="dot"></span><span class="dot"></span><br>
        <span class="dot"></span><span class="dot"></span><span class="dot"></span>
    </div>

    <div class="login-container">
        <div class="login-card">

            {{-- Header --}}
            <div class="login-header">
                <div class="login-logo">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
                    </svg>
                </div>
                <h1>Sistem Kios &amp; Kontrakan</h1>
                <p>Portal Administrasi</p>
            </div>

            {{-- Body --}}
            <div class="login-body">
                <div class="welcome-text">
                    <h2>Selamat Datang Kembali</h2>
                    <p>Silakan masuk ke akun Anda</p>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- Success Alert --}}
                    @if(session('sukses'))
                    <div class="alert alert-success">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        {{ session('sukses') }}
                    </div>
                    @endif

                    {{-- Error Alert --}}
                    @if(session('error'))
                    <div class="alert alert-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                        </svg>
                        {{ session('error') }}
                    </div>
                    @endif

                    {{-- Username Field --}}
                    <div class="form-group">
                        <label for="inputUsername">Username</label>
                        <div class="input-wrapper">
                            <input
                                type="text"
                                name="username"
                                id="inputUsername"
                                placeholder="Masukkan username Anda"
                                autocomplete="username"
                                required
                                autofocus>
                            <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </div>
                    </div>

                    {{-- Password Field --}}
                    <div class="form-group">
                        <label for="inputPassword">Password</label>
                        <div class="input-wrapper">
                            <input
                                type="password"
                                name="password"
                                id="inputPassword"
                                placeholder="Masukkan password Anda"
                                autocomplete="current-password"
                                required>
                            <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                            </svg>
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit" class="btn-login">
                        Masuk ke Dashboard
                    </button>

                </form>
            </div>

            {{-- Footer --}}
            <div class="login-footer">
                <p class="footer-text">
                    &copy; 2026 <strong>Ihsan Fadlurrahman</strong><br>
                    All rights reserved.
                </p>
            </div>

        </div>
    </div>

</body>
</html>
