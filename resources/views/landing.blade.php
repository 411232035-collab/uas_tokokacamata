<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Catalog Analytics</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        body { background: linear-gradient(135deg, #11141b, #1b1e24); color: #fff; font-family: Inter, Segoe UI, sans-serif; }
        .hero { min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 32px 12px; }
        .card-hero { background: rgba(36,39,49,0.95); border: 1px solid rgba(255,255,255,0.08); border-radius: 24px; padding: 32px; box-shadow: 0 20px 40px rgba(0,0,0,.25); }
        .btn-danger { background:#FF2D2D; border:0; }
        .btn-danger:hover { background:#e62a2a; }
        .btn-outline-light:hover { color:#111; }
        .text-accent { color:#FF2D2D; }
        .banner-image { width:100%; height:230px; object-fit:cover; border-radius:20px; border:1px solid rgba(255,255,255,.1); }
        .feature-card { display:block; color:#fff; text-decoration:none; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.08); border-radius: 16px; padding: 14px; transition:.2s; }
        .feature-card:hover { color:#fff; border-color:rgba(255,45,45,.55); background:rgba(255,45,45,.12); transform:translateY(-2px); }
        .feature-chip { display:inline-flex; align-items:center; gap:6px; padding:6px 10px; border-radius:999px; background: rgba(255,45,45,0.12); color:#ff8a8a; font-size:.85rem; }
        .text-muted-soft { color:#bfc6d0; }
    </style>
</head>
<body>
@php
    $bannerCandidates = ['landing/banner.jpg', 'landing/banner.jpeg', 'landing/banner.png', 'landing/banner.webp'];
    $bannerUrl = null;
    foreach ($bannerCandidates as $candidate) {
        if (file_exists(public_path('storage/' . $candidate))) {
            $bannerUrl = asset('storage/' . $candidate);
            break;
        }
    }
@endphp
<div class="hero">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <div class="card-hero">
                    <div class="feature-chip mb-3"><i class="fas fa-bolt"></i> Smart Catalog Analytics</div>
                    <h1 class="display-5 fw-bold mb-3">Kelola katalog, stok, dan penjualan dalam satu dashboard modern.</h1>
                    <p class="text-muted-soft mb-4">Pantau performa bisnis, identifikasi stok kritis, dan ekspor laporan dengan cepat melalui panel yang sederhana namun profesional.</p>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('login') }}" class="btn btn-danger btn-lg"><i class="fas fa-sign-in-alt me-2"></i>Masuk</a>
                        <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg"><i class="fas fa-user-plus me-2"></i>Daftar</a>
                    </div>
                    <div class="d-flex flex-wrap gap-3 mt-4 text-muted-soft">
                        <span><i class="fas fa-check-circle text-accent me-2"></i>Realtime KPI</span>
                        <span><i class="fas fa-check-circle text-accent me-2"></i>CRUD lengkap</span>
                        <span><i class="fas fa-check-circle text-accent me-2"></i> mudah dikelola</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card-hero">
                    @if($bannerUrl)
                        <img src="{{ $bannerUrl }}" alt="Banner produk" class="banner-image mb-3">
                    @else
                        <div class="banner-image mb-3 d-flex align-items-center justify-content-center text-center text-muted-soft" style="background: linear-gradient(135deg, rgba(255,45,45,0.15), rgba(255,255,255,0.05));">
                            <div>
                                <i class="fas fa-image fa-2x text-accent mb-2"></i>
                                <div>Banner belum tersedia</div>
                            </div>
                        </div>
                    @endif
                    <h4 class="mb-3">Fitur Utama</h4>
                    <div class="row g-2">
                        <div class="col-6">
                            <a href="{{ route('features.index') }}" class="feature-card">
                                <i class="fas fa-chart-line text-accent me-2"></i> Dashboard KPI
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('features.index') }}" class="feature-card">
                                <i class="fas fa-box text-accent me-2"></i> Produk & stok
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('features.index') }}" class="feature-card">
                                <i class="fas fa-bell text-accent me-2"></i> Notifikasi
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('features.index') }}" class="feature-card">
                                <i class="fas fa-file-export text-accent me-2"></i> Export PDF/Excel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
