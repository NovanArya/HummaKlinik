<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Poliklinik Sehat</title>
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
            min-height: 550px;
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
            padding: 20px;
            position: relative;
        }

        .left-content {
            z-index: 2;
        }

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

        /* --- SISI KANAN (LOGIN FORM) --- */
        .right-side {
            width: 50%;
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }

        .login-wrapper {
            width: 100%;
            max-width: 320px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 5px;
        }

        .login-header p {
            font-size: 14px;
            color: #666;
        }

        .form-group {
            margin-bottom: 15px;
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

        .options-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
            margin-bottom: 20px;
            color: #555;
        }

        .options-row label {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .options-row label input {
            margin-right: 5px;
        }

        .options-row a {
            color: #4a90e2;
            text-decoration: none;
        }

        .options-row a:hover {
            text-decoration: underline;
        }

        .btn-submit {
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
        }

        .btn-submit:hover {
            background-color: #1565c0;
        }

        .register-link {
            text-align: center;
            margin-top: 18px;
            font-size: 13px;
            color: #555;
        }

        .register-link a {
            color: #4a90e2;
            text-decoration: none;
            font-weight: 600;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            padding: 10px 14px;
            font-size: 13px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
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

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                height: auto;
                width: 95%;
            }
            .left-side {
                width: 100%;
                padding: 40px 20px;
                border-radius: 10px 10px 0 0;
            }
            .right-side {
                width: 100%;
                padding: 40px 20px;
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
                    <img src="https://cdn-icons-png.flaticon.com/512/263/263115.png" alt="Ilustrasi Klinik">
                </div>
            </div>
            <div class="footer-left">
                &copy; 2024 Poliklinik Sehat
            </div>
        </div>

        <!-- SISI KANAN -->
        <div class="right-side">
            <div class="login-wrapper">
                <div class="login-header">
                    <h2>Login</h2>
                    <p>Silakan masuk untuk melanjutkan</p>
                </div>

                
                <?php if(session('success')): ?>
                    <div class="alert-success">
                        <i class="fas fa-check-circle"></i>
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                
                <?php if($errors->any()): ?>
                    <div class="alert-error">
                        <i class="fas fa-exclamation-circle"></i>
                        <?php echo e($errors->first()); ?>

                    </div>
                <?php endif; ?>

                <form action="<?php echo e(route('login.submit')); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <div class="input-wrapper">
                            <i class="fas fa-envelope"></i>
                            <input type="email" id="email" name="email" placeholder="Masukkan email" value="<?php echo e(old('email')); ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                        </div>
                    </div>

                    <div class="options-row">
                        <label>
                            <input type="checkbox" name="remember"> Ingat saya
                        </label>
                        <a href="#">Lupa password?</a>
                    </div>

                    <button type="submit" class="btn-submit">Masuk</button>

                    <div class="register-link">
                        Belum punya akun? <a href="<?php echo e(route('register')); ?>">Daftar di sini</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
<?php /**PATH C:\poliklinik_v2\resources\views/auth/login.blade.php ENDPATH**/ ?>