<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Monitor Sistem – Medicaly Admin</title>
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

        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            margin-bottom: 0.8rem;
        }

        .sidebar-avatar {
            width: 34px;
            height: 34px;
            background: var(--teal);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.8rem;
            color: white;
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

        /* CARDS */
        .monitor-card {
            background: white;
            border-radius: 16px;
            padding: 1.4rem;
            box-shadow: 0 4px 20px rgba(17, 153, 158, 0.07);
            border: 1px solid rgba(17, 153, 158, 0.06);
            height: 100%;
        }

        .monitor-card-title {
            font-weight: 800;
            font-size: 0.95rem;
            color: #1a1a2e;
            margin-bottom: 1.2rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* STATUS ROW */
        .status-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.6rem 0;
            border-bottom: 1px solid #f5f5f5;
        }

        .status-row:last-child {
            border-bottom: none;
        }

        .status-label {
            font-size: 0.85rem;
            color: #555;
        }

        .status-val {
            font-weight: 700;
            font-size: 0.88rem;
        }

        /* RESOURCE BAR */
        .resource-item {
            margin-bottom: 1.2rem;
        }

        .resource-item:last-child {
            margin-bottom: 0;
        }

        .resource-label {
            display: flex;
            justify-content: space-between;
            font-size: 0.83rem;
            margin-bottom: 5px;
        }

        .resource-bar {
            height: 8px;
            border-radius: 4px;
            background: #eef2f2;
            overflow: hidden;
        }

        .resource-fill {
            height: 100%;
            border-radius: 4px;
            transition: width 1s ease;
        }

        /* STAT MINI */
        .stat-mini {
            background: #f8fdfd;
            border-radius: 12px;
            padding: 0.8rem 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.6rem;
        }

        .stat-mini:last-child {
            margin-bottom: 0;
        }

        .stat-mini-label {
            font-size: 0.83rem;
            color: #555;
        }

        .stat-mini-val {
            font-weight: 800;
            font-size: 1rem;
        }

        /* LOG */
        .log-item {
            border-radius: 10px;
            padding: 0.65rem 1rem;
            margin-bottom: 0.5rem;
            font-size: 0.83rem;
        }

        .log-item:last-child {
            margin-bottom: 0;
        }

        .log-info {
            background: #f0fafa;
        }

        .log-warning {
            background: #fffbf0;
        }

        .log-error {
            background: #fff5f5;
        }

        /* ONLINE DOT */
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
            width: 10px;
            height: 10px;
            background: #2ecc71;
            border-radius: 50%;
            display: inline-block;
            animation: pulse 1.5s infinite;
        }

        /* ALERT */
        .alert {
            border-radius: 12px;
            border: none;
            font-size: 0.88rem;
        }

        /* AUTO REFRESH TIMER */
        #refresh-bar {
            height: 3px;
            background: var(--teal);
            width: 100%;
            transition: width linear;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 999;
        }
    </style>
</head>

