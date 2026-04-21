<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Medicaly - @yield('title', 'Apotek Online Terpercaya')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Fraunces:wght@600;700;900&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee+Inline&display=swap" rel="stylesheet">
    <style>
        :root {
            --white: #FFFFFF;
            --teal: #11999E;
            --teal-light: #C0EAE2;
            --gray: #ABABAB;
            --danger: #FF5D53;
            --red: #FF5D53;
            --teal-dark: #0d7a7e;
            --teal-hover: #0f8a8f;
            --bg: #f5fafa;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            color: #1a1a2e;
        }

        h1,
        h2,
        h3 {
            font-family: 'Fraunces', serif;
        }

        /* NAVBAR */
        .navbar-medicaly {
            background: var(--white);
            box-shadow: 0 2px 20px rgba(17, 153, 158, 0.10);
            padding: 0.8rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand {
            font-family: 'Bungee Inline', sans-serif;
            font-size: 1.7rem;
            font-weight: 400;
            font-style: normal;
            color: var(--teal) !important;
            letter-spacing: -0.5px;
        }

        .navbar-brand span {
            color: var(--red);
        }

        .nav-link {
            color: #444 !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--teal) !important;
            background: var(--teal-light);
        }

        .btn-cart {
            background: var(--teal-light);
            color: var(--teal);
            border: none;
            border-radius: 50px;
            padding: 0.45rem 1.2rem;
            font-weight: 600;
            position: relative;
        }

        .btn-cart:hover {
            background: var(--teal);
            color: white;
        }

        .cart-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: var(--danger);
            color: white;
            border-radius: 50%;
            font-size: 0.65rem;
            width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        .btn-login {
            background: var(--teal);
            color: white !important;
            border-radius: 50px;
            padding: 0.45rem 1.4rem;
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-login:hover {
            background: var(--teal-dark);
            color: white !important;
        }

        .search-bar {
            border: 2px solid var(--teal-light);
            border-radius: 50px;
            padding: 0.4rem 1rem;
            font-size: 0.9rem;
            width: 260px;
            outline: none;
            transition: border 0.2s;
        }

        .search-bar:focus {
            border-color: var(--teal);
        }

        /* FOOTER */
        footer {
            background: #005757;
            color: #ccc;
            padding: 3rem 0 1.5rem;
            margin-top: 4rem;
        }

        footer h5 {
            color: white;
            font-family: 'Fraunces', serif;
            margin-bottom: 1rem;
        }

        footer a {
            color: #aaa;
            text-decoration: none;
            font-size: 0.9rem;
        }

        footer a:hover {
            color: var(--teal-light);
        }

        footer .footer-brand {
            font-family: 'Bungee Inline', sans-serif;
            font-size: 1.8rem;
            font-weight: 400;
            color: var(--teal-light) !important;
        }

        footer .footer-brand span {
            color: var(--red) !important;
        }

        footer .social-icon {
            width: 36px;
            height: 36px;
            background: rgba(192, 234, 226, 0.15);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--teal-light);
            margin-right: 6px;
            transition: all 0.2s;
        }

        footer .social-icon:hover {
            background: var(--teal);
            color: white;
        }

        /* ALERTS */
        .alert-medicaly {
            border-radius: 12px;
            border: none;
        }

        /* BUTTONS */
        .btn-teal {
            background: var(--teal);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 0.7rem 1.8rem;
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-teal:hover {
            background: var(--teal-dark);
            color: white;
            transform: translateY(-1px);
        }

        .btn-outline-teal {
            border: 2px solid var(--teal);
            color: var(--teal);
            border-radius: 10px;
            padding: 0.65rem 1.6rem;
            font-weight: 600;
            background: transparent;
            transition: all 0.2s;
        }

        .btn-outline-teal:hover {
            background: var(--teal);
            color: white;
        }

        /* CARDS */
        .card-medicaly {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(17, 153, 158, 0.08);
            transition: all 0.3s;
            overflow: hidden;
        }

        .card-medicaly:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 36px rgba(17, 153, 158, 0.16);
        }

        /* NOTIFICATION */
        .notif-dot {
            width: 10px;
            height: 10px;
            background: var(--danger);
            border-radius: 50%;
            display: inline-block;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(255, 93, 83, 0.4);
            }

            70% {
                box-shadow: 0 0 0 8px rgba(255, 93, 83, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(255, 93, 83, 0);
            }
        }

        /* Breadcrumb */
        .breadcrumb {
            background: none;
            padding: 0;
        }

        .breadcrumb-item a {
            color: var(--teal);
            text-decoration: none;
        }
    </style>
    @stack('styles')
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-medicaly navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="bi bi-plus-circle-fill"
                    style="color:var(--danger);font-size:1.3rem;vertical-align:middle;margin-right:6px;"></i>Medic<span>aly</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMain">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-3">
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                            href="{{ route('home') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}"
                            href="{{ route('products.index') }}">Produk</a></li>
                    @auth
                        @if(auth()->user()->isAdmin())
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Admin</a></li>
                        @endif
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('orders.*') ? 'active' : '' }}"
                                href="{{ route('orders.index') }}">Pesanan Saya</a></li>
                    @endauth
                </ul>
                <form class="me-3" action="{{ route('products.index') }}" method="GET">
                    <input type="text" name="search" class="search-bar" placeholder="  Cari produk..."
                        value="{{ request('search') }}">
                </form>
                <div class="d-flex align-items-center gap-2">
                    @auth
                        <!-- Cart -->
                        <a href="{{ route('cart.index') }}" class="btn btn-cart position-relative">
                            <i class="bi bi-bag"></i>
                            @php
                                $user = auth()->user();
                                $cartCount = \App\Models\Cart::where('user_id', $user->id)->count();
                            @endphp
                            @if($cartCount > 0)
                                <span class="cart-badge">{{ $cartCount }}</span>
                            @endif
                        </a>
                        <!-- Notif -->
                        <div class="dropdown">
                            @php
                                $user = auth()->user();

                                $notifications = $user->notifications()
                                    ->latest()
                                    ->take(5)
                                    ->get();

                                $unreadCount = $user->notifications()
                                    ->whereNull('read_at')
                                    ->count();
                            @endphp

                            <button class="btn btn-light rounded-circle" data-bs-toggle="dropdown"
                                style="width:38px;height:38px;display:flex;align-items:center;justify-content:center;">

                                <i class="bi bi-bell"></i>

                                @if($unreadCount > 0)
                                    <span class="notif-dot ms-1"></span>
                                @endif
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end"
                                style="min-width:280px;border-radius:12px;border:none;box-shadow:0 8px 30px rgba(0,0,0,0.12);">
                                <li class="px-3 py-2"><strong>Notifikasi</strong></li>
                                <li>
                                    <hr class="dropdown-divider my-1">
                                </li>
                                @forelse($notifications as $notif)
                                    <li>
                                        <a class="dropdown-item py-2"
                                            href="{{ route('orders.show', $notif->data['order_number'] ?? '#') }}"
                                            style="font-size:0.85rem;">
                                            <i class="bi bi-bag-check text-success me-2"></i>
                                            Pesanan <strong>{{ $notif->data['order_number'] ?? '' }}</strong><br>
                                            <small class="text-muted">{{ $notif->created_at->diffForHumans() }}</small>
                                        </a>
                                    </li>
                                @empty
                                    <li>
                                        <p class="text-center text-muted small py-2 mb-0">Tidak ada notifikasi</p>
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                        <!-- User -->
                        <div class="dropdown">
                            <button class="btn d-flex align-items-center gap-2" data-bs-toggle="dropdown"
                                style="background:var(--teal-light);border-radius:50px;padding:0.4rem 1rem;">
                                <div
                                    style="width:28px;height:28px;background:var(--teal);border-radius:50%;display:flex;align-items:center;justify-content:center;">
                                    <span
                                        style="color:white;font-size:0.75rem;font-weight:700;">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                                </div>
                                <span
                                    style="font-weight:600;font-size:0.9rem;color:var(--teal);">{{ auth()->user()->name }}</span>
                                <i class="bi bi-chevron-down" style="font-size:0.75rem;color:var(--teal);"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end"
                                style="border-radius:12px;border:none;box-shadow:0 8px 30px rgba(0,0,0,0.12);">
                                <li><a class="dropdown-item" href="{{ route('orders.index') }}"><i
                                            class="bi bi-box-seam me-2 text-muted"></i>Pesanan Saya</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger"><i
                                                class="bi bi-box-arrow-right me-2"></i>Keluar</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-login">Masuk</a>
                        <a href="{{ route('register') }}" class="btn btn-outline-teal">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- ALERTS -->
    <div class="container mt-3">
        @if(session('success'))
            <div class="alert alert-success alert-medicaly alert-dismissible fade show d-flex align-items-center gap-2">
                <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-medicaly alert-dismissible fade show d-flex align-items-center gap-2">
                <i class="bi bi-exclamation-triangle-fill"></i> {{ session('error') }}
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger alert-medicaly">
                <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
        @endif
    </div>

    @yield('content')

    <!-- FOOTER -->
    <footer>
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="footer-brand mb-2"></i>Medic<span>aly</span></div>
                    <p style="font-size:0.9rem;color:#aaa;max-width:280px;">Apotek online terpercaya untuk kebutuhan
                        kesehatan Anda. Produk berkualitas, pengiriman cepat.</p>
                </div>
                <div class="col-md-2">
                    <h5>Menu</h5>
                    <ul class="list-unstyled d-flex flex-column gap-2">
                        <li><a href="{{ route('home') }}">Beranda</a></li>
                        <li><a href="{{ route('products.index') }}">Produk</a></li>
                        @auth
                            <li><a href="{{ route('orders.index') }}">Pesanan</a></li>
                        @endauth
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Kontak</h5>
                    <ul class="list-unstyled d-flex flex-column gap-2" style="font-size:0.9rem;color:#aaa;">
                        <li><i class="bi bi-geo-alt me-2" style="color:var(--teal-light);"></i>Purwokerto, Jawa Tengah
                        </li>
                        <li><i class="bi bi-telephone me-2" style="color:var(--teal-light);"></i>+62 812-3456-7890</li>
                        <li><i class="bi bi-envelope me-2" style="color:var(--teal-light);"></i>info@medicaly.id</li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Jam Operasional</h5>
                    <p style="font-size:0.9rem;color:#aaa;">Senin – Jumat: 08.00 – 22.00<br>Sabtu – Minggu: 09.00 –
                        20.00</p>
                    <div class="d-flex align-items-center gap-2 mt-2">
                        <span class="notif-dot"></span>
                        <small style="color:#aaa;">Sedang Online</small>
                    </div>
                </div>
            </div>
            <hr style="border-color:rgba(255,255,255,0.1);margin-top:2rem;">
            <p class="text-center mb-0" style="font-size:0.85rem;color:#666;">© {{ date('Y') }} Medicaly.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Real-time cart count update (polling setiap 30 detik)
        @auth
            setInterval(() => {
                fetch('/cart-count', { headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content } })
                    .then(r => r.json()).then(data => {
                        const badge = document.querySelector('.cart-badge');
                        if (data.count > 0) {
                            if (badge) badge.textContent = data.count;
                        }
                    }).catch(() => { });
            }, 30000);
        @endauth
    </script>
    @stack('scripts')
</body>

</html>