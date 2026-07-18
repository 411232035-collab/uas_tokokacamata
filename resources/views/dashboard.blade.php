@extends('layouts.app')

@section('content')
@php
    $displayName = auth()->user()?->name ?? 'User';
    $displayRole = auth()->user()?->role ?? 'staff';
    $stats = $stats ?? [
        'revenue' => 0,
        'sales' => 0,
        'products' => 0,
        'stock' => 0,
    ];
    $systemInsights = $systemInsights ?? [];
    $systemRecommendations = $systemRecommendations ?? [];
    $reportingSummary = $reportingSummary ?? [
        'total_transactions' => 0,
        'total_qty' => 0,
        'total_revenue' => 0,
        'latest_transaction_date' => null,
    ];

    $topProducts = collect();
    $lowStockProducts = collect();
    $chartLabels = [];
    $chartValues = [];

    try {
        $topProducts = \App\Models\Product::orderByDesc('stock')->take(5)->get();
        $lowStockProducts = \App\Models\Product::whereColumn('stock', '<=', 'minimum_stock')->orderBy('stock')->take(5)->get();
        $chartLabels = $topProducts->pluck('product_name')->toArray();
        $chartValues = $topProducts->pluck('stock')->toArray();
    } catch (\Throwable $e) {
        // Fallback aman jika tabel belum siap.
    }
@endphp

