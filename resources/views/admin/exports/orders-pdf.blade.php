<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 11px;
            color: #1a1a2e;
            background: white;
        }

        .header {
            background: #11999E;
            color: white;
            padding: 18px 24px;
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }

        .header-left {
            display: table-cell;
            vertical-align: middle;
        }

        .header-right {
            display: table-cell;
            vertical-align: middle;
            text-align: right;
        }

        .brand {
            font-size: 22px;
            font-weight: bold;
            letter-spacing: -0.5px;
        }

        .brand span {
            color: #C0EAE2;
        }

        .report-title {
            font-size: 13px;
            margin-top: 3px;
            opacity: 0.85;
        }

        .meta-info {
            font-size: 10px;
            opacity: 0.75;
        }

        .summary-row {
            display: table;
            width: 100%;
            margin-bottom: 18px;
            border-spacing: 8px;
        }

        .summary-box {
            display: table-cell;
            background: #f0fafa;
            border: 1px solid #C0EAE2;
            border-radius: 6px;
            padding: 10px 14px;
            text-align: center;
            width: 25%;
        }

        .summary-num {
            font-size: 18px;
            font-weight: bold;
            color: #11999E;
        }

        .summary-label {
            font-size: 9px;
            color: #888;
            margin-top: 2px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 16px;
        }

        thead th {
            background: #11999E;
            color: white;
            padding: 8px 10px;
            text-align: left;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        tbody tr:nth-child(even) {
            background: #f8fdfd;
        }

        tbody tr:nth-child(odd) {
            background: white;
        }

        tbody td {
            padding: 8px 10px;
            border-bottom: 1px solid #eef2f2;
            font-size: 10px;
            vertical-align: top;
        }

        .badge {
            border-radius: 20px;
            padding: 2px 8px;
            font-size: 9px;
            font-weight: bold;
        }

        .badge-warning {
            background: #fff3cd;
            color: #856404;
        }

        .badge-info {
            background: #cff4fc;
            color: #055160;
        }

        .badge-primary {
            background: #cfe2ff;
            color: #084298;
        }

        .badge-success {
            background: #d1e7dd;
            color: #0a3622;
        }

        .badge-danger {
            background: #f8d7da;
            color: #842029;
        }

        .total-row td {
            font-weight: bold;
            background: #e8f8f6;
            color: #11999E;
            border-top: 2px solid #11999E;
        }

        .footer {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #eee;
            text-align: center;
            font-size: 9px;
            color: #aaa;
        }

        .filter-info {
            background: #fff9e6;
            border: 1px solid #f39c12;
            border-radius: 6px;
            padding: 8px 12px;
            margin-bottom: 14px;
            font-size: 10px;
            color: #856404;
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <div class="header">
        <div class="header-left">
            <div class="brand">+ Medic<span>aly</span></div>
            <div class="report-title">Laporan Data Pesanan</div>
        </div>
        <div class="header-right">
            <div style="font-size:11px;font-weight:bold;">Dicetak: {{ now()->format('d M Y, H:i') }}</div>
            <div class="meta-info">Dicetak oleh: {{ auth()->user()->name }}</div>
        </div>
    </div>

    <!-- SUMMARY -->
    <div class="summary-row">
        <div class="summary-box">
            <div class="summary-num">{{ $orders->count() }}</div>
            <div class="summary-label">Total Pesanan</div>
        </div>
        <div class="summary-box">
            <div class="summary-num">{{ $orders->where('status', 'delivered')->count() }}</div>
            <div class="summary-label">Selesai</div>
        </div>
        <div class="summary-box">
            <div class="summary-num">{{ $orders->where('status', 'pending')->count() }}</div>
            <div class="summary-label">Menunggu</div>
        </div>
        <div class="summary-box">
            <div class="summary-num">Rp
                {{ number_format($orders->where('status', 'delivered')->sum('total_amount'), 0, ',', '.') }}
            </div>
            <div class="summary-label">Total Pendapatan</div>
        </div>
    </div>

    <!-- TABEL PESANAN -->
    <table>
        <thead>
            <tr>
                <th style="width:5%">#</th>
                <th style="width:15%">No. Pesanan</th>
                <th style="width:15%">Pelanggan</th>
                <th style="width:12%">Total</th>
                <th style="width:12%">Pembayaran</th>
                <th style="width:10%">Status</th>
                <th style="width:10%">Item</th>
                <th style="width:21%">Alamat</th>
                <th style="width:12%">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $i => $order)
                @php
                    $badgeClass = [
                        'pending' => 'badge-warning',
                        'processing' => 'badge-info',
                        'shipped' => 'badge-primary',
                        'delivered' => 'badge-success',
                        'cancelled' => 'badge-danger',
                    ][$order->status] ?? '';
                @endphp
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td style="font-weight:bold;">{{ $order->order_number }}</td>
                    <td>
                        {{ $order->user->name ?? '-' }}<br>
                        <span style="color:#888;font-size:9px;">{{ $order->user->email ?? '' }}</span>
                    </td>
                    <td style="font-weight:bold;color:#11999E;">Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                    </td>
                    <td>{{ ucwords(str_replace('_', ' ', $order->payment_method ?? '-')) }}</td>
                    <td><span class="badge {{ $badgeClass }}">{{ $statusLabels[$order->status] ?? $order->status }}</span>
                    </td>
                    <td style="text-align:center;">{{ $order->items->count() }} item</td>
                    <td style="font-size:9px;">{{ Str::limit($order->shipping_address, 60) }}</td>
                    <td style="font-size:9px;">
                        {{ $order->created_at->format('d M Y') }}<br>{{ $order->created_at->format('H:i') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" style="text-align:center;color:#888;padding:20px;">Tidak ada data pesanan.</td>
                </tr>
            @endforelse

            @if($orders->count() > 0)
                <tr class="total-row">
                    <td colspan="3" style="text-align:right;">TOTAL KESELURUHAN</td>
                    <td>Rp {{ number_format($orders->sum('total_amount'), 0, ',', '.') }}</td>
                    <td colspan="5"></td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="footer">
        Dokumen ini digenerate otomatis oleh sistem Medicaly pada {{ now()->format('d F Y \p\u\k\u\l H:i:s') }} •
        Hanya untuk keperluan internal
    </div>
</body>

</html>