@extends('layouts.app')
@section('title', 'Detail Pesanan')
@section('content')
    <div class="container py-4" style="max-width:760px;">
        @php
            $statusColors = ['pending' => 'warning', 'processing' => 'info', 'shipped' => 'primary', 'delivered' => 'success', 'cancelled' => 'danger'];
            $statusLabels = ['pending' => 'Menunggu Konfirmasi', 'processing' => 'Sedang Diproses', 'shipped' => 'Sedang Dikirim', 'delivered' => 'Pesanan Selesai', 'cancelled' => 'Dibatalkan'];
        @endphp
        <div class="d-flex align-items-center gap-3 mb-4">
            <a href="{{ route('orders.index') }}" class="btn btn-sm"
                style="background:var(--teal-light);color:var(--teal);border-radius:8px;"><i
                    class="bi bi-arrow-left"></i></a>
            <h2 style="font-family:'Fraunces',serif;font-weight:900;margin:0;">Detail Pesanan</h2>
        </div>

        <div class="bg-white rounded-4 p-4 shadow-sm mb-3">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <h5 style="font-weight:800;margin:0;">{{ $order->order_number }}</h5>
                    <small class="text-muted">{{ $order->created_at->format('d M Y, H:i') }}</small>
                </div>
                <span
                    class="badge bg-{{ $statusColors[$order->status] ?? 'secondary' }} fs-6">{{ $statusLabels[$order->status] ?? $order->status }}</span>
            </div>

            <!-- Timeline status -->
            <div class="d-flex gap-2 mb-4 overflow-auto pb-2">
                @foreach(['pending', 'processing', 'shipped', 'delivered'] as $step)
                    @php $done = in_array($order->status, array_slice(['pending', 'processing', 'shipped', 'delivered'], 0, array_search($step, ['pending', 'processing', 'shipped', 'delivered']) + 1)); @endphp
                    <div class="text-center flex-shrink-0" style="flex:1;min-width:70px;">
                        <div
                            style="width:32px;height:32px;border-radius:50%;background:{{ $done ? 'var(--teal)' : '#eee' }};display:flex;align-items:center;justify-content:center;margin:0 auto 4px;">
                            <i class="bi bi-check-lg" style="color:{{ $done ? 'white' : '#ccc' }};font-size:0.9rem;"></i>
                        </div>
                        <div style="font-size:0.72rem;color:{{ $done ? 'var(--teal)' : '#aaa' }};font-weight:600;">
                            {{ ['pending' => 'Menunggu', 'processing' => 'Diproses', 'shipped' => 'Dikirim', 'delivered' => 'Selesai'][$step] }}
                        </div>
                    </div>
                    @if(!$loop->last)
                        <div style="flex:1;height:2px;background:#eee;align-self:center;margin-top:-20px;">
                            <div style="height:100%;background:{{ $done ? 'var(--teal)' : '#eee' }};width:100%;"></div>
                    </div>@endif
                @endforeach
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <div style="background:#f8fdfd;border-radius:12px;padding:1rem;">
                        <div
                            style="font-size:0.78rem;font-weight:700;text-transform:uppercase;color:#888;margin-bottom:0.5rem;">
                            Alamat Pengiriman</div>
                        <div style="font-size:0.9rem;">{{ $order->shipping_address }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div style="background:#f8fdfd;border-radius:12px;padding:1rem;">
                        <div
                            style="font-size:0.78rem;font-weight:700;text-transform:uppercase;color:#888;margin-bottom:0.5rem;">
                            Metode Pembayaran</div>
                        <div style="font-size:0.9rem;font-weight:600;">
                            {{ ucwords(str_replace('_', ' ', $order->payment_method)) }}</div>
                    </div>
                </div>
            </div>

            <h6 style="font-weight:700;margin-bottom:0.8rem;">Daftar Produk</h6>
            @foreach($order->items as $item)
                <div class="d-flex gap-3 align-items-center mb-3 p-2 rounded-3" style="background:#f8fdfd;">
                    <div
    style="width:55px;height:55px;background:white;border-radius:10px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,0.06);flex-shrink:0;">
    @if($item->product->image)
        <img src="{{ asset('storage/'.$item->product->image) }}" style="width:100%;height:100%;object-fit:cover;" alt="">
    @else
        <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;">
            <i class="bi bi-capsule" style="font-size:1.5rem;color:var(--teal);opacity:0.5;"></i>
        </div>
    @endif
</div>
                    <div class="flex-grow-1">
                        <div style="font-weight:600;font-size:0.9rem;">{{ $item->product->name }}</div>
                        <div style="font-size:0.8rem;color:var(--gray);">{{ $item->quantity }} x Rp
                            {{ number_format($item->price, 0, ',', '.') }}</div>
                    </div>
                    <div style="font-weight:700;color:var(--teal);font-family:'Fraunces',serif;">Rp
                        {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</div>
                </div>
            @endforeach

            <hr>
            <div class="d-flex justify-content-between align-items-center">
                <strong>Total Pembayaran</strong>
                <strong style="font-family:'Fraunces',serif;font-size:1.4rem;color:var(--teal);">Rp
                    {{ number_format($order->total_amount, 0, ',', '.') }}</strong>
            </div>
        </div>

        <div class="text-center">
            <a href="{{ route('products.index') }}" class="btn-teal px-5 py-2"
                style="text-decoration:none;border-radius:12px;">
                <i class="bi bi-bag me-2"></i>Lanjut Belanja
            </a>
        </div>
    </div>
@endsection