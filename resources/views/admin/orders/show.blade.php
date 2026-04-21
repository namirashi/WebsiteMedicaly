<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Detail Pesanan {{ $order->order_number }} – Medicaly Admin</title>
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
            max-width: 900px;
        }

        .detail-card {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(17, 153, 158, 0.07);
            border: 1px solid rgba(17, 153, 158, 0.06);
            margin-bottom: 1rem;
        }

        .detail-card-title {
            font-weight: 800;
            font-size: 1rem;
            color: #1a1a2e;
            margin-bottom: 1.2rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.55rem 0;
            border-bottom: 1px solid #f5f5f5;
            font-size: 0.88rem;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            color: var(--gray);
            font-weight: 600;
        }

        .info-val {
            font-weight: 700;
            color: #333;
            text-align: right;
        }

        .badge-status {
            border-radius: 20px;
            padding: 5px 14px;
            font-size: 0.78rem;
            font-weight: 700;
        }

        .item-row {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.8rem 0;
            border-bottom: 1px solid #f5f5f5;
        }

        .item-row:last-child {
            border-bottom: none;
        }

        .item-img {
            width: 52px;
            height: 52px;
            background: linear-gradient(135deg, #f0fafa, #e8f8f6);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            overflow: hidden;
        }

        .item-img img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 4px;
        }

        .item-name {
            font-weight: 700;
            font-size: 0.9rem;
            color: #1a1a2e;
        }

        .item-qty {
            font-size: 0.82rem;
            color: var(--gray);
            margin-top: 2px;
        }

        .item-price {
            font-family: 'Fraunces', serif;
            font-weight: 700;
            color: var(--teal);
            font-size: 0.95rem;
            margin-left: auto;
            white-space: nowrap;
        }

        .timeline {
            display: flex;
            gap: 0;
            margin-bottom: 1.5rem;
        }

        .timeline-step {
            flex: 1;
            text-align: center;
            position: relative;
        }

        .timeline-step::before {
            content: '';
            position: absolute;
            top: 16px;
            left: 50%;
            right: -50%;
            height: 2px;
            background: #eee;
            z-index: 0;
        }

        .timeline-step:last-child::before {
            display: none;
        }

        .timeline-dot {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 6px;
            position: relative;
            z-index: 1;
            font-size: 0.85rem;
        }

        .timeline-dot.done {
            background: var(--teal);
            color: white;
        }

        .timeline-dot.current {
            background: var(--teal-light);
            color: var(--teal);
            border: 2px solid var(--teal);
        }

        .timeline-dot.pending {
            background: #eee;
            color: #aaa;
        }

        .timeline-label {
            font-size: 0.7rem;
            font-weight: 600;
            color: #888;
        }

        .timeline-label.done {
            color: var(--teal);
        }

        .timeline-label.current {
            color: var(--teal);
            font-weight: 800;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--teal-light);
            color: var(--teal);
            border: none;
            border-radius: 10px;
            padding: 0.5rem 1.1rem;
            font-size: 0.88rem;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-back:hover {
            background: var(--teal);
            color: white;
        }

        .select-status {
            border: 2px solid var(--teal-light);
            border-radius: 10px;
            padding: 0.45rem 0.8rem;
            font-size: 0.88rem;
            font-family: inherit;
            outline: none;
            color: var(--teal);
            font-weight: 600;
            cursor: pointer;
        }

        .select-status:focus {
            border-color: var(--teal);
        }

        .btn-update {
            background: var(--teal);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 0.5rem 1.2rem;
            font-size: 0.88rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-update:hover {
            background: var(--teal-dark);
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
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link"><i class="bi bi-grid-fill"></i> Dashboard</a>
            <div class="nav-label">Manajemen</div>
            <a href="{{ route('admin.products.index') }}" class="sidebar-link"><i class="bi bi-box-seam-fill"></i>
                Produk</a>
            <a href="{{ route('admin.orders.index') }}" class="sidebar-link active"><i class="bi bi-bag-fill"></i>
                Pesanan</a>
            <div class="nav-label">Sistem</div>
            <a href="{{ route('admin.monitor') }}" class="sidebar-link"><i class="bi bi-activity"></i> Monitor</a>
            <div class="nav-label">Navigasi</div>
            <a href="{{ route('home') }}" class="sidebar-link" target="_blank"><i class="bi bi-house-fill"></i> Lihat
                Website</a>
        </nav>
        <div class="sidebar-footer">
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
            <div style="display:flex;align-items:center;gap:12px;">
                <a href="{{ route('admin.orders.index') }}" class="btn-back">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <div>
                    <div class="topbar-title">Detail Pesanan</div>
                    <small style="color:var(--gray);">{{ $order->order_number }}</small>
                </div>
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
                <div class="alert alert-success alert-dismissible fade show mb-3"
                    style="border-radius:12px;border:none;background:rgba(46,204,113,0.12);color:#1a7a3f;">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @php
                $steps = ['pending', 'processing', 'shipped', 'delivered'];
                $stepLabels = ['pending' => 'Menunggu', 'processing' => 'Diproses', 'shipped' => 'Dikirim', 'delivered' => 'Selesai'];
                $currentIdx = array_search($order->status, $steps);
                $sc = ['pending' => ['warning', 'Menunggu'], 'processing' => ['info', 'Diproses'], 'shipped' => ['primary', 'Dikirim'], 'delivered' => ['success', 'Selesai'], 'cancelled' => ['danger', 'Dibatalkan']];
                $s = $sc[$order->status] ?? ['secondary', $order->status];
            @endphp

            <!-- TIMELINE STATUS -->
            @if($order->status !== 'cancelled')
                <div class="detail-card">
                    <div class="timeline">
                        @foreach($steps as $idx => $step)
                            @php
                                $isDone = $currentIdx !== false && $idx < $currentIdx;
                                $isCurrent = $order->status === $step;
                            @endphp
                            <div class="timeline-step">
                                <div class="timeline-dot {{ $isDone ? 'done' : ($isCurrent ? 'current' : 'pending') }}">
                                    @if($isDone)
                                        <i class="bi bi-check-lg"></i>
                                    @elseif($isCurrent)
                                        <i class="bi bi-circle-fill" style="font-size:0.5rem;"></i>
                                    @else
                                        <i class="bi bi-circle" style="font-size:0.6rem;"></i>
                                    @endif
                                </div>
                                <div class="timeline-label {{ $isDone ? 'done' : ($isCurrent ? 'current' : '') }}">
                                    {{ $stepLabels[$step] }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="row g-3">
                <!-- KIRI: INFO PESANAN + UPDATE STATUS -->
                <div class="col-md-5">

                    <!-- INFO PESANAN -->
                    <div class="detail-card">
                        <div class="detail-card-title">
                            <i class="bi bi-receipt" style="color:var(--teal);"></i> Info Pesanan
                        </div>
                        <div class="info-row">
                            <span class="info-label">No. Pesanan</span>
                            <span class="info-val"
                                style="font-family:'Fraunces',serif;">{{ $order->order_number }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Status</span>
                            <span class="badge bg-{{ $s[0] }} badge-status">{{ $s[1] }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Tanggal</span>
                            <span class="info-val">{{ $order->created_at->format('d M Y, H:i') }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Pembayaran</span>
                            <span
                                class="info-val">{{ ucwords(str_replace('_', ' ', $order->payment_method ?? '-')) }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Total</span>
                            <span class="info-val"
                                style="color:var(--teal);font-family:'Fraunces',serif;font-size:1rem;">
                                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    <!-- INFO PELANGGAN -->
                    <div class="detail-card">
                        <div class="detail-card-title">
                            <i class="bi bi-person-fill" style="color:var(--teal);"></i> Pelanggan
                        </div>
                        <div class="info-row">
                            <span class="info-label">Nama</span>
                            <span class="info-val">{{ $order->user->name ?? '-' }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Email</span>
                            <span class="info-val" style="font-size:0.82rem;">{{ $order->user->email ?? '-' }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Alamat</span>
                            <span class="info-val" style="font-size:0.82rem;max-width:200px;text-align:right;">
                                {{ $order->shipping_address }}
                            </span>
                        </div>
                    </div>

                    <!-- UPDATE STATUS -->
                    <div class="detail-card">
                        <div class="detail-card-title">
                            <i class="bi bi-arrow-repeat" style="color:var(--teal);"></i> Update Status
                        </div>
                        <form method="POST" action="{{ route('admin.orders.update', $order->id) }}"
                            style="display:flex;gap:8px;align-items:center;">
                            @csrf @method('PUT')
                            <select name="status" class="select-status flex-grow-1">
                                @foreach(['pending' => 'Menunggu', 'processing' => 'Diproses', 'shipped' => 'Dikirim', 'delivered' => 'Selesai', 'cancelled' => 'Dibatalkan'] as $val => $label)
                                    <option value="{{ $val }}" {{ $order->status == $val ? 'selected' : '' }}>{{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn-update">Simpan</button>
                        </form>
                    </div>

                </div>

                <!-- KANAN: DAFTAR PRODUK -->
                <div class="col-md-7">
                    <div class="detail-card" style="height:100%;">
                        <div class="detail-card-title">
                            <i class="bi bi-bag" style="color:var(--teal);"></i>
                            Produk Dipesan
                            <span
                                style="background:var(--teal-light);color:var(--teal);border-radius:20px;padding:2px 10px;font-size:0.72rem;font-weight:700;">
                                {{ $order->items->count() }} item
                            </span>
                        </div>

                        @foreach($order->items as $item)
                            <div class="item-row">
                                <div class="item-img">
                                    @if($item->product && $item->product->image)
                                        <img src="{{ asset('storage/' . $item->product->image) }}"
                                            alt="{{ $item->product->name ?? '' }}">
                                    @else
                                        <i class="bi bi-capsule" style="color:var(--teal);opacity:0.4;font-size:1.3rem;"></i>
                                    @endif
                                </div>
                                <div style="flex:1;min-width:0;">
                                    <div class="item-name">{{ $item->product->name ?? 'Produk dihapus' }}</div>
                                    <div class="item-qty">
                                        {{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </div>
                                </div>
                                <div class="item-price">
                                    Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                </div>
                            </div>
                        @endforeach

                        <!-- TOTAL -->
                        <div style="margin-top:1rem;padding-top:1rem;border-top:2px solid #f0f0f0;">
                            <div
                                style="display:flex;justify-content:space-between;margin-bottom:0.4rem;font-size:0.88rem;">
                                <span style="color:var(--gray);">Subtotal</span>
                                <span>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                            </div>
                            <div
                                style="display:flex;justify-content:space-between;margin-bottom:0.4rem;font-size:0.88rem;">
                                <span style="color:var(--gray);">Pengiriman</span>
                                <span style="color:#2ecc71;font-weight:600;">Gratis</span>
                            </div>
                            <div style="display:flex;justify-content:space-between;margin-top:0.8rem;">
                                <strong>Total Pembayaran</strong>
                                <strong style="font-family:'Fraunces',serif;font-size:1.2rem;color:var(--teal);">
                                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>