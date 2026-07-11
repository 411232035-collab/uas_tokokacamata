<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitur - Smart Catalog Analytics</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        body { background: linear-gradient(135deg, #11141b, #1b1e24); color: #fff; font-family: Inter, Segoe UI, sans-serif; }
        .page { min-height: 100vh; padding: 48px 12px; }
        .feature-card { height: 100%; background: rgba(36,39,49,.95); border: 1px solid rgba(255,255,255,.08); border-radius: 16px; padding: 22px; }
        .feature-icon { width: 44px; height: 44px; display: inline-flex; align-items: center; justify-content: center; border-radius: 12px; background: rgba(255,45,45,.14); color: #ff5c5c; }
        .text-muted-soft { color: #bfc6d0; }
        .btn-danger { background:#FF2D2D; border-color:#FF2D2D; }
        .btn-danger:hover { background:#e62a2a; border-color:#e62a2a; }
    </style>
</head>
<body>
<main class="page">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <span class="badge bg-danger mb-2">Fitur Utama</span>
                <h1 class="fw-bold mb-2">Smart Catalog Analytics</h1>
                <p class="text-muted-soft mb-0">Kelola produk, stok, transaksi, notifikasi, dan laporan dalam satu panel.</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('home') }}" class="btn btn-outline-light"><i class="fas fa-home me-2"></i>Beranda</a>
                <a href="{{ auth()->check() ? route('dashboard') : route('login') }}" class="btn btn-danger"><i class="fas fa-arrow-right me-2"></i>Mulai</a>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-6 col-lg-3">
                <div class="feature-card">
                    <div class="feature-icon mb-3"><i class="fas fa-chart-line"></i></div>
                    <h5>Dashboard KPI</h5>
                    <p class="text-muted-soft mb-0">Pantau pendapatan, transaksi, jumlah produk, dan total stok secara cepat.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feature-card">
                    <div class="feature-icon mb-3"><i class="fas fa-box"></i></div>
                    <h5>Produk & Stok</h5>
                    <p class="text-muted-soft mb-0">Atur katalog kacamata, kategori, stok masuk, dan batas minimum persediaan.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feature-card">
                    <div class="feature-icon mb-3"><i class="fas fa-bell"></i></div>
                    <h5>Notifikasi</h5>
                    <p class="text-muted-soft mb-0">Dapatkan penanda saat produk mulai mendekati batas stok minimum.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feature-card">
                    <div class="feature-icon mb-3"><i class="fas fa-file-export"></i></div>
                    <h5>Export Laporan</h5>
                    <p class="text-muted-soft mb-0">Unduh laporan operasional dalam format PDF atau Excel untuk kebutuhan arsip.</p>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>
