@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h4 class="mb-1">Admin Panel</h4>
        <small class="text">Pusat kontrol untuk data utama dan laporan toko.</small>
    </div>
    <span class="badge bg-danger p-2">Admin</span>
</div>

<div class="row g-3">
    <div class="col-md-6 col-xl-3">
        <a href="{{ route('products.index') }}" class="card-dark p-3 d-block text-white text-decoration-none h-100">
            <i class="fas fa-box text-danger mb-3"></i>
            <h5>Kelola Produk</h5>
            <p class="text-muted mb-0">Tambah, ubah, dan pantau katalog produk.</p>
        </a>
    </div>
    <div class="col-md-6 col-xl-3">
        <a href="{{ route('categories.index') }}" class="card-dark p-3 d-block text-white text-decoration-none h-100">
            <i class="fas fa-tags text-danger mb-3"></i>
            <h5>Kelola Kategori</h5>
            <p class="text-muted mb-0">Rapikan kategori produk agar mudah dicari.</p>
        </a>
    </div>
    <div class="col-md-6 col-xl-3">
        <a href="{{ route('reports.index') }}" class="card-dark p-3 d-block text-white text-decoration-none h-100">
            <i class="fas fa-file-export text-danger mb-3"></i>
            <h5>Laporan</h5>
            <p class="text-muted mb-0">Export data operasional ke PDF atau Excel.</p>
        </a>
    </div>
    <div class="col-md-6 col-xl-3">
        <a href="{{ route('admin.banner') }}" class="card-dark p-3 d-block text-white text-decoration-none h-100">
            <i class="fas fa-image text-danger mb-3"></i>
            <h5>Banner Landing</h5>
            <p class="text-muted mb-0">Perbarui gambar promosi di halaman awal.</p>
        </a>
    </div>
</div>
@endsection
