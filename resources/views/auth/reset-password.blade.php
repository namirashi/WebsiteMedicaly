<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Kata Sandi – Medicaly</title>
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
        }

        .link-teal {
            color: var(--teal);
            text-decoration: none;
            font-weight: 600;
        }

        .user-info {
            background: var(--teal-light);
            border-radius: 12px;
            padding: 0.8rem 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1.5rem;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            background: var(--teal);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 0.85rem;
        }

        .strength-bar {
            height: 4px;
            border-radius: 2px;
            background: #eee;
            margin-top: 6px;
            overflow: hidden;
        }

        .strength-fill {
            height: 100%;
            border-radius: 2px;
            transition: all 0.3s;
            width: 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="auth-card">
            <div class="text-center mb-4">
                <div class="logo-icon"><i class="bi bi-key-fill" style="color:white;font-size:1.8rem;"></i></div>
                <div class="brand">Medic<span>aly</span></div>
            </div>

            <h5 style="font-family:'Fraunces',serif;font-weight:800;margin-bottom:0.3rem;">Buat Kata Sandi Baru</h5>

            <div class="user-info">
                <div class="user-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                <div>
                    <div style="font-weight:700;font-size:0.9rem;">{{ $user->name }}</div>
                    <div style="font-size:0.78rem;color:var(--teal);">{{ $user->email }}</div>
                </div>
            </div>

            @if($errors->any())
                <div class="alert alert-danger mb-3"
                    style="border-radius:12px;border:none;background:rgba(255,93,83,0.1);color:#c0392b;font-size:0.88rem;">
                    <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.reset.update') }}">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}">

                <div class="mb-3">
                    <label class="form-label">Kata Sandi Baru</label>
                    <div class="input-group">
                        <input type="password" name="password" class="form-control" id="passNew"
                            placeholder="Minimal 6 karakter" oninput="checkStrength(this.value)" required>
                        <span class="input-group-text" onclick="togglePass('passNew', this)">
                            <i class="bi bi-eye-slash"></i>
                        </span>
                    </div>
                    <div class="strength-bar mt-1">
                        <div class="strength-fill" id="strengthFill"></div>
                    </div>
                    <small id="strengthLabel" style="font-size:0.75rem;"></small>
                </div>

                <div class="mb-4">
                    <label class="form-label">Konfirmasi Kata Sandi Baru</label>
                    <div class="input-group">
                        <input type="password" name="password_confirmation" class="form-control" id="passConf"
                            placeholder="Ulangi kata sandi baru" required>
                        <span class="input-group-text" onclick="togglePass('passConf', this)">
                            <i class="bi bi-eye-slash"></i>
                        </span>
                    </div>
                </div>

                <button type="submit" class="btn-primary-teal">Simpan Kata Sandi Baru</button>
            </form>
        </div>
    </div>
    <script>
        function togglePass(id, btn) {
            const el = document.getElementById(id);
            const icon = btn.querySelector('i');
            el.type = el.type === 'password' ? 'text' : 'password';
            icon.classList.toggle('bi-eye-slash');
            icon.classList.toggle('bi-eye');
        }
        function checkStrength(val) {
            const fill = document.getElementById('strengthFill');
            const label = document.getElementById('strengthLabel');
            let score = 0;
            if (val.length >= 6) score++;
            if (val.length >= 10) score++;
            if (/[A-Z]/.test(val)) score++;
            if (/[0-9]/.test(val)) score++;
            const levels = [{ w: '0%', c: '#eee', t: '' }, { w: '25%', c: '#FF5D53', t: 'Lemah' }, { w: '50%', c: '#f39c12', t: 'Cukup' }, { w: '75%', c: '#2ecc71', t: 'Kuat' }, { w: '100%', c: '#11999E', t: 'Sangat Kuat' }];
            const l = levels[Math.min(score, 4)];
            fill.style.width = l.w;
            fill.style.background = l.c;
            label.textContent = l.t;
            label.style.color = l.c;
        }
    </script>
</body>

</html>