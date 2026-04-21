<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manajemen Produk – Medicaly Admin</title>
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

        /* IMPORT */
        .btn-sm-teal {
            margin-top: 15px;
            display: inline-flex;
            align-items: center;
            gap: 6px;

            padding: 6px 14px;
            font-size: 0.85rem;
            font-weight: 500;

            color: #0f766e;
            background: #d1f3f0;
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

        /* === VARIANT: PDF (MERAH SOFT) === */
        .btn-pdf {
            background: #fde2e0;
            color: #c0392b;
            border-color: #f5b7b1;
        }

        .btn-pdf:hover {
            background: #e74c3c;
            color: #fff;
            border-color: #e74c3c;
        }

        .btn-import {
            background: #0f766e;
            color: #ffffff;
            border-color: #0f766e;
        }

        .btn-import:hover {
            background: #115e59;
            border-color: #115e59;
            color: #fff;
        }

        /* TABLE CARD */
        .data-card {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(17, 153, 158, 0.07);
            border: 1px solid rgba(17, 153, 158, 0.06);
        }

        .table thead th {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--gray);
            border: none;
            font-weight: 700;
            padding: 0.6rem 0.75rem;
            background: #fafafa;
        }

        .table tbody td {
            font-size: 0.88rem;
            padding: 0.8rem 0.75rem;
            vertical-align: middle;
            border-color: #f0f0f0;
        }

        .table tbody tr:hover td {
            background: #f8fdfd;
        }

        /* BUTTONS */
        .btn-teal {
            background: var(--teal);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 0.55rem 1.2rem;
            font-weight: 600;
            font-size: 0.88rem;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            cursor: pointer;
        }

        .btn-teal:hover {
            background: var(--teal-dark);
            color: white;
            transform: translateY(-1px);
        }

        .btn-edit {
            background: #e8f8f6;
            color: var(--teal);
            border: none;
            border-radius: 8px;
            padding: 0.35rem 0.75rem;
            font-size: 0.8rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: all 0.2s;
        }

        .btn-edit:hover {
            background: var(--teal);
            color: white;
        }

        .btn-del {
            background: rgba(255, 93, 83, 0.1);
            color: var(--danger);
            border: none;
            border-radius: 8px;
            padding: 0.35rem 0.75rem;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: all 0.2s;
        }

        .btn-del:hover {
            background: var(--danger);
            color: white;
        }

        /* SEARCH */
        .search-input {
            border: 2px solid #eef2f2;
            border-radius: 10px;
            padding: 0.5rem 1rem;
            font-size: 0.88rem;
            font-family: inherit;
            outline: none;
            width: 220px;
            transition: border 0.2s;
        }

        .search-input:focus {
            border-color: var(--teal);
        }

        /* BADGES */
        .badge-aktif {
            background: rgba(17, 153, 158, 0.12);
            color: var(--teal);
            border-radius: 20px;
            padding: 3px 10px;
            font-size: 0.73rem;
            font-weight: 700;
        }

        .badge-nonaktif {
            background: rgba(171, 171, 171, 0.2);
            color: var(--gray);
            border-radius: 20px;
            padding: 3px 10px;
            font-size: 0.73rem;
            font-weight: 700;
        }

        .badge-stok {
            border-radius: 8px;
            padding: 3px 10px;
            font-size: 0.75rem;
            font-weight: 700;
        }

        /* ALERT */
        .alert {
            border-radius: 12px;
            border: none;
            font-size: 0.88rem;
        }

        /* PAGINATION */
        .page-link {
            color: var(--teal);
            border-radius: 8px !important;
            border: none;
            margin: 0 2px;
        }

        .page-item.active .page-link {
            background: var(--teal);
            border-color: var(--teal);
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
            <a href="{{ route('admin.products.index') }}" class="sidebar-link active">
                <i class="bi bi-box-seam-fill"></i> Produk
            </a>
            <a href="{{ route('admin.orders.index') }}" class="sidebar-link">
                <i class="bi bi-bag-fill"></i> Pesanan
                @php $pendingCount = \App\Models\Order::where('status', 'pending')->count(); @endphp
                @if($pendingCount > 0)
                    <span
                        style="background:var(--danger);color:white;border-radius:20px;padding:1px 8px;font-size:0.7rem;font-weight:700;margin-left:auto;">{{ $pendingCount }}</span>
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
                <div class="topbar-title">Manajemen Produk</div>
                <small style="color:var(--gray);">Kelola semua produk apotek</small>
            </div>
            <a href="{{ route('admin.products.create') }}" class="btn-teal">
                <i class="bi bi-plus-circle-fill"></i> Tambah Produk
            </a>
        </div>
        <div class="d-flex justify-content-end gap-2 mb-3">
            <a href="{{ route('admin.products.lowStockSp') }}" class="btn-sm-teal">
                <i class="bi bi-exclamation-triangle"></i> Stok Menipis
            </a>

            <a href="{{ route('admin.import.products') }}" class="btn-sm-teal btn-import">
                <i class="bi bi-upload"></i> Import CSV
            </a>
            <a href="{{ route('admin.export.products.excel') }}" class="btn-sm-teal">
                <i class="bi bi-file-earmark-spreadsheet"></i> Export Excel
            </a>
            <a href="{{ route('admin.export.products.pdf') }}" class="btn-sm-teal btn-pdf">
                <i class="bi bi-file-earmark-pdf"></i> Export PDF
            </a>

        </div>

        <div class="page-content">

            @if(session('success'))
                <div class="alert alert-dismissible fade show mb-3" style="background:rgba(46,204,113,0.12);color:#1a7a3f;">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-dismissible fade show mb-3" style="background:rgba(255,93,83,0.1);color:#c0392b;">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                    <button class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="data-card">
                <!-- HEADER & SEARCH -->
                <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
                    <div>
                        <span style="font-weight:800;font-size:1rem;">Daftar Produk</span>
                        <span
                            style="background:var(--teal-light);color:var(--teal);border-radius:20px;padding:2px 10px;font-size:0.75rem;font-weight:700;margin-left:8px;">
                            {{ $products->total() }} produk
                        </span>
                    </div>
                    <form action="{{ route('admin.products.index') }}" method="GET" class="d-flex gap-2">
                        <input type="text" name="search" class="search-input" placeholder="🔍 Cari produk..."
                            value="{{ request('search') }}">
                        <button type="submit" class="btn-teal" style="padding:0.5rem 1rem;">Cari</button>
                        @if(request('search'))
                            <a href="{{ route('admin.products.index') }}" class="btn-edit">Reset</a>
                        @endif
                    </form>
                </div>

                <!-- TABLE -->
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Status</th>
                                <th style="text-align:center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td style="color:var(--gray);font-weight:600;">
                                        {{ $products->firstItem() + $loop->index }}
                                    </td>
                                    <td>
                                        <div style="display:flex;align-items:center;gap:10px;">
                                            <div
                                                style="width:42px;height:42px;background:linear-gradient(135deg,#f0fafa,#e8f8f6);border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                                @if($product->image)
                                                    <img src="{{ asset('storage/' . $product->image) }}"
                                                        style="height:36px;object-fit:contain;" alt="">
                                                @else
                                                    <i class="bi bi-capsule" style="color:var(--teal);opacity:0.5;"></i>
                                                @endif
                                            </div>
                                            <div>
                                                <div style="font-weight:700;font-size:0.88rem;color:#1a1a2e;">
                                                    {{ $product->name }}
                                                </div>
                                                <div style="font-size:0.75rem;color:var(--gray);">{{ $product->unit }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span
                                            style="background:#f0f0f0;border-radius:6px;padding:3px 8px;font-size:0.78rem;font-weight:600;color:#555;">
                                            {{ $product->category->name ?? '—' }}
                                        </span>
                                    </td>
                                    <td
                                        style="font-weight:700;color:var(--teal);font-family:'Fraunces',serif;font-size:0.95rem;">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </td>
                                    <td>
                                        @if($product->stock == 0)
                                            <span class="badge-stok"
                                                style="background:rgba(255,93,83,0.15);color:var(--danger);">Habis</span>
                                        @elseif($product->stock < 5)
                                            <span class="badge-stok"
                                                style="background:rgba(230,126,34,0.15);color:#e67e22;">{{ $product->stock }}
                                                (Kritis)</span>
                                        @elseif($product->stock < 20)
                                            <span class="badge-stok"
                                                style="background:rgba(243,156,18,0.15);color:#f39c12;">{{ $product->stock }}
                                                (Rendah)</span>
                                        @else
                                            <span class="badge-stok"
                                                style="background:rgba(46,204,113,0.12);color:#2ecc71;">{{ $product->stock }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($product->is_active)
                                            <span class="badge-aktif">Aktif</span>
                                        @else
                                            <span class="badge-nonaktif">Nonaktif</span>
                                        @endif
                                    </td>
                                    <td style="text-align:center;">
                                        <div style="display:flex;gap:6px;justify-content:center;">
                                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn-edit">
                                                <i class="bi bi-pencil-fill"></i> Edit
                                            </a>
                                            <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}"
                                                onsubmit="return confirm('Yakin hapus produk \'{{ addslashes($product->name) }}\'?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-del">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <i class="bi bi-box-seam"
                                            style="font-size:3rem;color:var(--gray);opacity:0.5;display:block;margin-bottom:10px;"></i>
                                        <span style="color:var(--gray);">
                                            @if(request('search'))
                                                Produk "{{ request('search') }}" tidak ditemukan.
                                            @else
                                                Belum ada produk. Klik "Tambah Produk" untuk memulai.
                                            @endif
                                        </span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- PAGINATION -->
                @if($products->hasPages())
                    <div class="mt-4 d-flex justify-content-center">
                        {{ $products->withQueryString()->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>