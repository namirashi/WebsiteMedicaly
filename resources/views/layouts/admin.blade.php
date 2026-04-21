{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin – @yield('title', 'Dashboard') | Medicaly</title>
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
            --sidebar: #0a2020;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f4f9f9;
        }

        .sidebar {
            width: 240px;
            background: var(--sidebar);
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            display: flex;
            flex-direction: column;
        }

        .sidebar-brand {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .sidebar-brand-text {
            font-family: 'Fraunces', serif;
            font-size: 1.5rem;
            font-weight: 900;
            color: var(--teal-light);
        }

        .sidebar-brand-text span {
            color: var(--danger);
        }

        .sidebar-nav {
            padding: 1rem 0;
            flex: 1;
        }

        .nav-section-label {
            padding: 0.4rem 1.2rem;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255, 255, 255, 0.35);
            font-weight: 700;
            margin-top: 0.5rem;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            padding: 0.7rem 1.2rem;
            color: rgba(255, 255, 255, 0.65);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s;
            border-radius: 0 50px 50px 0;
            margin-right: 12px;
        }

        .sidebar-link:hover {
            color: white;
            background: rgba(255, 255, 255, 0.08);
        }

        .sidebar-link.active {
            color: var(--teal-light);
            background: rgba(17, 153, 158, 0.2);
            font-weight: 700;
        }

        .sidebar-link i {
            font-size: 1rem;
            width: 20px;
        }

        .main-content {
            margin-left: 240px;
            padding: 2rem;
        }

        .topbar {
            background: white;
            border-radius: 16px;
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 12px rgba(17, 153, 158, 0.07);
            margin-bottom: 1.5rem;
        }

        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(17, 153, 158, 0.08);
        }

        .stat-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
        }

        .stat-num {
            font-family: 'Fraunces', serif;
            font-size: 2rem;
            font-weight: 900;
        }

        .data-table {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(17, 153, 158, 0.08);
        }

        .data-table thead th {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #888;
            border: none;
            font-weight: 700;
        }

        .data-table tbody tr {
            border-color: #f0f0f0;
        }

        .data-table tbody tr:hover td {
            background: #f8fdfd;
        }

        .badge-status {
            border-radius: 20px;
            padding: 4px 12px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .btn-sm-teal {
            background: var(--teal);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.3rem 0.8rem;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-sm-teal:hover {
            background: var(--teal-dark);
            color: white;
        }
    </style>
    @stack('styles')
</head>

<body>
    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="sidebar-brand">
            <div class="sidebar-brand-text">Medic<span>aly</span></div>
            <div style="font-size:0.72rem;color:rgba(255,255,255,0.4);margin-top:2px;">Panel Admin</div>
        </div>
        <nav class="sidebar-nav">
            <div class="nav-section-label">Utama</div>
            <a href="{{ route('admin.dashboard') }}"
                class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-fill"></i> Dashboard
            </a>
            <div class="nav-section-label">Manajemen</div>
            <a href="{{ route('admin.products.index') }}"
                class="sidebar-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i> Produk
            </a>
            <a href="{{ route('admin.orders.index') }}"
                class="sidebar-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <i class="bi bi-bag"></i> Pesanan
            </a>
            <div class="nav-section-label">Sistem</div>
            <a href="{{ route('admin.monitor') }}"
                class="sidebar-link {{ request()->routeIs('admin.monitor') ? 'active' : '' }}">
                <i class="bi bi-activity"></i> Monitor
            </a>
            <a href="{{ route('home') }}" class="sidebar-link">
                <i class="bi bi-house"></i> Lihat Website
            </a>
        </nav>
        <div style="padding:1rem;border-top:1px solid rgba(255,255,255,0.08);">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-link w-100 border-0 text-start" style="color:rgba(255,93,83,0.8);">
                    <i class="bi bi-box-arrow-right"></i> Keluar
                </button>
            </form>
        </div>
    </div>

    <!-- MAIN -->
    <div class="main-content">
        <div class="topbar">
            <div>
                <h5 style="margin:0;font-family:'Fraunces',serif;font-weight:800;">@yield('title', 'Dashboard')</h5>
                <small class="text-muted">{{ now()->format('l, d F Y') }}</small>
            </div>
            <div class="d-flex align-items-center gap-2">
                <div
                    style="width:36px;height:36px;background:var(--teal);border-radius:50%;display:flex;align-items:center;justify-content:center;">
                    <span
                        style="color:white;font-weight:700;font-size:0.8rem;">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                </div>
                <div>
                    <div style="font-weight:700;font-size:0.88rem;">{{ auth()->user()->name }}</div>
                    <div style="font-size:0.72rem;color:var(--gray);">Administrator</div>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 mb-3">{{ session('success') }}<button
                    class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-3">{{ session('error') }}<button
                    class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>