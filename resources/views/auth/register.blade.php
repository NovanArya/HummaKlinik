<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Poliklinik Sehat</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            display: flex;
            width: 900px;
            height: auto;
            overflow: hidden;
            max-width: 90%;
        }

        /* --- SISI KIRI (BIRU) --- */
        .left-side {
            width: 50%;
            background-color: #4a90e2;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 40px 20px;
            position: relative;
        }

        .left-content { z-index: 2; }

        .left-side h2 {
            font-size: 28px;
            margin-bottom: 5px;
        }

        .left-side p {
            font-size: 14px;
            opacity: 0.9;
            margin-bottom: 30px;
        }

        .image-area {
            width: 80%;
            max-width: 250px;
            margin: 0 auto;
        }

        .image-area img {
            width: 100%;
            height: auto;
            object-fit: contain;
        }

        .footer-left {
            position: absolute;
            bottom: 20px;
            font-size: 12px;
            opacity: 0.8;
        }

        /* --- SISI KANAN (REGISTER FORM) --- */
        .right-side {
            width: 50%;
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }

        .register-wrapper {
            width: 100%;
            max-width: 320px;
        }

        .register-header {
            text-align: center;
            margin-bottom: 25px;
        }

        .register-header h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 5px;
        }

        .register-header p {
            font-size: 14px;
            color: #666;
        }

        .form-group {
            margin-bottom: 14px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper input {
            width: 100%;
            padding: 10px 10px 10px 35px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.3s;
        }

        .input-wrapper input:focus {
            border-color: #4a90e2;
        }

        .input-wrapper i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            font-size: 14px;
        }

        .btn-register {
            width: 100%;
            padding: 10px;
            background-color: #0d47a1;
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            font-size: 15px;
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 5px;
        }

        .btn-register:hover {
            background-color: #1565c0;
        }

        .login-link {
            text-align: center;
            margin-top: 18px;
            font-size: 13px;
            color: #555;
        }

        .login-link a {
            color: #4a90e2;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            padding: 10px 14px;
            font-size: 13px;
            margin-bottom: 16px;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                width: 95%;
            }
            .left-side, .right-side {
                width: 100%;
            }
            .left-side {
                border-radius: 10px 10px 0 0;
                padding: 30px 20px;
            }
            .image-area {
                max-width: 150px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- SISI KIRI -->
        <div class="left-side">
            <div class="left-content">
                <h2>Poliklinik Sehat</h2>
                <p>Sistem Informasi Poliklinik</p>
                <div class="image-area">
                    <img src="{{ asset('images/klinik.png') }}" alt="Poliklinik Sehat">
                    <p>Klinik kesehatan adalah Platform managemen kesehatan berbasis web modern yang dirancang untuk memudahkan seluruh alur pelayanan medis</p>
                </div>
            </div>
            <div class="footer-left">
                &copy; 2026 Poliklinik Sehat
            </div>
        </div>

        <!-- SISI KANAN -->
        <div class="right-side">
            <div class="register-wrapper">
                <div class="register-header">
                    <h2>Register</h2>
                    <p>Buat akun baru untuk melanjutkan</p>
                </div>

                @if ($errors->any())
                    <div class="alert-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('register.submit') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <div class="input-wrapper">
                            <i class="fas fa-user"></i>
                            <input type="text" name="name" id="name" placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <div class="input-wrapper">
                            <i class="fas fa-envelope"></i>
                            <input type="email" name="email" id="email" placeholder="Masukkan email" value="{{ old('email') }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <div class="input-wrapper">
                            <i class="fas fa-user-tag"></i>
                            <input type="text" name="username" id="username" placeholder="Masukkan username" value="{{ old('username') }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="password" id="password" placeholder="Masukkan password" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi password" required>
                        </div>
                    </div>

                    <button type="submit" class="btn-register">Daftar</button>

                    <div class="login-link">
                        <a href="{{ route('login') }}">Login akun yang sudah ada?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
