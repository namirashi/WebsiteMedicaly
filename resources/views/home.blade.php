@extends('layouts.app')
@section('title', 'Beranda')

@push('styles')
    <style>
        .hero-section {
            background: linear-gradient(135deg, #11999E 0%, #FF5D53 30%, #0d7a7e 60%, #0a5f62 100%);
            border-radius: 0 0 40px 40px;
            padding: 5rem 0 6rem;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -80px;
            right: -80px;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }

        .hero-section::after {
            content: '';
            position: absolute;
            bottom: -60px;
            left: -60px;
            width: 300px;
            height: 300px;
            background: rgba(192, 234, 226, 0.15);
            border-radius: 50%;
        }

        .hero-title {
            font-family: 'Bungee Inline', sans-serif;
            font-size: 3.2rem;
            font-weight: 400;
            color: white;
            line-height: 1.15;
            margin-bottom: 1.2rem;
        }

        .hero-title span {
            color: #C0EAE2;
        }

        .hero-subtitle {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.05rem;
            margin-bottom: 2rem;
        }

        .hero-search {
            background: white;
            border-radius: 16px;
            padding: 0.5rem;
            display: flex;
            align-items: center;
            max-width: 480px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
        }

        .hero-search input {
            border: none;
            outline: none;
            padding: 0.5rem 1rem;
            flex: 1;
            font-size: 0.95rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .hero-search button {
            background: var(--teal);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .hero-img-wrap {
            position: relative;
            z-index: 1;
        }

        .hero-img-wrap img {
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
            width: 100%;
            max-width: 420px;
        }

        .stats-card {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 4px 24px rgba(17, 153, 158, 0.08);
            border: 1px solid rgba(17, 153, 158, 0.1);
            transition: transform 0.2s;
        }

        .stats-card:hover {
            transform: translateY(-3px);
        }

        .stats-num {
            font-family: 'Plus Jakarta Sans', serif;
            font-size: 2.2rem;
            font-weight: 900;
            color: #FF5D53;
        }

        .stats-label {
            font-size: 0.85rem;
            color: var(--gray);
            margin-top: 0.2rem;
        }

        .section-title {
            font-family: 'FraPlus Jakarta Sansunces', serif;
            font-size: 2rem;
            font-weight: 900;
            color: #1a1a2e;
        }

        .section-subtitle {
            color: var(--gray);
            font-size: 0.95rem;
        }

        .category-chip {
            background: white;
            border: 2px solid var(--teal-light);
            border-radius: 50px;
            padding: 0.5rem 1.2rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
            font-size: 0.88rem;
            color: #444;
            text-decoration: none;
            transition: all 0.2s;
        }

        .category-chip:hover {
            background: var(--teal);
            border-color: var(--teal);
            color: white;
        }

        .category-chip i {
            color: var(--teal);
            font-size: 1rem;
        }

        .category-chip:hover i {
            color: white;
        }

        .product-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(17, 153, 158, 0.08);
            transition: all 0.3s;
            border: 1px solid rgba(17, 153, 158, 0.08);
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 40px rgba(17, 153, 158, 0.18);
        }

        .product-img-wrap {
            background: linear-gradient(135deg, #ffffff, #ffffff);
            width: 100%;
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .product-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            display: block;
        }

        .product-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            background: var(--danger);
            color: white;
            border-radius: 6px;
            padding: 2px 8px;
            font-size: 0.72rem;
            font-weight: 700;
        }

        .product-body {
            padding: 1rem 1.2rem 1.2rem;
        }

        .product-name {
            font-weight: 700;
            font-size: 0.95rem;
            color: #1a1a2e;
            margin-bottom: 0.2rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .product-unit {
            font-size: 0.8rem;
            color: var(--gray);
            margin-bottom: 0.6rem;
        }

        .product-price {
            font-family: 'Plus Jakarta Sans', serif;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--teal);
        }

        .product-rating {
            font-size: 0.8rem;
            color: #f39c12;
        }

        .btn-add-cart {
            background: var(--teal);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 0.5rem 1rem;
            font-weight: 600;
            font-size: 0.85rem;
            width: 100%;
            margin-top: 0.8rem;
            transition: all 0.2s;
            cursor: pointer;
        }

        .btn-add-cart:hover {
            background: var(--teal-dark);
        }

        .feature-icon {
            width: 56px;
            height: 56px;
            background: var(--teal-light);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .feature-icon i {
            font-size: 1.5rem;
            color: #FF5D53;
        }

        .cta-section {
            background: linear-gradient(135deg, var(--teal), #FF5D53, var(--teal-dark));
            border-radius: 24px;
            padding: 3rem;
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            top: -40px;
            right: -40px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.07);
            border-radius: 50%;
        }
    </style>
@endpush

@section('content')
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6" style="position:relative;z-index:1;">
                    <div class="d-inline-flex align-items-center gap-2 px-3 py-1 mb-3"
                        style="background:rgba(255,255,255,0.15);border-radius:50px;">
                        <span class="notif-dot" style="background:#C0EAE2;"></span>
                        <small style="color:rgba(255,255,255,0.9);font-weight:600;font-size:0.82rem;">Apotek Online
                            Terpercaya #1</small>
                    </div>
                    <h1 class="hero-title">Kesehatan Anda,<br><span>Prioritas Kami</span></h1>
                    <p class="hero-subtitle">Temukan ribuan produk kesehatan berkualitas dengan pengiriman cepat langsung ke
                        rumah Anda.</p>
                    <form action="{{ route('products.index') }}" method="GET" class="hero-search">
                        <i class="bi bi-search ms-2 text-muted"></i>
                        <input type="text" name="search" placeholder="Cari vitamin, obat, suplemen...">
                        <button type="submit">Cari</button>
                    </form>
                    <div class="d-flex gap-3 mt-3">
                        <small style="color:rgba(255,255,255,0.7);font-size:0.8rem;"><i class="bi bi-check-circle-fill me-1"
                                style="color:#C0EAE2;"></i>BPOM Terdaftar</small>
                        <small style="color:rgba(255,255,255,0.7);font-size:0.8rem;"><i class="bi bi-check-circle-fill me-1"
                                style="color:#C0EAE2;"></i>Pengiriman 24 Jam</small>
                        <small style="color:rgba(255,255,255,0.7);font-size:0.8rem;"><i class="bi bi-check-circle-fill me-1"
                                style="color:#C0EAE2;"></i>100% Asli</small>
                    </div>
                </div>
                <div class="col-lg-6 text-center hero-img-wrap d-none d-lg-block">
                    <div style="position:relative;display:inline-block;">
                        <div
                            style="width:340px;height:340px;background:rgba(255,255,255,0.12);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:auto;">
                            <img src="{{ asset('images/logo_medicaly.png') }}" alt="Medicaly Logo"
                                style="width:220px;height:220px;object-fit:contain;drop-shadow(0 8px 24px rgba(0,0,0,0.2));">
                        </div>
                        <div
                            style="position:absolute;top:20px;right:-20px;background:white;border-radius:16px;padding:0.8rem 1rem;box-shadow:0 8px 24px rgba(0,0,0,0.15);">
                            <div style="font-family:'Fraunces',serif;font-size:1.4rem;font-weight:900;color:var(--red);">5K+
                            </div>
                            <div style="font-size:0.75rem;color:#888;">Produk</div>
                        </div>
                        <div
                            style="position:absolute;bottom:30px;left:-35px;background:white;border-radius:16px;padding:0.8rem 1rem;box-shadow:0 8px 24px rgba(0,0,0,0.15);">
                            <div style="font-family:'Fraunces',serif;font-size:1.4rem;font-weight:900;color:var(--teal);">
                                10K+</div>
                            <div style="font-size:0.75rem;color:#888;">Pelanggan</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- STATS -->
    <div class="container" style="margin-top:-2rem;position:relative;z-index:10;">
        <div class="row g-3">
            <div class="col-6 col-md-3">
                <div class="stats-card">
                    <div class="stats-num">5K+</div>
                    <div class="stats-label"><i class="bi bi-box-seam text-success me-1"></i>Produk Tersedia</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stats-card">
                    <div class="stats-num">10K+</div>
                    <div class="stats-label"><i class="bi bi-people text-primary me-1"></i>Pelanggan</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stats-card">
                    <div class="stats-num">24/7</div>
                    <div class="stats-label"><i class="bi bi-clock text-warning me-1"></i>Layanan Online</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stats-card">
                    <div class="stats-num">4.9</div>
                    <div class="stats-label"><i class="bi bi-star-fill text-warning me-1"></i>Rating Pengguna</div>
                </div>
            </div>
        </div>
    </div>

    <!-- KATEGORI -->
    <section class="container mt-5">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <div class="section-title">Kategori Produk</div>
                <div class="section-subtitle">Temukan produk sesuai kebutuhanmu</div>
            </div>
            <a href="{{ route('products.index') }}" class="btn btn-outline-teal">Lihat Semua</a>
        </div>
        <div class="d-flex flex-wrap gap-2">
            @forelse($categories as $cat)
                <a href="{{ route('products.index', ['category' => $cat->id]) }}" class="category-chip">
                    <i class="bi bi-grid-fill"></i> {{ $cat->name }}
                </a>
            @empty
                <a href="{{ route('products.index') }}" class="category-chip"><i class="bi bi-capsule"></i> Vitamin</a>
                <a href="{{ route('products.index') }}" class="category-chip"><i class="bi bi-heart-pulse"></i> Suplemen</a>
                <a href="{{ route('products.index') }}" class="category-chip"><i class="bi bi-activity"></i> Obat</a>
                <a href="{{ route('products.index') }}" class="category-chip"><i class="bi bi-bandaid"></i> Perawatan</a>
            @endforelse
        </div>
    </section>

    <!-- PRODUK UNGGULAN -->
    <section class="container mt-5">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <div class="section-title">Produk Unggulan</div>
                <div class="section-subtitle">Pilihan terbaik untuk kesehatan Anda</div>
            </div>
            <a href="{{ route('products.index') }}" class="btn btn-outline-teal">Lihat Semua</a>
        </div>
        <div class="row g-3">
            @forelse($featured as $product)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="product-card">
                        <a href="{{ route('products.show', $product->slug) }}" style="text-decoration:none;">
                            <div class="product-img-wrap">
                                @if($product->stock < 5) <span class="product-badge">Stok Terbatas</span> @endif
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                @else
                                    <i class="bi bi-capsule" style="font-size:4rem;color:var(--teal);opacity:0.4;"></i>
                                @endif
                            </div>
                        </a>
                        <div class="product-body">
                            <div class="product-name">{{ $product->name }}</div>
                            <div class="product-unit">{{ $product->unit }}</div>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                                <div class="product-rating">
                                    ★ {{ number_format($product->averageRating() ?? 0, 1) }}
                                </div>
                            </div>
                            @auth
                                <button class="btn-add-cart" onclick="addToCart({{ $product->id }})">
                                    <i class="bi bi-bag-plus me-1"></i>Tambah
                                </button>
                            @else
                                <a href="{{ route('login') }}" class="btn-add-cart d-block text-center"
                                    style="text-decoration:none;">
                                    <i class="bi bi-bag-plus me-1"></i>Tambah
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-box-seam" style="font-size:3rem;color:var(--gray);"></i>
                    <p class="text-muted mt-2">Belum ada produk tersedia.</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- FITUR -->
    <section class="container mt-6 py-5">
        <div class="text-center mb-5">
            <div class="section-title">Mengapa Memilih Medicaly?</div>
            <div class="section-subtitle mt-1">Kami berkomitmen memberikan pengalaman belanja terbaik</div>
        </div>
        <div class="row g-4">
            <div class="col-md-3 col-6 text-center">
                <div class="feature-icon mx-auto"><i class="bi bi-patch-check-fill"></i></div>
                <h6 class="fw-700 mb-1" style="font-weight:700;">100% Produk Asli</h6>
                <p class="text-muted small">Semua produk bergaransi keaslian dari distributor resmi</p>
            </div>
            <div class="col-md-3 col-6 text-center">
                <div class="feature-icon mx-auto"><i class="bi bi-truck"></i></div>
                <h6 class="fw-700 mb-1" style="font-weight:700;">Pengiriman Cepat</h6>
                <p class="text-muted small">Tiba dalam 1-3 hari ke seluruh Indonesia</p>
            </div>
            <div class="col-md-3 col-6 text-center">
                <div class="feature-icon mx-auto"><i class="bi bi-shield-lock-fill"></i></div>
                <h6 class="fw-700 mb-1" style="font-weight:700;">Transaksi Aman</h6>
                <p class="text-muted small">Pembayaran terlindungi dengan enkripsi SSL</p>
            </div>
            <div class="col-md-3 col-6 text-center">
                <div class="feature-icon mx-auto"><i class="bi bi-headset"></i></div>
                <h6 class="fw-700 mb-1" style="font-weight:700;">Support 24/7</h6>
                <p class="text-muted small">Tim apoteker siap membantu kapan saja</p>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <div class="container mb-5">
        <div class="cta-section">
            <h2 style="font-family:'Fraunces',serif;font-weight:900;font-size:2rem;color:white;">Mulai Belanja Sekarang</h2>
            <p style="color:rgba(255,255,255,0.8);">Daftar gratis dan dapatkan voucher diskon untuk pembelian pertama Anda
            </p>
            @guest
                <a href="{{ route('register') }}" class="btn"
                    style="background:white;color:var(--teal);border-radius:12px;padding:0.8rem 2rem;font-weight:700;">
                    Daftar Gratis <i class="bi bi-arrow-right ms-1"></i>
                </a>
            @else
                <a href="{{ route('products.index') }}" class="btn"
                    style="background:white;color:var(--teal);border-radius:12px;padding:0.8rem 2rem;font-weight:700;">
                    Belanja Sekarang <i class="bi bi-arrow-right ms-1"></i>
                </a>
            @endguest
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function addToCart(productId) {
            fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                },
                body: JSON.stringify({ product_id: productId, quantity: 1 })
            })
                .then(r => r.json())
                .then(data => {
                    showToast(data.message || 'Produk ditambahkan!');
                    const badge = document.querySelector('.cart-badge');
                    if (badge && data.count) badge.textContent = data.count;
                })
                .catch(() => { window.location.href = '/login'; });
        }

        function showToast(msg) {
            const toast = document.createElement('div');
            toast.innerHTML = `<div style="position:fixed;bottom:2rem;right:2rem;background:#11999E;color:white;padding:0.8rem 1.5rem;border-radius:12px;font-weight:600;font-size:0.9rem;z-index:9999;box-shadow:0 8px 24px rgba(17,153,158,0.35);animation:slideUp 0.3s ease;"><i class="bi bi-check-circle-fill me-2"></i>${msg}</div>`;
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 3000);
        }
    </script>
    <style>
        @keyframes slideUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
@endpush