<style>
    .insight-card {
        background: rgba(255,255,255,.055);
        border: 1px solid rgba(255,255,255,.12);
        border-radius: 12px;
        min-height: 156px;
    }

    .insight-card__label {
        color: #f7f9ff;
        font-size: .82rem;
        font-weight: 700;
        line-height: 1.25;
    }

    .insight-card__value {
        color: #ffffff;
        font-size: 1rem;
        font-weight: 800;
        line-height: 1.3;
        overflow-wrap: anywhere;
    }

    .insight-card__description {
        color: #edf2ff;
        font-size: .88rem;
        line-height: 1.55;
        margin-bottom: 0;
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h4 class="mb-1">Welcome, {{ $displayName }}</h4>
        <small class="text-muted">Role: <span class="text-danger">{{ ucfirst($displayRole) }}</span></small>
    </div>
    <div class="badge bg-danger p-2">Live Analytics</div>
</div>

<div class="row g-4">
    <div class="col-lg-3 col-md-6">
        <div class="card-dark kpi">
            <div class="d-flex justify-content-between align-items-center"><span>Total Revenue</span><i class="fas fa-chart-line text-danger"></i></div>
            <div class="value mt-2">Rp {{ number_format($stats['revenue'], 0, ',', '.') }}</div>
            <small class="text-success">Data dari transaksi tersimpan</small>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card-dark kpi">
            <div class="d-flex justify-content-between align-items-center"><span>Total Penjualan</span><i class="fas fa-shopping-cart text-danger"></i></div>
            <div class="value mt-2">{{ $stats['sales'] }}</div>
            <small class="text-success">Transaksi terdata</small>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card-dark kpi">
            <div class="d-flex justify-content-between align-items-center"><span>Total Produk</span><i class="fas fa-box text-danger"></i></div>
            <div class="value mt-2">{{ $stats['products'] }}</div>
            <small class="text-success">Katalog aktif</small>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card-dark kpi">
            <div class="d-flex justify-content-between align-items-center"><span>Total Stock</span><i class="fas fa-cubes text-danger"></i></div>
            <div class="value mt-2">{{ $stats['stock'] }}</div>
            <small class="text-success">Total unit tersedia</small>
        </div>
    </div>
</div>

<div class="row g-4 mt-2">
    <div class="col-12">
        <div class="card-dark p-3">
            <div class="d-flex flex-column flex-lg-row justify-content-between gap-2 mb-3">
                <div>
                    <h5 class="mb-1">System Insight</h5>
                    <small class="text-muted">Informasi operasional terkini berdasarkan transaksi, stok, dan produk.</small>
                </div>
                <span class="badge bg-danger align-self-start">Business Monitor</span>
            </div>
            <div class="row g-3">
                @foreach($systemInsights as $insight)
                    <div class="col-md-6 col-xl-3">
                        <div class="insight-card p-3 h-100">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="insight-card__label">{{ $insight['label'] }}</span>
                                <i class="fas {{ $insight['icon'] }} {{ $insight['color'] }}"></i>
                            </div>
                            <div class="insight-card__value mb-2">{{ $insight['value'] }}</div>
                            <p class="insight-card__description">{{ $insight['description'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mt-2">
    <div class="col-lg-7">
        <div class="card-dark p-3 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h5 class="mb-1">Rekomendasi By System</h5>
                    <small class="text-muted">Langkah yang disarankan berdasarkan insight data.</small>
                </div>
                <span class="badge bg-success">Data Driven</span>
            </div>
            <div class="d-grid gap-3">
                @foreach($systemRecommendations as $recommendation)
                    <div class="p-3 rounded-3" style="background:rgba(255,255,255,.04); border:1px solid rgba(255,255,255,.08);">
                        <div class="d-flex justify-content-between gap-2 mb-2">
                            <h6 class="mb-0">{{ $recommendation['title'] }}</h6>
                            <span class="badge bg-danger">{{ $recommendation['priority'] }}</span>
                        </div>
                        <p class="small mb-2" style="color:#d9dee7;">{{ $recommendation['body'] }}</p>
                        <div class="small text-light"><i class="fas fa-arrow-right text-danger me-2"></i>{{ $recommendation['action'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card-dark p-3 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h5 class="mb-1">Reporting Feature</h5>
                    <small class="text-muted">Generate laporan untuk operasional penjualan.</small>
                </div>
                <i class="fas fa-file-export text-danger"></i>
            </div>
            <div class="row g-2 mb-3">
                <div class="col-6">
                    <div class="p-3 rounded-3" style="background:rgba(255,255,255,.04);">
                        <div class="text-muted small">Transaksi</div>
                        <div class="fw-bold">{{ $reportingSummary['total_transactions'] }}</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="p-3 rounded-3" style="background:rgba(255,255,255,.04);">
                        <div class="text-muted small">Unit Terjual</div>
                        <div class="fw-bold">{{ $reportingSummary['total_qty'] }}</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="p-3 rounded-3" style="background:rgba(255,255,255,.04);">
                        <div class="text-muted small">Revenue Laporan</div>
                        <div class="fw-bold">Rp {{ number_format($reportingSummary['total_revenue'], 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
            @if(auth()->user()?->role === 'admin')
                <div class="d-grid gap-2">
                    <a href="{{ route('reports.export-excel') }}" class="btn btn-danger"><i class="fas fa-file-excel me-2"></i>Generate Excel</a>
                    <a href="{{ route('reports.export-pdf') }}" class="btn btn-outline-light"><i class="fas fa-file-pdf me-2"></i>Generate PDF</a>
                    <a href="{{ route('reports.index') }}" class="btn btn-outline-secondary"><i class="fas fa-table me-2"></i>Lihat Reporting</a>
                </div>
            @else
                <div class="alert alert-secondary mb-0">Reporting hanya tersedia untuk admin.</div>
            @endif
        </div>
    </div>
</div>

<div class="row g-4 mt-2">
    <div class="col-12">
        <div class="card-dark p-3">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Sales Trend</h5>
                <span class="badge bg-danger">Live</span>
            </div>
            <canvas id="salesChart" height="180"></canvas>
        </div>
    </div>
</div>

<div class="row g-4 mt-2">
    <div class="col-lg-7">
        <div class="card-dark p-3">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Produk Butuh Restock</h5>
                <span class="badge bg-warning text-dark">Perhatian</span>
            </div>
            <div class="table-responsive">
                <table class="table table-dark table-sm align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Stok</th>
                            <th>Minimum</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($lowStockProducts as $product)
                            <tr>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>{{ $product->minimum_stock }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-muted">Tidak ada produk yang menyentuh batas minimum.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card-dark p-3">
            <h5 class="mb-3">Quick Actions</h5>
            <div class="d-grid gap-2">
                <a href="{{ route('products.index') }}" class="btn btn-outline-light text-start"><i class="fas fa-box me-2"></i>Kelola Produk</a>
                <a href="{{ route('transactions.index') }}" class="btn btn-outline-light text-start"><i class="fas fa-receipt me-2"></i>Kelola Transaksi</a>
                <a href="{{ route('stocks.index') }}" class="btn btn-outline-light text-start"><i class="fas fa-cubes me-2"></i>Kelola Stok</a>
                <a href="{{ route('categories.index') }}" class="btn btn-outline-light text-start"><i class="fas fa-tags me-2"></i>Kelola Kategori</a>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mt-2">
    <div class="col-lg-7">
        <div class="card-dark p-3">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Produk Fokus</h5>
                <span class="badge bg-danger">Top 5</span>
            </div>
            <div class="table-responsive">
                <table class="table table-dark table-sm align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Stok</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topProducts as $product)
                            <tr>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->stock }}</td>
                                <td><span class="badge {{ $product->stock <= $product->minimum_stock ? 'bg-warning text-dark' : 'bg-success' }}">{{ $product->stock <= $product->minimum_stock ? 'Perlu restock' : 'Normal' }}</span></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-muted">Belum ada produktif.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card-dark p-3">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Chart Stok</h5>
                <span class="badge bg-success">Live</span>
            </div>
            <canvas id="stockChart" height="220"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('salesChart');
    const stockCtx = document.getElementById('stockChart');
    const stockLabels = @json($chartLabels);
    const stockValues = @json($chartValues);

    if (ctx) {
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan','Feb','Mar','Apr','Mei','Jun'],
                datasets: [{ label: 'Revenue', data: [120, 180, 220, 260, 310, 390], borderColor: '#FF2D2D', backgroundColor: 'rgba(255,45,45,0.2)', fill: true, tension: 0.4 }]
            },
            options: { responsive: true, plugins: { legend: { display: false } } }
        });
    }

    if (stockCtx) {
        new Chart(stockCtx, {
            type: 'bar',
            data: {
                labels: stockLabels.length ? stockLabels : ['Tidak ada data'],
                datasets: [{ label: 'Stok', data: stockValues.length ? stockValues : [0], backgroundColor: ['#FF2D2D','#ff6b6b','#ff8c42','#f6c23e','#45d0c2'] }]
            },
            options: { responsive: true, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } }
        });
    }
</script>
@endsection
