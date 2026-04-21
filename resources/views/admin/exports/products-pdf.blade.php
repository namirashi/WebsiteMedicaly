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
        }

        .brand span {
            color: #C0EAE2;
        }

        .report-title {
            font-size: 13px;
            margin-top: 3px;
            opacity: 0.85;
        }

        .summary-row {
            display: table;
            width: 100%;
            margin-bottom: 18px;
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
            padding: 7px 10px;
            border-bottom: 1px solid #eef2f2;
            font-size: 10px;
            vertical-align: middle;
        }

        .badge {
            border-radius: 20px;
            padding: 2px 8px;
            font-size: 9px;
            font-weight: bold;
        }

        .badge-aktif {
            background: rgba(17, 153, 158, 0.12);
            color: #0d7a7e;
        }

        .badge-nonaktif {
            background: #eee;
            color: #888;
        }

        .badge-kritis {
            background: #f8d7da;
            color: #842029;
        }

        .badge-rendah {
            background: #fff3cd;
            color: #856404;
        }

        .badge-aman {
            background: #d1e7dd;
            color: #0a3622;
        }

        .footer {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #eee;
            text-align: center;
            font-size: 9px;
            color: #aaa;
        }
    </style>
</head>

<body>

    <div class="header">
        <div class="header-left">
            <div class="brand">+ Medic<span>aly</span></div>
            <div class="report-title">Laporan Data Produk</div>
        </div>
        <div class="header-right">
            <div style="font-size:11px;font-weight:bold;">Dicetak: {{ now()->format('d M Y, H:i') }}</div>
            <div style="font-size:10px;opacity:0.75;">Dicetak oleh: {{ auth()->user()->name }}</div>
        </div>
    </div>

    <!-- SUMMARY -->
    <div class="summary-row">
        <div class="summary-box">
            <div class="summary-num">{{ $products->count() }}</div>
            <div class="summary-label">Total Produk</div>
        </div>
        <div class="summary-box">
            <div class="summary-num">{{ $products->where('is_active', true)->count() }}</div>
            <div class="summary-label">Aktif</div>
        </div>
        <div class="summary-box">
            <div class="summary-num">{{ $products->where('stock', 0)->count() }}</div>
            <div class="summary-label">Stok Habis</div>
        </div>
        <div class="summary-box">
            <div class="summary-num">{{ $products->sum('stock') }}</div>
            <div class="summary-label">Total Stok</div>
        </div>
    </div>

    <!-- TABEL PRODUK -->
    <table>
        <thead>
            <tr>
                <th style="width:4%">#</th>
                <th style="width:22%">Nama Produk</th>
                <th style="width:13%">Kategori</th>
                <th style="width:12%">Harga</th>
                <th style="width:8%">Stok</th>
                <th style="width:10%">Satuan</th>
                <th style="width:8%">Status</th>
                <th style="width:8%">Kondisi Stok</th>
                <th style="width:15%">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $i => $p)
                @php
                    $stockLabel = $p->stock == 0 ? ['badge-kritis', 'Habis'] :
                        ($p->stock < 5 ? ['badge-kritis', 'Kritis'] :
                            ($p->stock < 20 ? ['badge-rendah', 'Rendah'] :
                                ['badge-aman', 'Aman']));
                @endphp
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td style="font-weight:bold;">{{ $p->name }}</td>
                    <td>{{ $p->category->name ?? '-' }}</td>
                    <td style="font-weight:bold;color:#11999E;">Rp {{ number_format($p->price, 0, ',', '.') }}</td>
                    <td style="text-align:center;font-weight:bold;">{{ $p->stock }}</td>
                    <td>{{ $p->unit }}</td>
                    <td>
                        <span class="badge {{ $p->is_active ? 'badge-aktif' : 'badge-nonaktif' }}">
                            {{ $p->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td>
                        <span class="badge {{ $stockLabel[0] }}">{{ $stockLabel[1] }}</span>
                    </td>
                    <td style="font-size:9px;">{{ $p->created_at->format('d M Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" style="text-align:center;color:#888;padding:20px;">Tidak ada data produk.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dokumen ini digenerate otomatis oleh sistem Medicaly pada {{ now()->format('d F Y \p\u\k\u\l H:i:s') }} •
        Hanya untuk keperluan internal
    </div>
</body>

</html>