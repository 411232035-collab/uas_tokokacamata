@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h4 class="mb-1">Staff Workspace</h4>
        <small class="text-muted">Akses cepat untuk pekerjaan harian staff toko.</small>
    </div>
    <span class="badge bg-secondary p-2">Staff</span>
</div>

<div class="row g-3">
    <div class="col-md-6 col-xl-4">
        <a href="{{ route('products.index') }}" class="card-dark p-3 d-block text-white text-decoration-none h-100">
            <i class="fas fa-box text-danger mb-3"></i>
            <h5>Lihat Produk</h5>
            <p class="text-muted mb-0">Cek katalog dan ketersediaan produk.</p>
        </a>
    </div>
    <div class="col-md-6 col-xl-4">
        <a href="{{ route('transactions.index') }}" class="card-dark p-3 d-block text-white text-decoration-none h-100">
            <i class="fas fa-receipt text-danger mb-3"></i>
            <h5>Transaksi</h5>
            <p class="text-muted mb-0">Pantau daftar transaksi yang sudah tercatat.</p>
        </a>
    </div>
    <div class="col-md-6 col-xl-4">
        <a href="{{ route('stocks.index') }}" class="card-dark p-3 d-block text-white text-decoration-none h-100">
            <i class="fas fa-cubes text-danger mb-3"></i>
            <h5>Stok</h5>
            <p class="text-muted mb-0">Lihat persediaan dan kondisi stok produk.</p>
        </a>
    </div>
</div>
@endsection
