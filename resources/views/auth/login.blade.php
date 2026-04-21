<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk – Medicaly</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Fraunces:wght@700;900&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --teal: #11999E;
            --teal-light: #C0EAE2;
            --teal-dark: #0d7a7e;
            --danger: #FF5D53;
            --gray: #ABABAB;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #f0fafa 0%, #e8f8f6 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .auth-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(17, 153, 158, 0.14);
            padding: 2.5rem;
            width: 100%;
            max-width: 440px;
            margin: auto;
        }

        .brand {
            font-family: 'Fraunces', serif;
            font-size: 2.2rem;
            font-weight: 900;
            color: var(--teal);
            letter-spacing: -1px;
        }

        .brand span {
            color: var(--danger);
        }

        .logo-icon {
            width: 64px;
            height: 64px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.9rem;
            color: #444;
        }

        .form-control {
            border: 2px solid #eef2f2;
            border-radius: 12px;
            padding: 0.7rem 1rem;
            font-size: 0.95rem;
            transition: border 0.2s;
        }

        .form-control:focus {
            border-color: var(--teal);
            box-shadow: 0 0 0 4px rgba(17, 153, 158, 0.1);
        }

        .input-group .form-control {
            border-radius: 12px 0 0 12px;
        }

        .input-group-text {
            border: 2px solid #eef2f2;
            border-left: none;
            border-radius: 0 12px 12px 0;
            background: white;
            cursor: pointer;
            color: var(--gray);
        }

        .btn-primary-teal {
            background: var(--teal);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 0.8rem;
            font-weight: 700;
            font-size: 1rem;
            width: 100%;
            transition: all 0.2s;
        }

        .btn-primary-teal:hover {
            background: var(--teal-dark);
            transform: translateY(-1px);
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: var(--gray);
            font-size: 0.85rem;
            margin: 1.5rem 0;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #eee;
        }

        .btn-social {
            border: 2px solid #eee;
            border-radius: 12px;
            background: white;
            padding: 0.6rem;
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 1;
            transition: all 0.2s;
            font-size: 1.3rem;
            color: #444;
        }

        .btn-social:hover {
            border-color: var(--teal);
            background: var(--teal-light);
        }

        .link-teal {
            color: var(--teal);
            text-decoration: none;
            font-weight: 600;
        }

        .link-teal:hover {
            text-decoration: underline;
        }

        .alert-danger {
            border-radius: 12px;
            border: none;
            background: rgba(255, 93, 83, 0.1);
            color: #c0392b;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="auth-card">
            <div class="text-center mb-4">
                <div class="logo-icon">
                    <img src="{{ asset('images/logo.png') }}" alt="Medicaly Logo" style="width:80px;height:80px;">
                    <i class="bi bi-plus-lg" style="color:white;font-size:1.8rem;"></i>
                </div>
                <div class="brand">Medic<span>aly</span></div>
                <p class="text-muted mt-1" style="font-size:0.92rem;">Selamat Datang di Medicaly</p>
            </div>

            @if($errors->any())
                <div class="alert alert-danger mb-3">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="/login">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email atau Nama Pengguna</label>
                    <input type="text" name="login" class="form-control" placeholder="Masukkan email atau username"
                        value="{{ old('login') }}" required autofocus>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kata Sandi</label>
                    <div class="input-group">
                        <input type="password" name="password" class="form-control" id="passInput"
                            placeholder="Masukan kata sandi anda" required>
                        <span class="input-group-text" onclick="togglePass('passInput', this)">
                            <i class="bi bi-eye-slash"></i>
                        </span>
                    </div>
                </div>
                <div class="text-end mb-4">
                    <a href="{{ route('password.forgot') }}" class="link-teal" style="font-size:0.88rem;">Lupa kata
                        sandi?</a>
                </div>
                <button type="submit" class="btn-primary-teal">Masuk</button>
            </form>
            <p class="text-center mt-4 mb-0" style="font-size:0.92rem;">
                Belum punya akun? <a href="{{ route('register') }}" class="link-teal">Daftar</a>
            </p>
        </div>
    </div>
    <script>
        function togglePass(inputId, btn) {
            const input = document.getElementById(inputId);
            const icon = btn.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('bi-eye-slash', 'bi-eye');
            } else {
                input.type = 'password';
                icon.classList.replace('bi-eye', 'bi-eye-slash');
            }
        }
    </script>
</body>

</html>