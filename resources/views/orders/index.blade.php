@extends('layouts.app')
@section('title', 'Pesanan Saya')
@section('content')
    <div class="container py-4">
        <h2 style="font-family:'Fraunces',serif;font-weight:900;margin-bottom:1.5rem;">Pesanan Saya</h2>
        @if($orders->isEmpty())
            <div class="text-center py-5 bg-white rounded-4 shadow-sm">
                <i class="bi bi-bag-x" style="font-size:3.5rem;color:var(--gray);"></i>
                <p class="text-muted mt-3">Belum ada pesanan.</p>
                <a href="{{ route('products.index') }}" class="btn-teal px-4 py-2"
                    style="text-decoration:none;border-radius:10px;">Mulai Belanja</a>
            </div>
        @else
            @foreach($orders as $order)
                @php
                    $statusColors = ['pending' => 'warning', 'processing' => 'info', 'shipped' => 'primary', 'delivered' => 'success', 'cancelled' => 'danger'];
                    $statusLabels = ['pending' => 'Menunggu', 'processing' => 'Diproses', 'shipped' => 'Dikirim', 'delivered' => 'Selesai', 'cancelled' => 'Dibatalkan'];
                @endphp
                <div class="bg-white rounded-4 p-4 shadow-sm mb-3">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div>
                            <span style="font-weight:700;font-size:1rem;">{{ $order->order_number }}</span>
                            <span
                                class="ms-2 badge bg-{{ $statusColors[$order->status] ?? 'secondary' }}">{{ $statusLabels[$order->status] ?? $order->status }}</span>
                        </div>
                        <small class="text-muted">{{ $order->created_at->format('d M Y') }}</small>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <div style="font-size:0.88rem;color:#666;">
                            {{ $order->items->count() }} item produk
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <div style="font-family:'Fraunces',serif;font-size:1.1rem;font-weight:700;color:var(--teal);">
                                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                            </div>
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm"
                                style="background:var(--teal-light);color:var(--teal);border-radius:8px;font-weight:600;font-size:0.82rem;padding:0.35rem 0.9rem;">
                                Detail
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="mt-3">{{ $orders->links() }}</div>
        @endif
    </div>
@endsection