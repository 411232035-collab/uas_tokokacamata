@extends('layouts.app')

@section('content')
<div class="card-dark p-4 animate-fade">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-4">
        <div>
            <h4 class="mb-1">Stok</h4>
            <p class="text-muted mb-0">Pantau ketersediaan produk kacamata.</p>
        </div>
        @if(auth()->check() && auth()->user()->role === 'admin')
            <a href="{{ route('stocks.create') }}" class="btn btn-danger"><i class="fas fa-plus me-2"></i>Tambah Stok</a>
        @endif
    </div>

    <div class="row g-4">
        @foreach($stocks as $stock)
            <div class="col-lg-6">
                <div class="card-dark h-100 p-3 border border-white-10">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <div class="fw-semibold">{{ $stock->stock_code }}</div>
                            <div class="small text-muted">Tanggal: {{ $stock->stock_date }}</div>
                        </div>
                        <span class="badge {{ $stock->qty <= 0 ? 'bg-warning text-dark' : 'bg-success' }}">{{ $stock->qty }} unit</span>
                    </div>
                    <div class="mb-2"><i class="fas fa-glasses me-2 text-danger"></i>{{ $stock->product->product_name ?? '-' }}</div>
                    <div class="d-flex gap-2 flex-wrap mt-3">
                        @if(auth()->check() && auth()->user()->role === 'admin')
                            <a href="{{ route('stocks.edit', $stock) }}" class="btn btn-sm btn-outline-light"><i class="fas fa-edit me-1"></i>Edit</a>
                            <form action="{{ route('stocks.destroy', $stock) }}" method="POST" class="d-inline">
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
