@extends('layouts.app')

@section('content')
<div class="card-dark p-4 animate-fade">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-4">
        <div>
            <h4 class="mb-1">Edit Transaksi</h4>
            <p class="text-muted mb-0">Perbarui data penjualan yang sudah tercatat.</p>
        </div>
        <a href="{{ route('transactions.index') }}" class="btn btn-outline-light"><i class="fas fa-arrow-left me-2"></i>Kembali</a>
    </div>

    <form action="{{ route('transactions.update', $transaction) }}" method="POST">
        @csrf @method('PUT')
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Merchant Code</label>
                <input name="merchant_code" class="form-control" value="{{ $transaction->merchant_code }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Produk</label>
                <select name="product_id" class="form-control">
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" @selected($transaction->product_id == $product->id)>{{ $product->product_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Qty</label>
                <input name="qty" type="number" class="form-control" value="{{ $transaction->qty }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Harga</label>
                <input name="price" type="number" class="form-control" value="{{ $transaction->price }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Tanggal</label>
                <input name="transaction_date" type="date" class="form-control" value="{{ $transaction->transaction_date }}" required>
            </div>
        </div>
        <div class="mt-4 d-flex gap-2">
            <button class="btn btn-danger"><i class="fas fa-save me-2"></i>Simpan</button>
            <a href="{{ route('transactions.index') }}" class="btn btn-outline-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
