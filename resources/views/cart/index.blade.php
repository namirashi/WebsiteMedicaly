{{-- resources/views/cart/index.blade.php --}}
@extends('layouts.app')
@section('title', 'Keranjang')
@section('content')
<div class="container py-4">
    <h2 style="font-family:'Plus Jakarta Sans',serif;font-weight:900;">Keranjang Belanja</h2>
    @if($carts->isEmpty())
    <div class="text-center py-5">
        <i class="bi bi-bag-x" style="font-size:4rem;color:var(--gray);"></i>
        <p class="text-muted mt-3">Keranjang Anda masih kosong.</p>
        <a href="{{ route('products.index') }}" class="btn-teal px-4 py-2" style="text-decoration:none;border-radius:10px;">Mulai Belanja</a>
    </div>
    @else
    <div class="row g-4">
        <div class="col-lg-8">
            @foreach($carts as $cart)
            <div class="d-flex gap-3 bg-white p-3 rounded-3 shadow-sm mb-3 align-items-center">
                <div style="width:80px;height:80px;background:linear-gradient(135deg,#f0fafa,#e8f8f6);border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    @if($cart->product->image)
                        <img src="{{ asset('storage/'.$cart->product->image) }}" style="height:65px;object-fit:contain;" alt="">
                    @else
                        <i class="bi bi-capsule" style="font-size:2rem;color:var(--teal);opacity:0.5;"></i>
                    @endif
                </div>
                <div class="flex-grow-1">
                    <div style="font-weight:700;color:#1a1a2e;">{{ $cart->product->name }}</div>
                    <div style="font-size:0.82rem;color:var(--gray);">{{ $cart->product->unit }}</div>
                    <div style="font-family:'Fraunces',serif;font-size:1.1rem;font-weight:700;color:var(--teal);">
                        Rp {{ number_format($cart->product->price * $cart->quantity, 0, ',', '.') }}
                    </div>
                </div>
                <form action="{{ route('cart.update', $cart->id) }}" method="POST" class="d-flex align-items-center gap-2">
                    @csrf @method('PUT')
                    <div style="display:flex;align-items:center;border:2px solid var(--teal-light);border-radius:10px;overflow:hidden;">
                        <button type="button" onclick="this.nextElementSibling.value=Math.max(1,parseInt(this.nextElementSibling.value)-1);this.form.submit()" style="background:var(--teal-light);border:none;width:32px;height:32px;font-weight:700;color:var(--teal);cursor:pointer;">−</button>
                        <input type="number" name="quantity" value="{{ $cart->quantity }}" min="1" style="width:40px;text-align:center;border:none;outline:none;font-weight:600;font-family:'Plus Jakarta Sans',sans-serif;">
                        <button type="button" onclick="this.previousElementSibling.value=parseInt(this.previousElementSibling.value)+1;this.form.submit()" style="background:var(--teal-light);border:none;width:32px;height:32px;font-weight:700;color:var(--teal);cursor:pointer;">+</button>
                    </div>
                </form>
                <form action="{{ route('cart.remove', $cart->id) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" style="background:rgba(255,93,83,0.1);border:none;width:36px;height:36px;border-radius:10px;color:var(--danger);cursor:pointer;display:flex;align-items:center;justify-content:center;">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </div>
            @endforeach
        </div>
        <div class="col-lg-4">
            <div class="bg-white rounded-4 p-3 shadow-sm">
                <h5 style="font-family:'Plus Jakarta Sans',serif;font-weight:800;">Ringkasan Pesanan</h5>
                <hr>
                @foreach($carts as $cart)
                <div class="d-flex justify-content-between mb-2" style="font-size:0.88rem;">
                    <span>{{ Str::limit($cart->product->name, 20) }} x{{ $cart->quantity }}</span>
                    <span style="font-weight:600;">Rp {{ number_format($cart->product->price * $cart->quantity, 0, ',', '.') }}</span>
                </div>
                @endforeach
                <hr>
                <div class="d-flex justify-content-between mb-3">
                    <strong>Total</strong>
                    <strong style="color:var(--teal);font-family:'Plus Jakarta Sans',serif;font-size:1.2rem;">
                        Rp {{ number_format($carts->sum(fn($c) => $c->product->price * $c->quantity), 0, ',', '.') }}
                    </strong>
                </div>
                <a href="{{ route('checkout') }}" class="btn-teal d-block text-center" style="border-radius:12px;padding:0.85rem;text-decoration:none;font-weight:700;">
                    Lanjut ke Pembayaran <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection