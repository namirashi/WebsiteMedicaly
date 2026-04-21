{{-- resources/views/orders/checkout.blade.php --}}
@extends('layouts.app')
@section('title', 'Checkout')
@section('content')
    <div class="container py-4" style="max-width:860px;">
        <h2 style="font-family:'Fraunces',serif;font-weight:900;margin-bottom:1.5rem;">Checkout</h2>
        <div class="row g-4">
            <div class="col-lg-7">
                <div class="bg-white rounded-4 p-4 shadow-sm">
                    <h5 style="font-weight:700;margin-bottom:1.2rem;"><i
                            class="bi bi-geo-alt-fill text-danger me-2"></i>Informasi Pengiriman</h5>
                    <form method="POST" action="{{ route('order.store') }}" id="checkoutForm">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-600">Nama Penerima</label>
                            <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly
                                style="border-radius:10px;border:2px solid #eef2f2;background:#f8f8f8;">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-600">Alamat Pengiriman</label>
                            <textarea name="shipping_address" class="form-control" rows="3"
                                placeholder="Masukan alamat lengkap..." required
                                style="border-radius:10px;border:2px solid #eef2f2;">{{ auth()->user()->address }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-600">Metode Pembayaran</label>
                            @php
                                $paymentMethods = [
                                    'transfer_bank' => 'Transfer Bank',
                                    'cod' => 'Bayar di Tempat (COD)',
                                    'dompet_digital' => 'Dompet Digital (OVO/GoPay)',
                                ];
                            @endphp
                            <div class="d-flex flex-column gap-2">
                                @foreach($paymentMethods as $val => $label)
                                    <label
                                        style="border:2px solid #eee;border-radius:12px;padding:0.8rem 1rem;cursor:pointer;display:flex;align-items:center;gap:0.8rem;transition:border 0.2s;">
                                        <input type="radio" name="payment_method" value="{{ $val }}"
                                            {{ $loop->first ? 'checked' : '' }}
                                            onchange="document.querySelectorAll('.pay-opt').forEach(e=>e.style.borderColor='#eee');this.closest('label').style.borderColor='var(--teal)'">
                                        <span class="pay-opt" style="font-weight:600;font-size:0.9rem;">{{ $label }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="bg-white rounded-4 p-4 shadow-sm mb-3">
                    <h5 style="font-weight:700;margin-bottom:1rem;">Ringkasan Produk</h5>
                    @foreach($carts as $cart)
                        <div class="d-flex gap-2 mb-3 align-items-center">
                            <div style="width:50px;height:50px;border-radius:10px;overflow:hidden;flex-shrink:0;">
                                @if($cart->product->image)
                                    <img src="{{ asset('storage/' . $cart->product->image) }}"
                                        alt="{{ $cart->product->name }}"
                                        style="width:100%;height:100%;object-fit:cover;">
                                @else
                                    <div style="width:100%;height:100%;background:#f0fafa;display:flex;align-items:center;justify-content:center;">
                                        <i class="bi bi-capsule" style="color:var(--teal);opacity:0.5;"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-grow-1" style="font-size:0.88rem;">
                                <div style="font-weight:600;">{{ Str::limit($cart->product->name, 28) }}</div>
                                <div style="color:var(--gray);">x{{ $cart->quantity }}</div>
                            </div>
                            <div style="font-weight:700;font-size:0.9rem;white-space:nowrap;">Rp
                                {{ number_format($cart->product->price * $cart->quantity, 0, ',', '.') }}</div>
                        </div>
                    @endforeach
                    <hr>
                    <div class="d-flex justify-content-between mb-1" style="font-size:0.88rem;">
                        <span>Subtotal</span><span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3" style="font-size:0.88rem;">
                        <span>Pengiriman</span><span style="color:green;">Gratis</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <strong>Total</strong>
                        <strong style="color:var(--teal);font-family:'Fraunces',serif;font-size:1.2rem;">Rp
                            {{ number_format($total, 0, ',', '.') }}</strong>
                    </div>
                    <button type="submit" form="checkoutForm" class="btn-teal w-100"
                        style="border-radius:12px;padding:0.9rem;font-size:0.95rem;">
                        <i class="bi bi-lock-fill me-2"></i>Buat Pesanan
                    </button>
                </div>
            </div>
        </div>
        </form>
    </div>
@endsection