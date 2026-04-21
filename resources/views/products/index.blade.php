{{-- resources/views/products/index.blade.php --}}
@extends('layouts.app')
@section('title', 'Produk')

@push('styles')
    <style>
        .sidebar-filter {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 24px rgba(17, 153, 158, 0.08);
        }

        .filter-title {
            font-weight: 700;
            font-size: 0.88rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #888;
            margin-bottom: 0.8rem;
        }

        .form-check-input:checked {
            background-color: var(--teal);
            border-color: var(--teal);
        }

        .product-grid-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }

        .sort-select {
            border: 2px solid var(--teal-light);
            border-radius: 10px;
            padding: 0.4rem 0.8rem;
            font-size: 0.88rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            outline: none;
        }

        .product-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(17, 153, 158, 0.07);
            transition: all 0.3s;
            border: 1px solid rgba(17, 153, 158, 0.08);
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 36px rgba(17, 153, 158, 0.16);
        }

        .product-img-wrap {
            background: linear-gradient(135deg, #ffffff, #ffffff);
            padding: 1.5rem;
            text-align: center;
            height: 170px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
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

        .product-body {
            padding: 1rem 1.2rem 1.2rem;
        }

        .product-name {
            font-weight: 700;
            font-size: 0.9rem;
            color: #1a1a2e;
            margin-bottom: 0.15rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .product-price {
            font-family: 'Plus Jakarta Sans', serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--teal);
        }

        .product-badge {
            position: absolute;
            top: 10px;
            left: 10px;

            background: linear-gradient(135deg, #FF5D53, #ff3b2f);
            color: white;

            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.3px;

            padding: 4px 10px;
            border-radius: 8px;

            box-shadow: 0 4px 12px rgba(255, 93, 83, 0.35);

            z-index: 2;
        }

        /* efek animasi biar lebih hidup */
        .product-badge {
            animation: pulseBadge 1.5s infinite;
        }

        @keyframes pulseBadge {
            0% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(255, 93, 83, 0.5);
            }

            70% {
                transform: scale(1.05);
                box-shadow: 0 0 0 8px rgba(255, 93, 83, 0);
            }

            100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(255, 93, 83, 0);
            }
        }

        .btn-add {
            background: var(--teal);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.45rem;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-add:hover {
            background: var(--teal-dark);
        }

        .page-link {
            color: var(--teal);
            border-radius: 8px !important;
            border: none;
            margin: 0 2px;
        }

        .page-item.active .page-link {
            background: var(--teal);
        }
    </style>
@endpush

@section('content')
    <div class="container py-4">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Produk</li>
            </ol>
        </nav>

        <div class="row g-4">
            <!-- SIDEBAR -->
            <div class="col-lg-3">
                <div class="sidebar-filter">
                    <div class="filter-title"><i class="bi bi-funnel me-1"></i>Filter</div>
                    <form method="GET" action="{{ route('products.index') }}">
                        @if(request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif
                        <div class="mb-3">
                            <div class="filter-title">Kategori</div>
                            @foreach($categories as $cat)
                                <div class="form-check mb-1">
                                    <input class="form-check-input" type="radio" name="category" id="cat{{ $cat->id }}"
                                        value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'checked' : '' }}>
                                    <label class="form-check-label" for="cat{{ $cat->id }}"
                                        style="font-size:0.9rem;">{{ $cat->name }}</label>
                                </div>
                            @endforeach
                            @if(request('category'))
                                <div class="form-check mb-1">
                                    <input class="form-check-input" type="radio" name="category" id="catAll" value="" {{ !request('category') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="catAll" style="font-size:0.9rem;">Semua
                                        Kategori</label>
                                </div>
                            @endif
                        </div>
                        <button type="submit" class="btn-teal w-100" style="font-size:0.88rem;">Terapkan Filter</button>
                    </form>
                </div>
            </div>

            <!-- PRODUK -->
            <div class="col-lg-9">
                <div class="product-grid-header">
                    <div>
                        <span style="font-weight:700;font-size:1.1rem;">{{ $products->total() }} Produk</span>
                        @if(request('search'))
                            <span class="text-muted ms-2">untuk "<strong>{{ request('search') }}</strong>"</span>
                        @endif
                    </div>
                    <select class="sort-select"
                        onchange="window.location.search = '?sort='+this.value+'&{{ http_build_query(request()->except('sort')) }}'">
                        <option value="">Urutkan</option>
                        <option value="newest">Terbaru</option>
                        <option value="price_low">Harga Terendah</option>
                        <option value="price_high">Harga Tertinggi</option>
                    </select>
                </div>
                @if($products->isEmpty())
                    <div class="text-center py-5">
                        <i class="bi bi-search" style="font-size:3rem;color:var(--gray);"></i>
                        <p class="text-muted mt-3">Produk tidak ditemukan.</p>
                        <a href="{{ route('products.index') }}" class="btn-teal px-4 py-2"
                            style="text-decoration:none;border-radius:10px;">Reset Pencarian</a>
                    </div>
                @else
                    <div class="row g-3">
                        @foreach($products as $product)
                            <div class="col-6 col-md-4">
                                <div class="product-card">
                                    <a href="{{ route('products.show', $product->slug) }}" style="text-decoration:none;">
                                        <div class="product-img-wrap">
                                            @if($product->stock < 5) <span class="product-badge">Terbatas</span> @endif
                                            @if($product->image)
                                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                            @else
                                                <i class="bi bi-capsule" style="font-size:3.5rem;color:var(--teal);opacity:0.4;"></i>
                                            @endif
                                        </div>
                                    </a>
                                    <div class="product-body">
                                        <div class="product-name">{{ $product->name }}</div>
                                        <div style="font-size:0.78rem;color:var(--gray);margin-bottom:0.5rem;">{{ $product->unit }}
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                                            @auth
                                                <button class="btn-add" onclick="addToCart({{ $product->id }})">
                                                    <i class="bi bi-plus" style="color:white;font-size:1rem;"></i>
                                                </button>
                                            @else
                                                <a href="{{ route('login') }}" class="btn-add"><i class="bi bi-plus"
                                                        style="color:white;font-size:1rem;"></i></a>
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4 d-flex justify-content-center">
                        {{ $products->withQueryString()->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function addToCart(id) {
            fetch('/cart/add', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content },
                body: JSON.stringify({ product_id: id, quantity: 1 })
            }).then(r => r.json()).then(d => {
                const t = document.createElement('div');
                t.innerHTML = `<div style="position:fixed;bottom:2rem;right:2rem;background:#11999E;color:white;padding:0.8rem 1.5rem;border-radius:12px;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(17,153,158,.35)"><i class="bi bi-check-circle-fill me-2"></i>${d.message}</div>`;
                document.body.appendChild(t);
                setTimeout(() => t.remove(), 3000);
            }).catch(() => window.location = '/login');
        }
    </script>
@endpush