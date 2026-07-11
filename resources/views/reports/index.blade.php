@extends('layouts.app')

@section('content')
<div class="card-dark p-4">
    <div class="d-flex flex-column flex-lg-row justify-content-between gap-3 mb-4">
        <div>
            <h2 class="mb-1">Reporting Feature</h2>
            <p class="text-muted mb-0">Fitur laporan untuk membantu operasional dan pengambilan keputusan penjualan.</p>
        </div>
        <div class="d-flex flex-wrap gap-2 align-self-start">
            <a href="{{ route('reports.export-excel') }}" class="btn btn-danger"><i class="fas fa-file-excel me-2"></i>Generate Excel</a>
            <a href="{{ route('reports.export-pdf') }}" class="btn btn-outline-light"><i class="fas fa-file-pdf me-2"></i>Generate PDF</a>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-4">
            <div class="card-dark p-3">
                <h6 class="text-muted">Total Revenue</h6>
                <p class="display-6 mb-0">Rp {{ number_format($summary['total_revenue'], 0, ',', '.') }}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-dark p-3">
                <h6 class="text-muted">Total Transaksi</h6>
                <p class="display-6 mb-0">{{ $summary['total_transactions'] }}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-dark p-3">
                <h6 class="text-muted">Unit Terjual</h6>
                <p class="display-6 mb-0">{{ $summary['total_qty'] }}</p>
            </div>
        </div>
    </div>

    <div class="row g-3 mt-2">
        <div class="col-md-6">
            <div class="card-dark p-3 h-100">
                <h5><i class="fas fa-file-excel text-danger me-2"></i>Generate Excel</h5>
                <p class="text-muted mb-0">Mengambil semua data transaksi penjualan lengkap: nomor transaksi, tanggal, merchant, kode produk, produk, qty, harga satuan, dan subtotal.</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card-dark p-3 h-100">
                <h5><i class="fas fa-file-pdf text-danger me-2"></i>Generate PDF</h5>
                <p class="text-muted mb-0">Mencetak detail informasi transaksi penjualan dalam format siap dibagikan atau diarsipkan.</p>
            </div>
        </div>
    </div>

    <div class="card-dark p-3 mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Preview Transaksi Penjualan</h5>
            <span class="badge bg-danger">Latest Data</span>
        </div>
        <div class="table-responsive">
            <table class="table table-dark table-sm align-middle mb-0">
                <thead>
                    <tr>
                        <th>Nomor</th>
                        <th>Tanggal</th>
                        <th>Merchant</th>
                        <th>Produk</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->transaction_number }}</td>
                            <td>{{ $transaction->transaction_date }}</td>
                            <td>{{ $transaction->merchant_code }}</td>
                            <td>{{ $transaction->product?->product_name ?? '-' }}</td>
                            <td>{{ $transaction->qty }}</td>
                            <td>Rp {{ number_format($transaction->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-muted">Belum ada transaksi penjualan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
