@extends('layouts.app')

@section('content')
<div class="card-dark p-4 animate-fade">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-4">
        <div>
            <h4 class="mb-1">Edit Stok</h4>
            <p class="text-muted mb-0">Perbarui jumlah dan tanggal stok.</p>
        </div>
        <a href="{{ route('stocks.index') }}" class="btn btn-outline-light"><i class="fas fa-arrow-left me-2"></i>Kembali</a>
    </div>

    <form action="{{ route('stocks.update', $stock) }}" method="POST">
        @csrf @method('PUT')
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Produk</label>
                <select name="product_id" class="form-control">
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" @selected($stock->product_id == $product->id)>{{ $product->product_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Qty</label>
                <input name="qty" type="number" class="form-control" value="{{ $stock->qty }}" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Tanggal</label>
                <input name="stock_date" type="date" class="form-control" value="{{ $stock->stock_date }}" required>
            </div>
        </div>
        <div class="mt-4 d-flex gap-2">
            <button class="btn btn-danger"><i class="fas fa-save me-2"></i>Simpan</button>
            <a href="{{ route('stocks.index') }}" class="btn btn-outline-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
