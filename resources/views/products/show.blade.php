@extends('layouts.app')
@section('title', $product->name)

@push('styles')
    <style>
        /* ===== PRODUCT DETAIL ===== */
        .detail-img-wrap {
            background: linear-gradient(135deg, #f0fafa, #e8f8f6);
            border-radius: 20px;
            padding: 2.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 320px;
            overflow: hidden;
        }

        .detail-img-wrap img {
            width: 100%;
            max-height: 280px;
            object-fit: contain;
        }

        .detail-img-wrap .no-img-icon {
            font-size: 7rem;
            color: var(--teal);
            opacity: 0.25;
        }

        .info-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 4px 24px rgba(17, 153, 158, 0.08);
            height: 100%;
        }

        .category-tag {
            display: inline-block;
            background: var(--teal-light);
            color: var(--teal);
            border-radius: 6px;
            padding: 3px 12px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 0.8rem;
        }

        .product-title {
            font-family: 'Plus Jakarta Sans', serif;
            font-size: 1.9rem;
            font-weight: 900;
            color: #1a1a2e;
            margin-bottom: 0.2rem;
            line-height: 1.2;
        }

        .product-unit-text {
            color: var(--gray);
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .stock-tag {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: rgba(17, 153, 158, 0.1);
            color: var(--teal);
            border-radius: 8px;
            padding: 4px 12px;
            font-size: 0.82rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .big-price {
            font-family: 'Plus Jakarta Sans', serif;
            font-size: 2.2rem;
            font-weight: 900;
            color: var(--teal);
            margin-bottom: 1.2rem;
        }

        .desc-label {
            font-weight: 700;
            color: #444;
            margin-bottom: 0.4rem;
            font-size: 0.95rem;
        }

        .desc-text {
            color: #555;
            line-height: 1.7;
            font-size: 0.92rem;
            margin-bottom: 1.5rem;
        }

        /* QTY CONTROL */
        .qty-wrap {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            flex-wrap: wrap;
            margin-bottom: 1rem;
        }

        .qty-control {
            display: flex;
            align-items: center;
            border: 2px solid var(--teal-light);
            border-radius: 12px;
            overflow: hidden;
        }

        .qty-btn {
            background: var(--teal-light);
            border: none;
            width: 42px;
            height: 42px;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--teal);
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .qty-btn:hover {
            background: var(--teal);
            color: white;
        }

        .qty-input {
            width: 52px;
            text-align: center;
            border: none;
            outline: none;
            font-weight: 700;
            font-size: 1rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: white;
        }

        .btn-keranjang {
            flex: 1;
            min-width: 180px;
            background: var(--teal);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            font-weight: 700;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-keranjang:hover {
            background: var(--teal-dark);
            transform: translateY(-1px);
        }

        .btn-wishlist {
            width: 46px;
            height: 46px;
            border: 2px solid #eee;
            border-radius: 12px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 1.1rem;
            color: #aaa;
        }

        .btn-wishlist:hover {
            border-color: var(--danger);
            color: var(--danger);
        }

        .btn-wishlist.active {
            background: rgba(255, 93, 83, 0.08);
            border-color: var(--danger);
            color: var(--danger);
        }

        /* FEATURE MINI */
        .feature-mini {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.6rem;
            margin-top: 1.2rem;
        }

        .feature-mini-item {
            background: #f8fdfd;
            border-radius: 10px;
            padding: 0.7rem;
            text-align: center;
        }

        .feature-mini-item i {
            color: var(--teal);
            font-size: 1.1rem;
            display: block;
            margin-bottom: 4px;
        }

        .feature-mini-item span {
            font-size: 0.72rem;
            color: #666;
            display: block;
        }

        /* REVIEWS */
        .review-card {
            background: #f8fdfd;
            border-radius: 14px;
            padding: 1.1rem 1.2rem;
            margin-bottom: 0.8rem;
            border: 1px solid rgba(17, 153, 158, 0.08);
        }

        .review-avatar {
            width: 38px;
            height: 38px;
            background: var(--teal);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 0.85rem;
            flex-shrink: 0;
        }

        .star {
            color: #ddd;
            font-size: 0.9rem;
        }

        .star.filled {
            color: #f39c12;
        }

        /* RELATED PRODUCTS */
        .related-card {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            background: white;
            border-radius: 12px;
            padding: 0.8rem;
            margin-bottom: 0.6rem;
            box-shadow: 0 2px 10px rgba(17, 153, 158, 0.07);
            text-decoration: none;
            transition: all 0.2s;
            border: 1px solid rgba(17, 153, 158, 0.08);
        }

        .related-card:hover {
            transform: translateX(4px);
            box-shadow: 0 4px 16px rgba(17, 153, 158, 0.14);
        }

        .related-img {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, #f0fafa, #e8f8f6);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            overflow: hidden;
        }

        .related-img img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 4px;
        }

        .related-name {
            font-weight: 700;
            font-size: 0.85rem;
            color: #1a1a2e;
            margin-bottom: 2px;
        }

        .related-price {
            font-family: 'Plus Jakarta Sans', serif;
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--teal);
        }

        /* TOAST */
        .toast-msg {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            background: var(--teal);
            color: white;
            padding: 0.8rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.9rem;
            z-index: 9999;
            box-shadow: 0 8px 24px rgba(17, 153, 158, 0.35);
            animation: slideUp 0.3s ease;
        }

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

@section('content')
    <div class="container py-4">

        {{-- BREADCRUMB --}}
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb" style="background:none;padding:0;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"
                        style="color:var(--teal);text-decoration:none;">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}"
                        style="color:var(--teal);text-decoration:none;">Produk</a></li>
                <li class="breadcrumb-item active" style="color:#888;">{{ Str::limit($product->name, 35) }}</li>
            </ol>
        </nav>

        {{-- MAIN ROW --}}
        <div class="row g-4 mb-4">

            {{-- GAMBAR PRODUK --}}
            <div class="col-lg-5">
                <div class="detail-img-wrap">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    @else
                        <i class="bi bi-capsule no-img-icon"></i>
                    @endif
                </div>
            </div>

            {{-- INFO PRODUK --}}
            <div class="col-lg-7">
                <div class="info-card">

                    @if($product->category)
                        <span class="category-tag">{{ $product->category->name }}</span>
                    @endif

                    <h1 class="product-title">{{ $product->name }}</h1>
                    <p class="product-unit-text">Per {{ $product->unit }}</p>

                    <div class="d-flex align-items-center gap-3 mb-1">
                        <span class="stock-tag">
                            <i class="bi bi-box-seam"></i> Stok: {{ $product->stock }}
                        </span>
                        @if($product->reviews->count() > 0)
                            <span style="font-size:0.85rem;color:#888;">
                                <span style="color:#f39c12;">★</span>
                                {{ number_format($product->averageRating(), 1) }}
                                ({{ $product->reviews->count() }} ulasan)
                            </span>
                        @endif
                    </div>

                    <div class="big-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>

                    @if($product->description)
                        <div class="desc-label">Deskripsi</div>
                        <p class="desc-text">{{ $product->description }}</p>
                    @endif

                    {{-- TOMBOL TAMBAH KERANJANG --}}
                    @auth
                        <div class="qty-wrap">
                            <div class="qty-control">
                                <button class="qty-btn" type="button" onclick="changeQty(-1)">−</button>
                                <input type="number" id="quantity" class="qty-input" value="1" min="1"
                                    max="{{ $product->stock }}">
                                <button class="qty-btn" type="button" onclick="changeQty(1)">+</button>
                            </div>
                            <button class="btn-keranjang" onclick="addToCartDetail({{ $product->id }})">
                                <i class="bi bi-bag-plus"></i> Masukan Keranjang
                            </button>
                            <button class="btn-wishlist" id="wishBtn" onclick="toggleWish(this)" title="Wishlist">
                                <i class="bi bi-heart"></i>
                            </button>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                            style="display:flex;align-items:center;justify-content:center;gap:8px;background:var(--teal);color:white;border-radius:12px;padding:0.85rem;text-decoration:none;font-weight:700;font-size:0.95rem;transition:all 0.2s;">
                            <i class="bi bi-bag-plus"></i> Masuk untuk Membeli
                        </a>
                    @endauth

                    {{-- FITUR MINI --}}
                    <div class="feature-mini">
                        <div class="feature-mini-item">
                            <i class="bi bi-patch-check-fill"></i>
                            <span>Produk Asli</span>
                        </div>
                        <div class="feature-mini-item">
                            <i class="bi bi-truck"></i>
                            <span>Pengiriman Cepat</span>
                        </div>
                        <div class="feature-mini-item">
                            <i class="bi bi-arrow-repeat"></i>
                            <span>Garansi Resmi</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- ULASAN + PRODUK TERKAIT --}}
        <div class="row g-4">

            {{-- ULASAN --}}
            <div class="col-lg-8">
                <div
                    style="background:white;border-radius:20px;padding:1.8rem;box-shadow:0 4px 24px rgba(17,153,158,0.08);">

                    {{-- Header --}}
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 style="font-family:'Fraunces',serif;font-weight:800;margin:0;">
                            Ulasan Pelanggan
                        </h5>
                        <span style="color:var(--teal);font-weight:600;font-size:0.88rem;">
                            {{ $product->reviews->count() }} ulasan
                        </span>
                    </div>

                    {{-- Rating Summary (jika ada ulasan) --}}
                    @if($product->reviews->count() > 0)
                        <div
                            style="background:#f8fdfd;border-radius:14px;padding:1rem 1.2rem;margin-bottom:1.2rem;display:flex;align-items:center;gap:1.5rem;">
                            <div style="text-align:center;">
                                <div
                                    style="font-family:'Fraunces',serif;font-size:2.5rem;font-weight:900;color:var(--teal);line-height:1;">
                                    {{ number_format($product->averageRating(), 1) }}
                                </div>
                                <div style="color:#f39c12;font-size:1rem;margin:3px 0;">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= round($product->averageRating()))★@else☆@endif
                                    @endfor
                                </div>
                                <div style="font-size:0.78rem;color:var(--gray);">dari 5 bintang</div>
                            </div>
                            <div style="flex:1;">
                                @for($r = 5; $r >= 1; $r--)
                                    @php $count = $product->reviews->where('rating', $r)->count();
                                    $pct = $product->reviews->count() > 0 ? ($count / $product->reviews->count() * 100) : 0; @endphp
                                    <div style="display:flex;align-items:center;gap:8px;margin-bottom:4px;">
                                        <span style="font-size:0.78rem;color:#888;min-width:10px;">{{ $r }}</span>
                                        <span style="color:#f39c12;font-size:0.8rem;">★</span>
                                        <div style="flex:1;height:6px;background:#eee;border-radius:3px;overflow:hidden;">
                                            <div style="width:{{ $pct }}%;height:100%;background:#f39c12;border-radius:3px;"></div>
                                        </div>
                                        <span style="font-size:0.75rem;color:#888;min-width:18px;">{{ $count }}</span>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    @endif

                    {{-- Daftar Ulasan --}}
                    @forelse($product->reviews->take(5) as $review)
                        <div
                            style="background:#f8fdfd;border-radius:14px;padding:1.1rem 1.2rem;margin-bottom:0.8rem;border:1px solid rgba(17,153,158,0.08);">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <div
                                    style="width:38px;height:38px;background:var(--teal);border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:0.85rem;flex-shrink:0;">
                                    {{ strtoupper(substr($review->user->name ?? 'U', 0, 1)) }}
                                </div>
                                <div class="flex-grow-1">
                                    <div style="font-weight:700;font-size:0.9rem;">{{ $review->user->name ?? 'Pengguna' }}</div>
                                    <div style="font-size:0.75rem;color:var(--gray);">{{ $review->created_at->format('d M Y') }}
                                    </div>
                                </div>
                                <div style="text-align:right;">
                                    <div style="color:#f39c12;font-size:0.95rem;">
                                        @for($i = 1; $i <= 5; $i++){{ $i <= $review->rating ? '★' : '☆' }}@endfor
                                    </div>
                                    <small style="font-weight:700;color:#555;">{{ $review->rating }}.0</small>
                                </div>
                            </div>
                            @if($review->comment)
                                <p style="font-size:0.88rem;color:#555;margin:0;line-height:1.6;">{{ $review->comment }}</p>
                            @endif
                        </div>
                    @empty
                        <div style="text-align:center;padding:2rem 0;">
                            <i class="bi bi-chat-dots"
                                style="font-size:2.5rem;color:var(--gray);opacity:0.5;display:block;margin-bottom:8px;"></i>
                            <p style="color:var(--gray);margin:0;font-size:0.9rem;">Belum ada ulasan. Jadilah yang pertama!</p>
                        </div>
                    @endforelse

                    {{-- FORM TULIS ULASAN --}}
                    @auth
                        @php
                            $canReview = \App\Models\Order::where('user_id', auth()->id())
                                ->where('status', 'delivered')
                                ->whereHas('items', function ($q) use ($product) {
                                    $q->where('product_id', $product->id);
                                })
                                ->exists();

                            $alreadyReviewed = \App\Models\Review::where('user_id', auth()->id())
                                ->where('product_id', $product->id)
                                ->first();
                        @endphp

                        @if($canReview)
                            <div style="border-top:2px solid #f0f0f0;margin-top:1.2rem;padding-top:1.2rem;">
                                <h6 style="font-weight:800;margin-bottom:1rem;color:#1a1a2e;">
                                    {{ $alreadyReviewed ? '✏️ Edit Ulasan Kamu' : '✍️ Tulis Ulasan' }}
                                </h6>

                                @if(session('success'))
                                    <div
                                        style="background:rgba(46,204,113,0.12);color:#1a7a3f;border-radius:10px;padding:0.7rem 1rem;margin-bottom:1rem;font-size:0.88rem;">
                                        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                                    </div>
                                @endif
                                @if(session('error'))
                                    <div
                                        style="background:rgba(255,93,83,0.1);color:#c0392b;border-radius:10px;padding:0.7rem 1rem;margin-bottom:1rem;font-size:0.88rem;">
                                        <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('reviews.store') }}">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                                    {{-- BINTANG RATING --}}
                                    <div class="mb-3">
                                        <label
                                            style="font-weight:600;font-size:0.88rem;color:#444;display:block;margin-bottom:0.5rem;">Penilaian
                                            Kamu</label>
                                        <div class="star-rating" style="display:flex;gap:6px;">
                                            @for($i = 1; $i <= 5; $i++)
                                                <input type="radio" name="rating" id="star{{ $i }}" value="{{ $i }}"
                                                    style="display:none;" {{ ($alreadyReviewed && $alreadyReviewed->rating == $i) ? 'checked' : '' }}>
                                                <label for="star{{ $i }}"
                                                    style="font-size:2rem;cursor:pointer;color:#ddd;transition:color 0.15s;"
                                                    class="star-label" onmouseover="highlightStars({{ $i }})" onmouseout="resetStars()"
                                                    onclick="selectStar({{ $i }})">★</label>
                                            @endfor
                                        </div>
                                        <small id="ratingText" style="color:var(--gray);font-size:0.78rem;">Pilih bintang</small>
                                    </div>

                                    {{-- KOMENTAR --}}
                                    <div class="mb-3">
                                        <label
                                            style="font-weight:600;font-size:0.88rem;color:#444;display:block;margin-bottom:0.5rem;">Komentar
                                            (opsional)</label>
                                        <textarea name="comment" rows="3"
                                            placeholder="Bagikan pengalaman kamu menggunakan produk ini..."
                                            style="width:100%;border:2px solid #eef2f2;border-radius:12px;padding:0.7rem 1rem;font-size:0.88rem;font-family:'Plus Jakarta Sans',sans-serif;outline:none;resize:vertical;transition:border 0.2s;"
                                            onfocus="this.style.borderColor='var(--teal)'"
                                            onblur="this.style.borderColor='#eef2f2'">{{ $alreadyReviewed->comment ?? '' }}</textarea>
                                    </div>

                                    <button type="submit"
                                        style="background:var(--teal);color:white;border:none;border-radius:10px;padding:0.65rem 1.8rem;font-weight:700;font-size:0.9rem;cursor:pointer;transition:all 0.2s;"
                                        onmouseover="this.style.background='var(--teal-dark)'"
                                        onmouseout="this.style.background='var(--teal)'">
                                        <i class="bi bi-send-fill me-2"></i>
                                        {{ $alreadyReviewed ? 'Perbarui Ulasan' : 'Kirim Ulasan' }}
                                    </button>
                                </form>
                            </div>
                        @else
                            <div style="border-top:2px solid #f0f0f0;margin-top:1.2rem;padding-top:1.2rem;text-align:center;">
                                <i class="bi bi-bag-check"
                                    style="font-size:2rem;color:var(--teal-light);display:block;margin-bottom:8px;"></i>
                                <p style="color:var(--gray);font-size:0.85rem;margin:0;">
                                    Hanya pelanggan yang sudah membeli dan menerima produk ini yang bisa memberi ulasan.
                                </p>
                            </div>
                        @endif

                    @else
                        <div style="border-top:2px solid #f0f0f0;margin-top:1.2rem;padding-top:1.2rem;text-align:center;">
                            <p style="color:var(--gray);font-size:0.85rem;margin:0;">
                                <a href="{{ route('login') }}"
                                    style="color:var(--teal);font-weight:700;text-decoration:none;">Masuk</a>
                                untuk menulis ulasan.
                            </p>
                        </div>
                    @endauth

                </div>
            </div>

            {{-- PRODUK TERKAIT --}}
            <div class="col-lg-4">
                <h5 style="font-family:'Fraunces',serif;font-weight:800;margin-bottom:1rem;">Produk Terkait</h5>

                @forelse($related as $rel)
                    <a href="{{ route('products.show', $rel->slug) }}" class="related-card">
                        <div class="related-img">
                            @if($rel->image)
                                <img src="{{ asset('storage/' . $rel->image) }}" alt="{{ $rel->name }}">
                            @else
                                <i class="bi bi-capsule" style="color:var(--teal);opacity:0.4;font-size:1.4rem;"></i>
                            @endif
                        </div>
                        <div style="flex:1;min-width:0;">
                            <div class="related-name">{{ Str::limit($rel->name, 30) }}</div>
                            <div class="related-price">Rp {{ number_format($rel->price, 0, ',', '.') }}</div>
                        </div>
                        <i class="bi bi-chevron-right" style="color:var(--gray);font-size:0.85rem;flex-shrink:0;"></i>
                    </a>
                @empty
                    <p style="color:var(--gray);font-size:0.9rem;">Tidak ada produk terkait.</p>
                @endforelse
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function changeQty(delta) {
            const input = document.getElementById('quantity');
            let val = parseInt(input.value) + delta;
            const max = parseInt(input.max) || 999;
            if (val < 1) val = 1;
            if (val > max) val = max;
            input.value = val;
        }

        function addToCartDetail(productId) {
            const qty = parseInt(document.getElementById('quantity').value);
            fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                },
                body: JSON.stringify({ product_id: productId, quantity: qty })
            })
                .then(r => r.json())
                .then(data => {
                    showToast(data.message || 'Produk ditambahkan ke keranjang!');
                    const badge = document.querySelector('.cart-badge');
                    if (data.count && badge) badge.textContent = data.count;
                })
                .catch(() => { window.location.href = '/login'; });
        }

        function showToast(msg) {
            const old = document.querySelector('.toast-msg');
            if (old) old.remove();
            const t = document.createElement('div');
            t.className = 'toast-msg';
            t.innerHTML = `<i class="bi bi-check-circle-fill me-2"></i>${msg}`;
            document.body.appendChild(t);
            setTimeout(() => t.remove(), 3000);
        }

        function toggleWish(btn) {
            btn.classList.toggle('active');
            const icon = btn.querySelector('i');
            icon.classList.toggle('bi-heart');
            icon.classList.toggle('bi-heart-fill');
        }

        // ===== BINTANG RATING =====
        let selectedRating = {{ $alreadyReviewed->rating ?? 0 }};
        const ratingLabels = ['', 'Sangat Buruk', 'Buruk', 'Cukup', 'Bagus', 'Sangat Bagus'];
        const stars = document.querySelectorAll('.star-label');

        function updateStarDisplay(rating) {
            stars.forEach((s, i) => {
                s.style.color = i < rating ? '#f39c12' : '#ddd';
            });
        }
        function highlightStars(n) { updateStarDisplay(n); }
        function resetStars() { updateStarDisplay(selectedRating); }
        function selectStar(n) {
            selectedRating = n;
            updateStarDisplay(n);
            const txt = document.getElementById('ratingText');
            if (txt) {
                txt.textContent = ratingLabels[n] || 'Pilih bintang';
                txt.style.color = '#f39c12';
            }
        }

        // Inisialisasi rating awal
        updateStarDisplay(selectedRating);
        if (selectedRating > 0) {
            const txt = document.getElementById('ratingText');
            if (txt) {
                txt.textContent = ratingLabels[selectedRating];
                txt.style.color = '#f39c12';
            }
        }
    </script>
@endpush