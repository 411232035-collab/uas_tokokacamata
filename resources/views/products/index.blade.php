@extends('layouts.app')

@section('content')
<div class="card-dark p-4 animate-fade">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-4">
        <div>
            <h4 class="mb-1">Koleksi Kacamata</h4>
            <p class="text-muted mb-0">Daftar produk premium dengan merek ternama.</p>
        </div>
        @if(auth()->check() && auth()->user()->role === 'admin')
            <a href="{{ route('products.create') }}" class="btn btn-danger"><i class="fas fa-plus me-2"></i>Tambah Produk</a>
        @endif
    </div>

    <div class="row g-4">
        @foreach($products as $product)
            <div class="col-lg-4 col-md-6">
                <div class="card-dark h-100 p-3 border border-white-10">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="badge bg-danger">{{ $product->category?->name ?? 'Kacamata' }}</span>
                        <span class="badge {{ $product->stock <= $product->minimum_stock ? 'bg-warning text-dark' : 'bg-success' }}">{{ $product->stock <= $product->minimum_stock ? 'Restock' : 'Ready' }}</span>
                    </div>
                    <div class="mb-3 p-3 rounded-3" style="background:linear-gradient(135deg, rgba(255,255,255,.96), rgba(230,235,242,.92)); height:160px; display:flex; align-items:center; justify-content:center; overflow:hidden;">
                        @if($product->image_url)
                            <img src="{{ $product->image_url }}" alt="{{ $product->product_name }}" class="img-fluid rounded-3" style="max-height:135px; width:100%; object-fit:contain;" loading="lazy" onerror="this.classList.add('d-none'); this.nextElementSibling.classList.remove('d-none');">
                            <div class="text-center d-none">
                                <i class="fas fa-glasses fa-3x text-danger"></i>
                                <div class="mt-2 fw-semibold text-dark">{{ $product->product_code }}</div>
                            </div>
                        @else
                            <div class="text-center">
                                <i class="fas fa-glasses fa-3x text-danger"></i>
                                <div class="mt-2 fw-semibold text-dark">{{ $product->product_code }}</div>
                            </div>
                        @endif
                    </div>
                    <h5 class="mb-2">{{ $product->product_name }}</h5>
                    <div class="text-danger fw-bold mb-2">Rp {{ number_format($product->selling_price, 0, ',', '.') }}</div>
                    <div class="small text-muted mb-3">Stok: <span class="text-light">{{ $product->stock }}</span> unit · Minimum: {{ $product->minimum_stock }}</div>
                    <div class="d-flex gap-2 flex-wrap">
                        @if(auth()->check() && auth()->user()->role === 'admin')
                            <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-outline-light"><i class="fas fa-edit me-1"></i>Edit</a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-trash me-1"></i>Delete</button>
                            </form>
                        @else
                            <span class="text-muted">Read-only</span>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
