<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manajemen Pesanan – Medicaly Admin</title>
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
            --sidebar-bg: #0a2020;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f4f9f9;
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 240px;
            min-width: 240px;
            background: var(--sidebar-bg);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
        }

        .sidebar-brand {
            padding: 1.5rem 1.2rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .sidebar-brand-name {
            font-family: 'Fraunces', serif;
            font-size: 1.6rem;
            font-weight: 900;
            color: var(--teal-light);
        }

        .sidebar-brand-name span {
            color: var(--danger);
        }

        .sidebar-brand-sub {
            font-size: 0.7rem;
            color: rgba(255, 255, 255, 0.35);
            margin-top: 2px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .sidebar-nav {
            padding: 0.8rem 0;
            flex: 1;
        }

        .nav-label {
            padding: 0.5rem 1.2rem 0.3rem;
            font-size: 0.68rem;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: rgba(255, 255, 255, 0.3);
            font-weight: 700;
            margin-top: 0.5rem;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.65rem 1.2rem;
            color: rgba(255, 255, 255, 0.6);
            text-decoration: none;
            font-size: 0.88rem;
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
            background: rgba(17, 153, 158, 0.25);
            font-weight: 700;
        }

        .sidebar-link i {
            font-size: 1rem;
            width: 20px;
            text-align: center;
        }

        .sidebar-footer {
            padding: 1rem 1.2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }

        /* MAIN */
        .main-wrapper {
            margin-left: 240px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            background: white;
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 12px rgba(17, 153, 158, 0.07);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .topbar-title {
            font-family: 'Fraunces', serif;
            font-size: 1.3rem;
            font-weight: 900;
            color: #1a1a2e;
        }

        .page-content {
            padding: 1.5rem;
            flex: 1;
        }

        /* === BUTTON SMALL LIGHT TEAL === */
        .btn-sm-teal {
            display: inline-flex;
            align-items: center;
            gap: 6px;

            padding: 6px 14px;
            font-size: 0.85rem;
            font-weight: 500;

            color: #0f766e;
            background: #d1f3f0;
            /* light teal */
            border: 1px solid #a7e7e1;

            border-radius: 8px;
            text-decoration: none;

            transition: all 0.25s ease;
        }

        /* ICON */
        .btn-sm-teal i {
            font-size: 0.95rem;
        }

        /* HOVER */
        .btn-sm-teal:hover {
            background: #14b8a6;
            color: #ffffff;
            border-color: #14b8a6;
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(20, 184, 166, 0.25);
        }

        /* ACTIVE */
        .btn-sm-teal:active {
            transform: scale(0.97);
        }

        /* OPTIONAL: PDF (override merah biar tetap soft) */
        .btn-sm-teal[style] {
            background: #fde2e0 !important;
            color: #c0392b !important;
            border-color: #f5b7b1 !important;
        }

        .btn-sm-teal[style]:hover {
            background: #e74c3c !important;
            color: #fff !important;
        }

        /* TABLE */
        .data-card {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(17, 153, 158, 0.07);
            border: 1px solid rgba(17, 153, 158, 0.06);
        }

        .table {
            border-collapse: separate;
            border-spacing: 0;
        }

        .table thead th {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--gray);
            border: none;
            font-weight: 700;
            padding: 0.6rem 1rem;
            background: #fafafa;
        }

        .table thead th:first-child {
            border-radius: 10px 0 0 10px;
        }

        .table thead th:last-child {
            border-radius: 0 10px 10px 0;
        }

        .table tbody td {
            font-size: 0.88rem;
            padding: 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #f5f5f5;
            border-top: none;
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        .table tbody tr:hover td {
            background: #f8fdfd;
        }

        /* STATUS BADGE */
        .badge-status {
            border-radius: 20px;
            padding: 4px 12px;
            font-size: 0.72rem;
            font-weight: 700;
            display: inline-block;
        }

        /* SELECT STATUS */
        .select-status {
            border: 2px solid #eef2f2;
            border-radius: 10px;
            padding: 0.35rem 0.6rem;
            font-size: 0.82rem;
            font-family: inherit;
            outline: none;
            min-width: 130px;
            cursor: pointer;
            color: #333;
            transition: border 0.2s;
            background: white;
        }

        .select-status:focus {
            border-color: var(--teal);
        }

        /* TOMBOL LIHAT */
        .btn-lihat {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: #e8f8f6;
            color: var(--teal);
            border: none;
            border-radius: 8px;
            padding: 0.4rem 0.9rem;
            font-size: 0.82rem;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s;
            white-space: nowrap;
        }

        .btn-lihat:hover {
            background: var(--teal);
            color: white;
        }

        /* FILTER CHIPS */
        .filter-chip {
            padding: 0.35rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-decoration: none;
            border: 2px solid #eee;
            color: #555;
            background: white;
            transition: all 0.2s;
            display: inline-block;
        }

        .filter-chip:hover {
            border-color: var(--teal);
            color: var(--teal);
        }

        .filter-chip.active {
            background: var(--teal);
            color: white;
            border-color: var(--teal);
        }

        /* PAGINATION */
        .page-link {
            color: var(--teal);
            border-radius: 8px !important;
            border: 2px solid #eef2f2 !important;
            margin: 0 2px;
            font-size: 0.85rem;
        }

        .page-item.active .page-link {
            background: var(--teal) !important;
            border-color: var(--teal) !important;
            color: white !important;
        }

        .page-item.disabled .page-link {
            background: #f5f5f5 !important;
            color: #ccc !important;
            border-color: #eee !important;
        }

        /* ALERT */
        .alert {
            border-radius: 12px;
            border: none;
            font-size: 0.88rem;
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="sidebar-brand-name">Medic<span>aly</span></div>
            <div class="sidebar-brand-sub">Panel Administrator</div>
        </div>
        <nav class="sidebar-nav">
            <div class="nav-label">Utama</div>
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
                <i class="bi bi-grid-fill"></i> Dashboard
            </a>
            <div class="nav-label">Manajemen</div>
            <a href="{{ route('admin.products.index') }}" class="sidebar-link">
                <i class="bi bi-box-seam-fill"></i> Produk
            </a>
            <a href="{{ route('admin.orders.index') }}" class="sidebar-link active">
                <i class="bi bi-bag-fill"></i> Pesanan
                @php $pendingCount = \App\Models\Order::where('status', 'pending')->count(); @endphp
                @if($pendingCount > 0)
                    <span
                        style="background:var(--danger);color:white;border-radius:20px;padding:1px 8px;font-size:0.68rem;font-weight:700;margin-left:auto;">{{ $pendingCount }}</span>
                @endif
            </a>
            <div class="nav-label">Sistem</div>
            <a href="{{ route('admin.monitor') }}" class="sidebar-link">
                <i class="bi bi-activity"></i> Monitor
            </a>
            <div class="nav-label">Navigasi</div>
            <a href="{{ route('home') }}" class="sidebar-link" target="_blank">
                <i class="bi bi-house-fill"></i> Lihat Website
            </a>
        </nav>
        <div class="sidebar-footer">
            <div style="display:flex;align-items:center;gap:0.7rem;margin-bottom:0.8rem;">
                <div
                    style="width:34px;height:34px;background:var(--teal);border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:0.8rem;color:white;">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div>
                    <div style="font-size:0.85rem;font-weight:600;color:white;">{{ auth()->user()->name }}</div>
                    <div style="font-size:0.7rem;color:rgba(255,255,255,0.4);">Administrator</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    style="width:100%;background:rgba(255,93,83,0.15);border:none;border-radius:8px;padding:0.5rem;color:rgba(255,93,83,0.9);font-size:0.82rem;font-weight:600;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:6px;">
                    <i class="bi bi-box-arrow-right"></i> Keluar
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN -->
    <div class="main-wrapper">
        <div class="topbar">
            <div>
                <div class="topbar-title">Manajemen Pesanan</div>
                <small style="color:var(--gray);">Kelola dan update status semua pesanan</small>
            </div>
            <div
                style="display:flex;align-items:center;gap:8px;background:#f5f5f5;border-radius:10px;padding:0.4rem 0.9rem;">
                <div
                    style="width:28px;height:28px;background:var(--teal);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:0.75rem;font-weight:700;color:white;">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <span style="font-size:0.85rem;font-weight:600;color:#333;">{{ auth()->user()->name }}</span>
            </div>
        </div>

        <div class="page-content">

            @if(session('success'))
                <div class="alert alert-dismissible fade show mb-3" style="background:rgba(46,204,113,0.12);color:#1a7a3f;">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- FILTER STATUS --}}
            <div class="d-flex gap-2 mb-3 flex-wrap">
                @php
                    $allStatuses = [
                        '' => 'Semua',
                        'pending' => 'Menunggu',
                        'processing' => 'Diproses',
                        'shipped' => 'Dikirim',
                        'delivered' => 'Selesai',
                        'cancelled' => 'Dibatalkan',
                    ];
                    $counts = [
                        'pending' => \App\Models\Order::where('status', 'pending')->count(),
                        'processing' => \App\Models\Order::where('status', 'processing')->count(),
                        'shipped' => \App\Models\Order::where('status', 'shipped')->count(),
                        'delivered' => \App\Models\Order::where('status', 'delivered')->count(),
                        'cancelled' => \App\Models\Order::where('status', 'cancelled')->count(),
                    ];
                @endphp
                @foreach($allStatuses as $val => $label)
                    <a href="{{ route('admin.orders.index', $val ? ['status' => $val] : []) }}"
                        class="filter-chip {{ request('status') === $val ? 'active' : '' }}">
                        {{ $label }}
                        @if($val && isset($counts[$val]) && $counts[$val] > 0)
                            <span style="opacity:0.75;">({{ $counts[$val] }})</span>
                        @endif
                    </a>
                @endforeach
            </div>

            <div class="data-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <span style="font-weight:800;font-size:1rem;">Daftar Pesanan</span>
                        <span
                            style="background:var(--teal-light);color:var(--teal);border-radius:20px;padding:2px 10px;font-size:0.75rem;font-weight:700;margin-left:8px;">
                            {{ $orders->total() }} pesanan
                        </span>
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.export.orders.excel') }}" class="btn-sm-teal">
                        <i class="bi bi-file-earmark-spreadsheet"></i> Export Excel
                    </a>
                    <a href="{{ route('admin.export.orders.pdf') }}" class="btn-sm-teal" style="background:#e74c3c;">
                        <i class="bi bi-file-earmark-pdf"></i> Export PDF
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>NO. PESANAN</th>
                                <th>PELANGGAN</th>
                                <th>TOTAL</th>
                                <th>PEMBAYARAN</th>
                                <th>UPDATE STATUS</th>
                                <th>TANGGAL</th>
                                <th style="text-align:center;">DETAIL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                @php
                                    $sc = [
                                        'pending' => ['warning', 'Menunggu'],
                                        'processing' => ['info', 'Diproses'],
                                        'shipped' => ['primary', 'Dikirim'],
                                        'delivered' => ['success', 'Selesai'],
                                        'cancelled' => ['danger', 'Dibatalkan'],
                                    ];
                                    $s = $sc[$order->status] ?? ['secondary', ucfirst($order->status)];
                                @endphp
                                <tr>
                                    <td>
                                        <div style="font-weight:700;font-size:0.85rem;margin-bottom:4px;">
                                            {{ $order->order_number }}</div>
                                        <span class="badge bg-{{ $s[0] }} badge-status">{{ $s[1] }}</span>
                                    </td>
                                    <td>
                                        <div style="font-weight:600;font-size:0.88rem;">{{ $order->user->name ?? '-' }}
                                        </div>
                                        <div style="font-size:0.78rem;color:var(--gray);">{{ $order->user->email ?? '' }}
                                        </div>
                                    </td>
                                    <td>
                                        <span
                                            style="font-family:'Fraunces',serif;font-weight:700;color:var(--teal);font-size:0.95rem;">
                                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td style="font-size:0.85rem;">
                                        {{ ucwords(str_replace('_', ' ', $order->payment_method ?? '-')) }}
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.orders.update', $order->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" class="select-status" onchange="this.form.submit()">
                                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>
                                                    Menunggu</option>
                                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Diproses</option>
                                                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>
                                                    Dikirim</option>
                                                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Selesai</option>
                                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td>
                                        <div style="font-size:0.82rem;font-weight:600;">
                                            {{ $order->created_at->format('d M Y') }}</div>
                                        <div style="font-size:0.75rem;color:var(--gray);">
                                            {{ $order->created_at->format('H:i') }}</div>
                                    </td>
                                    <td style="text-align:center;">
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn-lihat">
                                            <i class="bi bi-eye-fill"></i> Lihat
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <i class="bi bi-bag-x"
                                            style="font-size:3rem;color:var(--gray);opacity:0.4;display:block;margin-bottom:10px;"></i>
                                        <span style="color:var(--gray);font-size:0.9rem;">Belum ada pesanan.</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($orders->hasPages())
                    <div class="mt-4 d-flex justify-content-center">
                        {{ $orders->withQueryString()->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>