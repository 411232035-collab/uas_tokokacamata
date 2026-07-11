@extends('layouts.app')

@section('content')
<div class="card-dark p-4 animate-fade">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-4">
        <div>
            <h4 class="mb-1">Transaksi</h4>
            <p class="text-muted mb-0">Riwayat penjualan kacamata premium.</p>
        </div>
        @if(auth()->check() && auth()->user()->role === 'admin')
            <a href="{{ route('transactions.create') }}" class="btn btn-danger"><i class="fas fa-plus me-2"></i>Tambah Transaksi</a>
        @endif
    </div>

    <div class="row g-4">
        @foreach($transactions as $transaction)
            <div class="col-lg-6">
                <div class="card-dark h-100 p-3 border border-white-10">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <div class="fw-semibold">{{ $transaction->transaction_number }}</div>
                            <div class="small text-muted">Merchant: {{ $transaction->merchant_code }}</div>
                        </div>
                        <span class="badge bg-danger">{{ $transaction->qty }} item</span>
                    </div>
                    <div class="mb-2"><i class="fas fa-glasses me-2 text-danger"></i>{{ $transaction->product->product_name ?? '-' }}</div>
                    <div class="small text-muted mb-2">Tanggal: {{ $transaction->transaction_date }}</div>
                    <div class="fw-bold text-danger">Subtotal: Rp {{ number_format($transaction->subtotal, 0, ',', '.') }}</div>
                    <div class="d-flex gap-2 flex-wrap mt-3">
                        @if(auth()->check() && auth()->user()->role === 'admin')
                            <a href="{{ route('transactions.edit', $transaction) }}" class="btn btn-sm btn-outline-light"><i class="fas fa-edit me-1"></i>Edit</a>
                            <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" class="d-inline">
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
