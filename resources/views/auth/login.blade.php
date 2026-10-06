<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login ke Sistem Manajemen Perpustakaan">
    <title>Login - Sistem Perpustakaan</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #0f172a;
            position: relative;
            overflow: hidden;
        }
        /* Animated gradient background */
        .bg-gradient {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            z-index: 0;
        }
        .bg-gradient::before {
            content: '';
            position: absolute;
            top: -50%; left: -50%;
            width: 200%; height: 200%;
            background: radial-gradient(ellipse at 20% 50%, rgba(99, 102, 241, 0.15) 0%, transparent 50%),
                        radial-gradient(ellipse at 80% 50%, rgba(14, 165, 233, 0.1) 0%, transparent 50%),
                        radial-gradient(ellipse at 50% 100%, rgba(168, 85, 247, 0.1) 0%, transparent 50%);
            animation: bgPulse 15s ease-in-out infinite;
        }
        @keyframes bgPulse {
            0%, 100% { transform: scale(1) rotate(0deg); }
            50% { transform: scale(1.05) rotate(2deg); }
        }
        /* Floating particles */
        .particles {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            z-index: 0;
            pointer-events: none;
        }
        .particle {
            position: absolute;
            width: 4px; height: 4px;
            background: rgba(99, 102, 241, 0.4);
            border-radius: 50%;
            animation: float 8s ease-in-out infinite;
        }
        .particle:nth-child(1) { left: 10%; top: 20%; animation-delay: 0s; animation-duration: 7s; }
        .particle:nth-child(2) { left: 30%; top: 70%; animation-delay: 1s; animation-duration: 9s; }
        .particle:nth-child(3) { left: 60%; top: 30%; animation-delay: 2s; animation-duration: 6s; }
        .particle:nth-child(4) { left: 80%; top: 60%; animation-delay: 3s; animation-duration: 8s; }
        .particle:nth-child(5) { left: 50%; top: 80%; animation-delay: 1.5s; animation-duration: 10s; }
        .particle:nth-child(6) { left: 20%; top: 50%; animation-delay: 2.5s; animation-duration: 7s; }
        @keyframes float {
            0%, 100% { transform: translateY(0) scale(1); opacity: 0.4; }
            50% { transform: translateY(-40px) scale(1.5); opacity: 0.8; }
        }

        .login-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 440px;
            padding: 0 1.5rem;
            animation: slideUp 0.6s ease-out;
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .login-logo {
            width: 72px; height: 72px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6, #a855f7);
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: white;
            margin-bottom: 1.25rem;
            box-shadow: 0 8px 30px rgba(99, 102, 241, 0.4);
            animation: logoPulse 3s ease-in-out infinite;
        }
        @keyframes logoPulse {
            0%, 100% { box-shadow: 0 8px 30px rgba(99, 102, 241, 0.4); }
            50% { box-shadow: 0 8px 40px rgba(99, 102, 241, 0.6); }
        }
        .login-header h1 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #f1f5f9;
            margin-bottom: 6px;
        }
        .login-header p {
            color: #94a3b8;
            font-size: 0.9rem;
        }

        .login-card {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(51, 65, 85, 0.5);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
        }

        .form-group {
            margin-bottom: 1.25rem;
        }
        .form-label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: #94a3b8;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }
        .input-wrapper {
            position: relative;
        }
        .input-wrapper i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            font-size: 0.9rem;
            transition: color 0.3s;
        }
        .form-control {
            width: 100%;
            padding: 14px 16px 14px 46px;
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid #334155;
            border-radius: 12px;
            color: #f1f5f9;
            font-size: 0.95rem;
            font-family: inherit;
            transition: all 0.3s;
            outline: none;
        }
        .form-control:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
        }
        .form-control:focus + i, .form-control:focus ~ i {
            color: #818cf8;
        }
        .form-control::placeholder {
            color: #4a5568;
        }
        .form-error {
            color: #f87171;
            font-size: 0.8rem;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .remember-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 1.5rem;
        }
        .remember-row input[type="checkbox"] {
            width: 18px; height: 18px;
            accent-color: #6366f1;
            cursor: pointer;
        }
        .remember-row label {
            font-size: 0.85rem;
            color: #94a3b8;
            cursor: pointer;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 4px 20px rgba(99, 102, 241, 0.35);
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(99, 102, 241, 0.5);
        }
        .btn-login:active {
            transform: translateY(0);
        }

        .login-footer {
            text-align: center;
            margin-top: 1.5rem;
            color: #64748b;
            font-size: 0.8rem;
        }
        .login-footer .credentials {
            margin-top: 1rem;
            padding: 12px;
            background: rgba(99, 102, 241, 0.1);
            border: 1px solid rgba(99, 102, 241, 0.2);
            border-radius: 10px;
            font-size: 0.8rem;
            color: #a5b4fc;
        }
        .login-footer .credentials code {
            color: #c4b5fd;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="bg-gradient"></div>
    <div class="particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <div class="login-container">
        <div class="login-header">
            <div class="login-logo">
                <i class="fas fa-book-open"></i>
            </div>
            <h1>Sistem Perpustakaan</h1>
            <p>Masuk untuk mengelola koleksi buku</p>
        </div>

        <div class="login-card">
            <form method="POST" action="{{ url('/login') }}" id="loginForm">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="email">Email</label>
                    <div class="input-wrapper">
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control"
                            placeholder="Masukkan email anda"
                            value="{{ old('email') }}"
                            required
                            autofocus
                        >
                        <i class="fas fa-envelope"></i>
                    </div>
                    @error('email')
                        <div class="form-error">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-wrapper">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control"
                            placeholder="Masukkan password anda"
                            required
                        >
                        <i class="fas fa-lock"></i>
                    </div>
                    @error('password')
                        <div class="form-error">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="remember-row">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Ingat saya</label>
                </div>

                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i>
                    Masuk
                </button>
            </form>
        </div>

        <div class="login-footer">
            <div class="credentials">
                <strong>Demo Login:</strong><br>
                Email: <code>admin@perpustakaan.com</code><br>
                Password: <code>password</code>
            </div>
        </div>
    </div>
</body>
</html>