<body>

    <div id="refresh-bar"></div>

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
            <a href="{{ route('admin.orders.index') }}" class="sidebar-link">
                <i class="bi bi-bag-fill"></i> Pesanan
            </a>
            <div class="nav-label">Sistem</div>
            <a href="{{ route('admin.monitor') }}" class="sidebar-link active">
                <i class="bi bi-activity"></i> Monitor
                <span class="dot-online ms-auto"></span>
            </a>
            <div class="nav-label">Navigasi</div>
            <a href="{{ route('home') }}" class="sidebar-link" target="_blank">
                <i class="bi bi-house-fill"></i> Lihat Website
            </a>
        </nav>
        <div class="sidebar-footer">
            <div class="sidebar-user">
                <div class="sidebar-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
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
                <div class="topbar-title"><i class="bi bi-activity me-2" style="color:var(--teal);"></i>Monitor Sistem
                </div>
                <small style="color:var(--gray);">
                    Auto-refresh setiap 30 detik &nbsp;•&nbsp; <span id="live-clock">{{ now()->format('H:i:s') }}</span>
                </small>
            </div>
            <div style="display:flex;align-items:center;gap:10px;">
                <span style="font-size:0.8rem;color:var(--gray);">
                    <span class="dot-online" style="width:8px;height:8px;"></span> Sistem Online
                </span>
                <button onclick="location.reload()"
                    style="background:var(--teal-light);color:var(--teal);border:none;border-radius:8px;padding:0.4rem 0.9rem;font-size:0.82rem;font-weight:600;cursor:pointer;">
                    <i class="bi bi-arrow-clockwise me-1"></i>Refresh
                </button>
            </div>
        </div>

        <div class="page-content">

            @php
                // Hitung resource
                $memUsed = memory_get_usage(true) / 1024 / 1024;
                $memPeak = memory_get_peak_usage(true) / 1024 / 1024;
                $memLimit = 128; // MB (default PHP)
                $memPct = min(100, round(($memUsed / $memLimit) * 100));
                $diskTotal = disk_total_space('/') / (1024 * 1024 * 1024);
                $diskFree = disk_free_space('/') / (1024 * 1024 * 1024);
                $diskUsed = $diskTotal - $diskFree;
                $diskPct = min(100, round(($diskUsed / $diskTotal) * 100));

                // DB check
                try {
                    \DB::connection()->getPdo();
                    $dbOk = true;
                } catch (\Exception $e) {
                    $dbOk = false;
                }

                // Stats
                $lowStock = \App\Models\Product::where('stock', '<', 5)->where('is_active', true)->count();
                $pendingOrders = \App\Models\Order::where('status', 'pending')->count();
            @endphp

            {{-- ALERT --}}
            @if($lowStock > 0 || $pendingOrders > 5)
                <div class="alert mb-3 d-flex align-items-start gap-2"
                    style="background:rgba(243,156,18,0.12);color:#b7770d;">
                    <i class="bi bi-exclamation-triangle-fill fs-5 mt-1"></i>
                    <div>
                        <strong>Peringatan Sistem:</strong>
                        @if($lowStock > 0)
                            <div>• <strong>{{ $lowStock }} produk</strong> memiliki stok kritis (&lt;5) →
                                <a href="{{ route('admin.products.index') }}" style="color:inherit;font-weight:700;">Kelola
                                    Produk</a>
                            </div>
                        @endif
                        @if($pendingOrders > 5)
                            <div>• <strong>{{ $pendingOrders }} pesanan</strong> menunggu konfirmasi →
                                <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}"
                                    style="color:inherit;font-weight:700;">Lihat Pesanan</a>
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <div class="alert mb-3 d-flex align-items-center gap-2"
                    style="background:rgba(46,204,113,0.1);color:#1a7a3f;">
                    <i class="bi bi-check-circle-fill fs-5"></i>
                    <span>Semua sistem berjalan normal. Tidak ada peringatan saat ini.</span>
                </div>
            @endif

            <!-- ROW 1: STATUS + RESOURCE + STATS -->
            <div class="row g-3 mb-3">

                <!-- STATUS SISTEM -->
                <div class="col-md-4">
                    <div class="monitor-card">
                        <div class="monitor-card-title">
                            <i class="bi bi-server" style="color:var(--teal);"></i> Status Sistem
                        </div>
                        <div class="status-row">
                            <span class="status-label">Server</span>
                            <span class="status-val" style="color:#2ecc71;">
                                <span class="dot-online" style="width:8px;height:8px;margin-right:5px;"></span>Online
                            </span>
                        </div>
                        <div class="status-row">
                            <span class="status-label">Database MySQL</span>
                            <span class="status-val" style="color:{{ $dbOk ? '#2ecc71' : 'var(--danger)' }};">
                                {{ $dbOk ? '✓ Terhubung' : '✗ Error' }}
                            </span>
                        </div>
                        <div class="status-row">
                            <span class="status-label">Laravel</span>
                            <span class="status-val">v{{ app()->version() }}</span>
                        </div>
                        <div class="status-row">
                            <span class="status-label">PHP</span>
                            <span class="status-val">v{{ PHP_VERSION }}</span>
                        </div>
                        <div class="status-row">
                            <span class="status-label">Environment</span>
                            <span class="status-val"
                                style="text-transform:capitalize;">{{ app()->environment() }}</span>
                        </div>
                        <div class="status-row">
                            <span class="status-label">Debug Mode</span>
                            <span class="status-val" style="color:{{ config('app.debug') ? 'orange' : '#2ecc71' }};">
                                {{ config('app.debug') ? 'Aktif (Dev)' : 'Nonaktif' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- RESOURCE USAGE -->
                <div class="col-md-4">
                    <div class="monitor-card">
                        <div class="monitor-card-title">
                            <i class="bi bi-cpu-fill" style="color:#3498db;"></i> Penggunaan Resource
                        </div>
                        <div class="resource-item">
                            <div class="resource-label">
                                <span style="font-weight:600;">Memory PHP</span>
                                <span
                                    style="color:{{ $memPct > 80 ? 'var(--danger)' : 'var(--teal)' }};font-weight:700;">
                                    {{ number_format($memUsed, 1) }} MB / {{ $memLimit }} MB
                                </span>
                            </div>
                            <div class="resource-bar">
                                <div class="resource-fill"
                                    style="width:{{ $memPct }}%;background:{{ $memPct > 80 ? 'var(--danger)' : ($memPct > 60 ? 'orange' : 'var(--teal)') }};">
                                </div>
                            </div>
                            <div style="font-size:0.75rem;color:var(--gray);margin-top:3px;">{{ $memPct }}% terpakai
                            </div>
                        </div>
                        <div class="resource-item">
                            <div class="resource-label">
                                <span style="font-weight:600;">Disk Storage</span>
                                <span style="color:{{ $diskPct > 80 ? 'var(--danger)' : '#3498db' }};font-weight:700;">
                                    {{ number_format($diskUsed, 1) }} / {{ number_format($diskTotal, 1) }} GB
                                </span>
                            </div>
                            <div class="resource-bar">
                                <div class="resource-fill"
                                    style="width:{{ $diskPct }}%;background:{{ $diskPct > 80 ? 'var(--danger)' : ($diskPct > 60 ? 'orange' : '#3498db') }};">
                                </div>
                            </div>
                            <div style="font-size:0.75rem;color:var(--gray);margin-top:3px;">{{ $diskPct }}% terpakai •
                                {{ number_format($diskFree, 1) }} GB tersedia
                            </div>
                        </div>
                        <div class="resource-item">
                            <div class="resource-label">
                                <span style="font-weight:600;">Peak Memory</span>
                                <span style="font-weight:700;">{{ number_format($memPeak, 1) }} MB</span>
                            </div>
                            <div class="resource-bar">
                                <div class="resource-fill"
                                    style="width:{{ min(100, round(($memPeak / $memLimit) * 100)) }}%;background:#9b59b6;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- STATISTIK APLIKASI -->
                <div class="col-md-4">
                    <div class="monitor-card">
                        <div class="monitor-card-title">
                            <i class="bi bi-bar-chart-fill" style="color:#f39c12;"></i> Statistik Aplikasi
                        </div>
                        <div class="stat-mini">
                            <span class="stat-mini-label"><i class="bi bi-people-fill me-1"
                                    style="color:#3498db;"></i>Total Pengguna</span>
                            <span class="stat-mini-val" style="color:#3498db;">{{ \App\Models\User::count() }}</span>
                        </div>
                        <div class="stat-mini">
                            <span class="stat-mini-label"><i class="bi bi-box-seam-fill me-1"
                                    style="color:var(--teal);"></i>Total Produk</span>
                            <span class="stat-mini-val"
                                style="color:var(--teal);">{{ \App\Models\Product::count() }}</span>
                        </div>
                        <div class="stat-mini">
                            <span class="stat-mini-label"><i class="bi bi-bag-fill me-1"
                                    style="color:#9b59b6;"></i>Pesanan Hari Ini</span>
                            <span class="stat-mini-val"
                                style="color:#9b59b6;">{{ \App\Models\Order::whereDate('created_at', today())->count() }}</span>
                        </div>
                        <div class="stat-mini">
                            <span class="stat-mini-label"><i class="bi bi-exclamation-circle-fill me-1"
                                    style="color:var(--danger);"></i>Stok Habis</span>
                            <span class="stat-mini-val"
                                style="color:var(--danger);">{{ \App\Models\Product::where('stock', 0)->count() }}</span>
                        </div>
                        <div class="stat-mini">
                            <span class="stat-mini-label"><i class="bi bi-journal-text me-1"
                                    style="color:#888;"></i>Total Log</span>
                            <span class="stat-mini-val">{{ \App\Models\SystemLog::count() }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ROW 2: SYSTEM LOGS -->
            <div class="monitor-card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="monitor-card-title mb-0">
                        <i class="bi bi-journal-code" style="color:#888;"></i> Log Sistem Terbaru
                    </div>
                    <small style="color:var(--gray);">
                        <i class="bi bi-arrow-clockwise me-1"></i>Auto-refresh 30 detik
                    </small>
                </div>

                @forelse(\App\Models\SystemLog::latest()->take(20)->get() as $log)
                    @php
                        $logClass = ['info' => 'log-info', 'warning' => 'log-warning', 'error' => 'log-error'][$log->level] ?? 'log-info';
                        $logColor = ['info' => 'var(--teal)', 'warning' => '#e67e22', 'error' => 'var(--danger)'][$log->level] ?? 'var(--teal)';
                        $logIcon = ['info' => 'bi-info-circle-fill', 'warning' => 'bi-exclamation-triangle-fill', 'error' => 'bi-x-circle-fill'][$log->level] ?? 'bi-info-circle-fill';
                    @endphp
                    <div class="log-item {{ $logClass }}">
                        <div class="d-flex justify-content-between align-items-start">
                            <div style="display:flex;align-items:flex-start;gap:8px;">
                                <i class="bi {{ $logIcon }}"
                                    style="color:{{ $logColor }};margin-top:1px;flex-shrink:0;"></i>
                                <div>
                                    <span class="badge"
                                        style="background:{{ $logColor }};border-radius:6px;font-size:0.68rem;padding:2px 7px;margin-right:6px;">{{ strtoupper($log->level) }}</span>
                                    {{ $log->message }}
                                    @if($log->ip_address)
                                        <span style="color:#aaa;font-size:0.78rem;margin-left:8px;">• IP:
                                            {{ $log->ip_address }}</span>
                                    @endif
                                </div>
                            </div>
                            <small style="color:#aaa;white-space:nowrap;margin-left:1rem;flex-shrink:0;">
                                {{ $log->created_at->diffForHumans() }}
                            </small>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-4" style="color:var(--gray);">
                        <i class="bi bi-journal-x"
                            style="font-size:2.5rem;display:block;margin-bottom:8px;opacity:0.4;"></i>
                        Belum ada log sistem.
                    </div>
                @endforelse
            </div>

        </div><!-- /page-content -->
    </div><!-- /main-wrapper -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Progress bar auto-refresh 30 detik
        function updateClock() {
            const now = new Date();
            const jam = String(now.getHours()).padStart(2, '0');
            const menit = String(now.getMinutes()).padStart(2, '0');
            const detik = String(now.getSeconds()).padStart(2, '0');
            document.getElementById('live-clock').textContent = `${jam}:${menit}:${detik}`;
        }
        updateClock();
        setInterval(updateClock, 1000);
    </script>
</body>

</html>