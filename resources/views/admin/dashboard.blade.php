<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard – Medicaly Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Fraunces:wght@700;900&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
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
            min-height: 100vh;
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

        /* STAT CARDS */
        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 1.4rem;
            box-shadow: 0 4px 20px rgba(17, 153, 158, 0.07);
            border: 1px solid rgba(17, 153, 158, 0.06);
            transition: transform 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
        }

        .stat-num {
            font-family: 'Fraunces', serif;
            font-size: 1.9rem;
            font-weight: 900;
            color: #1a1a2e;
            line-height: 1;
            margin-top: 0.7rem;
        }

        .stat-label {
            font-size: 0.8rem;
            color: var(--gray);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-change {
            font-size: 0.78rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 3px;
        }

        /* CARDS */
        .data-card {
            background: white;
            border-radius: 16px;
            padding: 1.4rem;
            box-shadow: 0 4px 20px rgba(17, 153, 158, 0.07);
            border: 1px solid rgba(17, 153, 158, 0.06);
        }

        .data-card-title {
            font-weight: 800;
            font-size: 1rem;
            color: #1a1a2e;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* TABLE */
        .table thead th {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--gray);
            border: none;
            font-weight: 700;
            padding: 0.5rem 0.75rem;
            background: #fafafa;
        }

        .table tbody td {
            font-size: 0.85rem;
            padding: 0.75rem;
            vertical-align: middle;
            border-color: #f5f5f5;
        }

        .table tbody tr:hover td {
            background: #f8fdfd;
        }

        .badge-status {
            border-radius: 20px;
            padding: 3px 10px;
            font-size: 0.72rem;
            font-weight: 700;
        }

        /* CHART */
        .chart-card {
            background: white;
            border-radius: 16px;
            padding: 1.4rem;
            box-shadow: 0 4px 20px rgba(17, 153, 158, 0.07);
            border: 1px solid rgba(17, 153, 158, 0.06);
        }

        .chart-card-title {
            font-weight: 800;
            font-size: 1rem;
            color: #1a1a2e;
            margin-bottom: 0.2rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .chart-card-sub {
            font-size: 0.78rem;
            color: var(--gray);
            margin-bottom: 1rem;
        }

        /* STAT LIST */
        .stat-list-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.6rem 0.8rem;
            border-radius: 10px;
            margin-bottom: 0.5rem;
            background: #f8fdfd;
        }

        .stat-list-item:last-child {
            margin-bottom: 0;
        }

        .stat-list-label {
            font-size: 0.85rem;
            color: #555;
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .stat-list-label i {
            font-size: 0.9rem;
        }

        .stat-list-val {
            font-weight: 800;
            font-size: 1rem;
        }

        /* STOK RENDAH */
        .stock-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.55rem 0;
            border-bottom: 1px solid #f5f5f5;
        }

        .stock-item:last-child {
            border-bottom: none;
        }

        /* BTN */
        .btn-sm-teal {
            background: var(--teal-light);
            color: var(--teal);
            border: none;
            border-radius: 8px;
            padding: 0.3rem 0.8rem;
            font-size: 0.8rem;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .btn-sm-teal:hover {
            background: var(--teal);
            color: white;
        }

        /* ALERT */
        .alert {
            border-radius: 12px;
            border: none;
            font-size: 0.88rem;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(46, 204, 113, 0.4)
            }

            70% {
                box-shadow: 0 0 0 8px rgba(46, 204, 113, 0)
            }

            100% {
                box-shadow: 0 0 0 0 rgba(46, 204, 113, 0)
            }
        }

        .dot-online {
            width: 9px;
            height: 9px;
            background: #2ecc71;
            border-radius: 50%;
            display: inline-block;
            animation: pulse 1.5s infinite;
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
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link active">
                <i class="bi bi-grid-fill"></i> Dashboard
            </a>
            <div class="nav-label">Manajemen</div>
            <a href="{{ route('admin.products.index') }}" class="sidebar-link">
                <i class="bi bi-box-seam-fill"></i> Produk
            </a>
            <a href="{{ route('admin.orders.index') }}" class="sidebar-link">
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
                <span class="dot-online ms-auto"></span>
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
                <div class="topbar-title">Dashboard</div>
                <small style="color:var(--gray);">{{ now()->format('l, d F Y') }}</small>
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

            @php
                $lowStock = \App\Models\Product::where('stock', '<', 5)->where('is_active', true)->count();
                $pendingOrders = \App\Models\Order::where('status', 'pending')->count();

                // Stat cards
                $totalProduk = \App\Models\Product::count();
                $totalPesanan = \App\Models\Order::count();
                $totalUser = \App\Models\User::where('role', 'user')->count();
                $totalRevenue = \App\Models\Order::where('status', 'delivered')->sum('total_amount');

                // Chart: pesanan 7 hari terakhir
                $chartLabels = [];
                $chartOrders = [];
                for ($i = 6; $i >= 0; $i--) {
                    $date = now()->subDays($i);
                    $chartLabels[] = $date->format('d M');
                    $chartOrders[] = \App\Models\Order::whereDate('created_at', $date)->count();
                }

                // Statistik hari ini
                $todayOrders = \App\Models\Order::whereDate('created_at', today())->count();
                $todayUsers = \App\Models\User::whereDate('created_at', today())->count();
                $todayRevenue = \App\Models\Order::where('status', 'delivered')->whereDate('updated_at', today())->sum('total_amount');
                $outOfStock = \App\Models\Product::where('stock', 0)->count();
                $totalKategori = \App\Models\Category::count();
            @endphp

            @if($lowStock > 0)
                <div class="alert mb-3 d-flex align-items-center gap-2"
                    style="background:rgba(243,156,18,0.12);color:#b7770d;">
                    <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                    <div>⚠ <strong>{{ $lowStock }} produk</strong> stok kritis (&lt;5)
                        <a href="{{ route('admin.products.index') }}"
                            style="color:inherit;font-weight:700;margin-left:8px;">Kelola →</a>
                    </div>
                </div>
            @endif

            {{-- STAT CARDS --}}
            <div class="row g-3 mb-4">
                <div class="col-6 col-xl-3">
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="stat-label">Total Produk</div>
                            <div class="stat-icon" style="background:rgba(17,153,158,0.1);"><i
                                    class="bi bi-box-seam-fill" style="color:var(--teal);"></i></div>
                        </div>
                        <div class="stat-num">{{ $totalProduk }}</div>
                        <div class="stat-change" style="color:#2ecc71;"><i class="bi bi-check-circle-fill"></i> Aktif:
                            {{ \App\Models\Product::where('is_active', true)->count() }}</div>
                    </div>
                </div>
                <div class="col-6 col-xl-3">
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="stat-label">Total Pesanan</div>
                            <div class="stat-icon" style="background:rgba(255,93,83,0.1);"><i class="bi bi-bag-fill"
                                    style="color:var(--danger);"></i></div>
                        </div>
                        <div class="stat-num">{{ $totalPesanan }}</div>
                        <div class="stat-change" style="color:orange;"><i class="bi bi-clock-fill"></i> Pending:
                            {{ $pendingOrders }}</div>
                    </div>
                </div>
                <div class="col-6 col-xl-3">
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="stat-label">Total Pengguna</div>
                            <div class="stat-icon" style="background:rgba(52,152,219,0.1);"><i class="bi bi-people-fill"
                                    style="color:#3498db;"></i></div>
                        </div>
                        <div class="stat-num">{{ $totalUser }}</div>
                        <div class="stat-change" style="color:#3498db;"><i class="bi bi-person-plus-fill"></i> Baru
                            bulan ini:
                            {{ \App\Models\User::where('role', 'user')->whereMonth('created_at', now()->month)->count() }}
                        </div>
                    </div>
                </div>
                <div class="col-6 col-xl-3">
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="stat-label">Pendapatan</div>
                            <div class="stat-icon" style="background:rgba(46,204,113,0.1);"><i class="bi bi-cash-coin"
                                    style="color:#2ecc71;"></i></div>
                        </div>
                        <div class="stat-num" style="font-size:1.3rem;">Rp
                            {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                        <div class="stat-change" style="color:#2ecc71;"><i class="bi bi-check2-circle"></i> Selesai:
                            {{ \App\Models\Order::where('status', 'delivered')->count() }}</div>
                    </div>
                </div>
            </div>

            {{-- ROW: GRAFIK + SIDEBAR KANAN --}}
            <div class="row g-3 mb-3">

                {{-- GRAFIK BAR: Pesanan 7 Hari Terakhir --}}
                <div class="col-lg-8">
                    <div class="chart-card">
                        <div class="chart-card-title">
                            <i class="bi bi-bar-chart-fill" style="color:var(--teal);"></i> Pesanan 7 Hari Terakhir
                        </div>
                        <div class="chart-card-sub">Jumlah pesanan masuk per hari</div>
                        <canvas id="chartPesanan" height="110"></canvas>
                    </div>
                </div>

                {{-- SIDEBAR KANAN: STATISTIK HARI INI SAJA --}}
                <div class="col-lg-4">
                    <div class="data-card">
                        <div class="data-card-title">
                            <i class="bi bi-bar-chart-line-fill" style="color:#f39c12;"></i> Statistik Hari Ini
                        </div>

                        <div class="stat-list-item">
                            <span class="stat-list-label">
                                <i class="bi bi-bag-fill" style="color:var(--teal);"></i> Pesanan Masuk
                            </span>
                            <span class="stat-list-val" style="color:var(--teal);">{{ $todayOrders }}</span>
                        </div>

                        <div class="stat-list-item">
                            <span class="stat-list-label">
                                <i class="bi bi-person-plus-fill" style="color:#3498db;"></i> Pengguna Baru
                            </span>
                            <span class="stat-list-val" style="color:#3498db;">{{ $todayUsers }}</span>
                        </div>

                        <div class="stat-list-item">
                            <span class="stat-list-label">
                                <i class="bi bi-cash-coin" style="color:#2ecc71;"></i> Pendapatan Hari Ini
                            </span>
                            <span class="stat-list-val" style="color:#2ecc71;font-size:0.85rem;">Rp
                                {{ number_format($todayRevenue, 0, ',', '.') }}</span>
                        </div>

                        <div class="stat-list-item">
                            <span class="stat-list-label">
                                <i class="bi bi-box-seam" style="color:var(--danger);"></i> Produk Habis
                            </span>
                            <span class="stat-list-val" style="color:var(--danger);">{{ $outOfStock }}</span>
                        </div>

                        <div class="stat-list-item">
                            <span class="stat-list-label">
                                <i class="bi bi-grid-fill" style="color:#9b59b6;"></i> Total Kategori
                            </span>
                            <span class="stat-list-val" style="color:#9b59b6;">{{ $totalKategori }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ROW: PESANAN TERBARU + STOK RENDAH --}}
            <div class="row g-3">
                <div class="col-lg-8">
                    <div class="data-card">
                        <div class="data-card-title">
                            <i class="bi bi-bag" style="color:var(--teal);"></i> Pesanan Terbaru
                            <a href="{{ route('admin.orders.index') }}" class="btn-sm-teal ms-auto">Lihat Semua <i
                                    class="bi bi-arrow-right"></i></a>
                        </div>
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>No. Pesanan</th>
                                        <th>Pelanggan</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse(\App\Models\Order::with('user')->latest()->take(7)->get() as $order)
                                        @php $sc = ['pending' => ['warning', 'Menunggu'], 'processing' => ['info', 'Diproses'], 'shipped' => ['primary', 'Dikirim'], 'delivered' => ['success', 'Selesai'], 'cancelled' => ['danger', 'Batal']];
                                        $s = $sc[$order->status] ?? ['secondary', $order->status]; @endphp
                                        <tr>
                                            <td style="font-weight:700;font-size:0.83rem;">{{ $order->order_number }}</td>
                                            <td style="font-size:0.83rem;">{{ $order->user->name ?? '-' }}</td>
                                            <td style="font-weight:700;color:var(--teal);font-size:0.83rem;">Rp
                                                {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                            <td><span class="badge bg-{{ $s[0] }} badge-status">{{ $s[1] }}</span></td>
                                            <td style="font-size:0.78rem;color:var(--gray);">
                                                {{ $order->created_at->format('d M Y') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted py-3">Belum ada pesanan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- STOK RENDAH --}}
                <div class="col-lg-4">
                    <div class="data-card" style="height:100%;">
                        <div class="data-card-title">
                            <i class="bi bi-exclamation-triangle-fill" style="color:orange;"></i> Stok Rendah
                            <a href="{{ route('admin.products.index') }}" class="btn-sm-teal ms-auto">Kelola</a>
                        </div>
                        @forelse(\App\Models\Product::where('stock', '<', 10)->where('is_active', true)->orderBy('stock')->take(7)->get() as $p)
                            <div class="stock-item">
                                <div>
                                    <div style="font-weight:600;font-size:0.85rem;">
                                        {{ \Illuminate\Support\Str::limit($p->name, 22) }}</div>
                                    <div style="font-size:0.75rem;color:var(--gray);">{{ $p->unit }}</div>
                                </div>
                                <span class="badge"
                                    style="background:{{ $p->stock === 0 ? 'var(--danger)' : ($p->stock < 5 ? '#e67e22' : '#f39c12') }};border-radius:8px;font-size:0.75rem;">
                                    {{ $p->stock == 0 ? 'Habis' : $p->stock . ' sisa' }}
                                </span>
                            </div>
                        @empty
                            <div class="text-center py-3" style="color:var(--gray);font-size:0.85rem;">
                                <i class="bi bi-check-circle-fill text-success me-1"></i> Semua stok aman
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const chartLabels = @json($chartLabels);
        const chartOrders = @json($chartOrders);

        new Chart(document.getElementById('chartPesanan'), {
            type: 'bar',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Pesanan',
                    data: chartOrders,
                    backgroundColor: chartOrders.map((v, i) =>
                        i === chartOrders.length - 1
                            ? 'rgba(17,153,158,0.9)'
                            : 'rgba(17,153,158,0.4)'
                    ),
                    borderColor: '#11999E',
                    borderWidth: 2,
                    borderRadius: 10,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#0a2020',
                        titleColor: '#C0EAE2',
                        bodyColor: 'white',
                        padding: 12,
                        cornerRadius: 10,
                        callbacks: {
                            label: ctx => `  ${ctx.parsed.y} pesanan`
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1, color: '#aaa', font: { size: 11 } },
                        grid: { color: 'rgba(0,0,0,0.05)' }
                    },
                    x: {
                        ticks: { color: '#666', font: { size: 11, weight: '600' } },
                        grid: { display: false }
                    }
                }
            }
        });

        setTimeout(() => location.reload(), 60000);
    </script>
</body>

</html>