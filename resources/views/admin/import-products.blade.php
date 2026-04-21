<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Produk – Medicaly Admin</title>
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

        /* SIDEBAR */
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

        .card-box {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(17, 153, 158, 0.07);
            border: 1px solid rgba(17, 153, 158, 0.06);
            margin-bottom: 1.2rem;
        }

        .card-title {
            font-weight: 800;
            font-size: 1rem;
            color: #1a1a2e;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .upload-zone {
            border: 2px dashed var(--teal-light);
            border-radius: 14px;
            padding: 2.5rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            background: #f8fdfd;
        }

        .upload-zone:hover,
        .upload-zone.drag-over {
            border-color: var(--teal);
            background: #e8f8f6;
        }

        .upload-zone i {
            font-size: 2.5rem;
            color: var(--teal);
            display: block;
            margin-bottom: 0.8rem;
            opacity: 0.7;
        }

        .btn-teal {
            background: var(--teal);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 0.6rem 1.4rem;
            font-weight: 700;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
        }

        .btn-teal:hover {
            background: var(--teal-dark);
            color: white;
            transform: translateY(-1px);
        }

        .btn-outline {
            background: white;
            color: var(--teal);
            border: 2px solid var(--teal);
            border-radius: 10px;
            padding: 0.55rem 1.2rem;
            font-weight: 700;
            font-size: 0.88rem;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
        }

        .btn-outline:hover {
            background: var(--teal);
            color: white;
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

        .step-item {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .step-num {
            width: 28px;
            height: 28px;
            background: var(--teal);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.82rem;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .step-content {
            flex: 1;
        }

        .step-title {
            font-weight: 700;
            font-size: 0.9rem;
            margin-bottom: 2px;
        }

        .step-desc {
            font-size: 0.82rem;
            color: #666;
        }

        .format-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
        }

        .format-table th {
            background: #f0fafa;
            padding: 0.5rem 0.8rem;
            text-align: left;
            font-weight: 700;
            font-size: 0.8rem;
            color: var(--teal);
            border-bottom: 2px solid var(--teal-light);
        }

        .format-table td {
            padding: 0.5rem 0.8rem;
            border-bottom: 1px solid #f0f0f0;
        }

        .format-table tr:hover td {
            background: #f8fdfd;
        }

        .alert-success-custom {
            background: rgba(46, 204, 113, 0.1);
            color: #1a7a3f;
            border-radius: 12px;
            padding: 0.8rem 1rem;
            margin-bottom: 1rem;
            font-size: 0.88rem;
            border: 1px solid rgba(46, 204, 113, 0.2);
        }

        .alert-error-custom {
            background: rgba(255, 93, 83, 0.08);
            color: #c0392b;
            border-radius: 12px;
            padding: 0.8rem 1rem;
            margin-bottom: 1rem;
            font-size: 0.88rem;
            border: 1px solid rgba(255, 93, 83, 0.2);
        }

        .error-list {
            margin: 0.5rem 0 0;
            padding-left: 1.2rem;
        }

        .error-list li {
            font-size: 0.82rem;
            margin-bottom: 2px;
        }

        .file-selected {
            background: #e8f8f6;
            border-radius: 10px;
            padding: 0.7rem 1rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            margin-top: 0.8rem;
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
            <a href="{{ route('admin.products.index') }}" class="sidebar-link active"><i
                    class="bi bi-box-seam-fill"></i> Produk</a>
            <a href="{{ route('admin.orders.index') }}" class="sidebar-link"><i class="bi bi-bag-fill"></i> Pesanan</a>
            <div class="nav-label">Sistem</div>
            <a href="{{ route('admin.monitor') }}" class="sidebar-link"><i class="bi bi-activity"></i> Monitor</a>
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
                <a href="{{ route('admin.products.index') }}" class="btn-back">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <div>
                    <div class="topbar-title">Import Produk</div>
                    <small style="color:var(--gray);">Upload file CSV untuk menambahkan produk secara massal</small>
                </div>
            </div>
        </div>

        <div class="page-content">

            {{-- HASIL IMPORT --}}
            @if(session('import_success'))
                <div class="alert-success-custom">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('import_success') }}
                    @if(session('import_errors') && count(session('import_errors')) > 0)
                        <ul class="error-list mt-2">
                            @foreach(session('import_errors') as $err)
                                <li>⚠ {{ $err }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            @endif

            @if(session('error'))
                <div class="alert-error-custom">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert-error-custom">
                    <ul class="error-list mb-0">
                        @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                    </ul>
                </div>
            @endif

            <div class="row g-3">
                <div class="col-lg-7">

                    {{-- UPLOAD FORM --}}
                    <div class="card-box">
                        <div class="card-title">
                            <i class="bi bi-upload" style="color:var(--teal);"></i> Upload File CSV
                        </div>

                        <form method="POST" action="{{ route('admin.import.products') }}" enctype="multipart/form-data"
                            id="importForm">
                            @csrf

                            <div class="upload-zone" id="uploadZone"
                                onclick="document.getElementById('fileInput').click()">
                                <i class="bi bi-file-earmark-spreadsheet"></i>
                                <div style="font-weight:700;color:#444;margin-bottom:4px;">Klik atau drag & drop file
                                    CSV di sini</div>
                                <div style="font-size:0.82rem;color:var(--gray);">Format: .csv | Maksimal 2MB</div>
                            </div>

                            <input type="file" id="fileInput" name="file" accept=".csv,.txt" style="display:none;"
                                onchange="showSelected(this)">

                            <div id="fileSelected" style="display:none;" class="file-selected">
                                <i class="bi bi-file-earmark-check" style="color:var(--teal);font-size:1.3rem;"></i>
                                <div>
                                    <div id="fileName" style="font-weight:700;font-size:0.9rem;"></div>
                                    <div id="fileSize" style="font-size:0.78rem;color:var(--gray);"></div>
                                </div>
                                <button type="button" onclick="clearFile()"
                                    style="background:none;border:none;color:var(--danger);cursor:pointer;margin-left:auto;font-size:1.1rem;"><i
                                        class="bi bi-x-circle"></i></button>
                            </div>

                            <div style="display:flex;gap:10px;margin-top:1rem;">
                                <button type="submit" class="btn-teal" id="submitBtn">
                                    <i class="bi bi-cloud-upload"></i> Mulai Import
                                </button>
                                <a href="{{ route('admin.export.template') }}" class="btn-outline">
                                    <i class="bi bi-download"></i> Download Template
                                </a>
                            </div>
                        </form>
                    </div>

                    {{-- FORMAT KOLOM --}}
                    <div class="card-box">
                        <div class="card-title">
                            <i class="bi bi-table" style="color:#3498db;"></i> Format Kolom CSV
                        </div>
                        <table class="format-table">
                            <thead>
                                <tr>
                                    <th>Nama Kolom</th>
                                    <th>Keterangan</th>
                                    <th>Wajib</th>
                                    <th>Contoh</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><code>nama_produk</code></td>
                                    <td>Nama lengkap produk</td>
                                    <td><span style="color:var(--danger);font-weight:700;">Ya</span></td>
                                    <td>Vitamin C 500mg</td>
                                </tr>
                                <tr>
                                    <td><code>kategori_id</code></td>
                                    <td>ID kategori (lihat tabel kanan)</td>
                                    <td><span style="color:var(--danger);font-weight:700;">Ya</span></td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td><code>harga</code></td>
                                    <td>Harga dalam Rupiah (angka saja)</td>
                                    <td><span style="color:var(--danger);font-weight:700;">Ya</span></td>
                                    <td>25000</td>
                                </tr>
                                <tr>
                                    <td><code>stok</code></td>
                                    <td>Jumlah stok awal</td>
                                    <td><span style="color:var(--danger);font-weight:700;">Ya</span></td>
                                    <td>100</td>
                                </tr>
                                <tr>
                                    <td><code>satuan</code></td>
                                    <td>Satuan produk</td>
                                    <td style="color:#888;">Opsional</td>
                                    <td>Botol / 60 Kapsul</td>
                                </tr>
                                <tr>
                                    <td><code>deskripsi</code></td>
                                    <td>Deskripsi produk</td>
                                    <td style="color:#888;">Opsional</td>
                                    <td>Vitamin C untuk...</td>
                                </tr>
                                <tr>
                                    <td><code>status_aktif</code></td>
                                    <td>1 = Aktif, 0 = Nonaktif</td>
                                    <td style="color:#888;">Opsional</td>
                                    <td>1</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

                <div class="col-lg-5">

                    {{-- PANDUAN --}}
                    <div class="card-box">
                        <div class="card-title">
                            <i class="bi bi-lightbulb-fill" style="color:#f39c12;"></i> Cara Import
                        </div>
                        <div class="step-item">
                            <div class="step-num">1</div>
                            <div class="step-content">
                                <div class="step-title">Download Template</div>
                                <div class="step-desc">Klik "Download Template" untuk mendapatkan file CSV dengan format
                                    yang benar.</div>
                            </div>
                        </div>
                        <div class="step-item">
                            <div class="step-num">2</div>
                            <div class="step-content">
                                <div class="step-title">Isi Data Produk</div>
                                <div class="step-desc">Buka file CSV dengan Excel atau Google Sheets. Isi data produk
                                    sesuai kolom yang tersedia. Jangan mengubah nama kolom header.</div>
                            </div>
                        </div>
                        <div class="step-item">
                            <div class="step-num">3</div>
                            <div class="step-content">
                                <div class="step-title">Simpan sebagai CSV</div>
                                <div class="step-desc">Di Excel: File → Simpan Sebagai → CSV (Comma delimited). Di
                                    Google Sheets: File → Download → CSV.</div>
                            </div>
                        </div>
                        <div class="step-item" style="margin-bottom:0;">
                            <div class="step-num">4</div>
                            <div class="step-content">
                                <div class="step-title">Upload & Import</div>
                                <div class="step-desc">Upload file CSV ke sini lalu klik "Mulai Import". Data produk
                                    akan langsung masuk ke database.</div>
                            </div>
                        </div>
                    </div>

                    {{-- DAFTAR KATEGORI --}}
                    <div class="card-box">
                        <div class="card-title">
                            <i class="bi bi-grid-fill" style="color:#9b59b6;"></i> ID Kategori Tersedia
                        </div>
                        <table class="format-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Kategori</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(\App\Models\Category::all() as $cat)
                                    <tr>
                                        <td style="font-weight:700;color:var(--teal);">{{ $cat->id }}</td>
                                        <td>{{ $cat->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- CATATAN --}}
                    <div
                        style="background:rgba(243,156,18,0.1);border-radius:12px;padding:1rem;border:1px solid rgba(243,156,18,0.2);">
                        <div style="font-weight:700;font-size:0.88rem;color:#856404;margin-bottom:0.5rem;"><i
                                class="bi bi-exclamation-triangle-fill me-1"></i>Perhatian</div>
                        <ul style="font-size:0.82rem;color:#856404;padding-left:1.2rem;margin:0;">
                            <li>Gunakan koma (,) sebagai pemisah kolom</li>
                            <li>Baris pertama adalah header, jangan diubah</li>
                            <li>Produk dengan nama yang sama akan tetap ditambahkan</li>
                            <li>Gambar produk perlu diupload manual setelah import</li>
                            <li>Maksimal 500 baris per file import</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showSelected(input) {
            if (input.files && input.files[0]) {
                const file = input.files[0];
                document.getElementById('fileName').textContent = file.name;
                document.getElementById('fileSize').textContent = (file.size / 1024).toFixed(1) + ' KB';
                document.getElementById('fileSelected').style.display = 'flex';
                document.getElementById('uploadZone').style.borderColor = 'var(--teal)';
                document.getElementById('uploadZone').style.background = '#e8f8f6';
            }
        }

        function clearFile() {
            document.getElementById('fileInput').value = '';
            document.getElementById('fileSelected').style.display = 'none';
            document.getElementById('uploadZone').style.borderColor = 'var(--teal-light)';
            document.getElementById('uploadZone').style.background = '#f8fdfd';
        }

        // Drag & drop
        const zone = document.getElementById('uploadZone');
        zone.addEventListener('dragover', e => { e.preventDefault(); zone.classList.add('drag-over'); });
        zone.addEventListener('dragleave', () => zone.classList.remove('drag-over'));
        zone.addEventListener('drop', e => {
            e.preventDefault();
            zone.classList.remove('drag-over');
            const files = e.dataTransfer.files;
            if (files.length) {
                document.getElementById('fileInput').files = files;
                showSelected(document.getElementById('fileInput'));
            }
        });

        // Konfirmasi submit
        document.getElementById('importForm').addEventListener('submit', function (e) {
            const fileInput = document.getElementById('fileInput');
            if (!fileInput.files.length) {
                e.preventDefault();
                alert('Pilih file CSV terlebih dahulu!');
                return;
            }
            document.getElementById('submitBtn').innerHTML = '<i class="bi bi-hourglass-split"></i> Memproses...';
            document.getElementById('submitBtn').disabled = true;
        });
    </script>
</body>

</html>