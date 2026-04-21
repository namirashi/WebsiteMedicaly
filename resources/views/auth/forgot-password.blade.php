<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi – Medicaly</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Fraunces:wght@700;900&display=swap"
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
            background: linear-gradient(135deg, #f0fafa, #e8f8f6);
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
            font-size: 2rem;
            font-weight: 900;
            color: var(--teal);
        }

        .brand span {
            color: var(--danger);
        }

        .logo-icon {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, var(--teal-light), var(--teal));
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

        .link-teal {
            color: var(--teal);
            text-decoration: none;
            font-weight: 600;
        }

        .link-teal:hover {
            text-decoration: underline;
        }

        .step-indicator {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .step-dot {
            width: 32px;
            height: 8px;
            border-radius: 4px;
            background: #eee;
            transition: background 0.3s;
        }

        .step-dot.active {
            background: var(--teal);
        }

        .step-dot.done {
            background: var(--teal-light);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="auth-card">
            <div class="text-center mb-4">
                <div class="logo-icon"><i class="bi bi-shield-lock-fill" style="color:white;font-size:1.8rem;"></i>
                </div>
                <div class="brand">Medic<span>aly</span></div>
            </div>

            {{-- LANGKAH 1: Masukkan email --}}
            <div id="step1">
                <h5 style="font-family:'Fraunces',serif;font-weight:800;margin-bottom:0.3rem;">Lupa Kata Sandi?</h5>
                <p style="color:var(--gray);font-size:0.88rem;margin-bottom:1.5rem;">Masukkan nama pengguna atau email
                    kamu, kami akan tampilkan pertanyaan keamanan.</p>

                <div class="step-indicator">
                    <div class="step-dot active"></div>
                    <div class="step-dot"></div>
                    <div class="step-dot"></div>
                </div>

                @if($errors->has('not_found'))
                    <div class="alert alert-danger mb-3"
                        style="border-radius:12px;border:none;background:rgba(255,93,83,0.1);color:#c0392b;font-size:0.88rem;">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ $errors->first('not_found') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.find') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label">Nama Pengguna atau Email</label>
                        <input type="text" name="identity" class="form-control"
                            placeholder="Masukkan nama pengguna atau email" value="{{ old('identity') }}" required
                            autofocus>
                    </div>
                    <button type="submit" class="btn-primary-teal">Lanjutkan</button>
                </form>
            </div>

            <p class="text-center mt-4 mb-0" style="font-size:0.9rem;">
                Ingat kata sandi? <a href="{{ route('login') }}" class="link-teal">Masuk</a>
            </p>
        </div>
    </div>
</body>

</html>