<?php

use App\Http\Controllers\AdminBannerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }

    return view('landing');
})->name('home');

Route::view('/fitur', 'features.index')->name('features.index');
Route::redirect('/features', '/fitur');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    $stats = [
        'revenue' => 0,
        'sales' => 0,
        'products' => 0,
        'stock' => 0,
    ];
    $systemInsights = [];
    $systemRecommendations = [];
    $reportingSummary = [
        'total_transactions' => 0,
        'total_qty' => 0,
        'total_revenue' => 0,
        'latest_transaction_date' => null,
    ];

    try {
        $transactions = \App\Models\Transaction::query();
        $lowStockProducts = \App\Models\Product::whereColumn('stock', '<=', 'minimum_stock')->orderBy('stock')->get();
        $zeroStockProducts = \App\Models\Product::where('stock', '<=', 0)->count();
        $topProduct = \App\Models\Transaction::with('product')
            ->selectRaw('product_id, SUM(qty) as total_qty, SUM(subtotal) as total_revenue')
            ->groupBy('product_id')
            ->orderByDesc('total_qty')
            ->first();

        $stats['revenue'] = (float) $transactions->sum('subtotal');
        $stats['sales'] = \App\Models\Transaction::count();
        $stats['products'] = \App\Models\Product::count();
        $stats['stock'] = (int) \App\Models\Stock::sum('qty');
        $averageTransaction = $stats['sales'] > 0 ? $stats['revenue'] / $stats['sales'] : 0;

        $reportingSummary = [
            'total_transactions' => $stats['sales'],
            'total_qty' => (int) \App\Models\Transaction::sum('qty'),
            'total_revenue' => $stats['revenue'],
            'latest_transaction_date' => \App\Models\Transaction::max('transaction_date'),
        ];

        $systemInsights = [
            [
                'label' => 'Penjualan aktif',
                'value' => $stats['sales'] . ' transaksi',
                'description' => 'Total revenue tercatat Rp ' . number_format($stats['revenue'], 0, ',', '.') . ' dari semua transaksi penjualan.',
                'icon' => 'fa-receipt',
                'color' => 'text-success',
            ],
            [
                'label' => 'Rata-rata transaksi',
                'value' => 'Rp ' . number_format($averageTransaction, 0, ',', '.'),
                'description' => 'Nilai ini membantu melihat kualitas transaksi per order.',
                'icon' => 'fa-chart-simple',
                'color' => 'text-info',
            ],
            [
                'label' => 'Produk perlu perhatian',
                'value' => $lowStockProducts->count() . ' produk',
                'description' => $zeroStockProducts . ' produk kosong dan sisanya sudah menyentuh batas minimum stok.',
                'icon' => 'fa-triangle-exclamation',
                'color' => $lowStockProducts->isNotEmpty() ? 'text-warning' : 'text-success',
            ],
            [
                'label' => 'Produk terlaris',
                'value' => $topProduct?->product?->product_name ?? 'Belum ada',
                'description' => $topProduct ? 'Terjual ' . (int) $topProduct->total_qty . ' unit dengan revenue Rp ' . number_format((float) $topProduct->total_revenue, 0, ',', '.') . '.' : 'Belum ada transaksi yang bisa dianalisis.',
                'icon' => 'fa-fire',
                'color' => 'text-danger',
            ],
        ];

        if ($lowStockProducts->isNotEmpty()) {
            $systemRecommendations[] = [
                'title' => 'Prioritaskan restock produk kritis',
                'body' => 'Segera cek ' . $lowStockProducts->take(3)->pluck('product_name')->join(', ') . ' karena stok sudah berada di bawah atau sama dengan minimum.',
                'action' => 'Buka halaman stok untuk menambah persediaan sebelum permintaan pelanggan terganggu.',
                'priority' => 'High',
            ];
        }

        if ($topProduct) {
            $systemRecommendations[] = [
                'title' => 'Pertahankan produk dengan demand tertinggi',
                'body' => $topProduct->product?->product_name . ' menjadi produk dengan pergerakan paling kuat berdasarkan jumlah unit terjual.',
                'action' => 'Pastikan stok aman dan gunakan produk ini sebagai fokus promosi atau bundling.',
                'priority' => 'Medium',
            ];
        }

        if ($stats['sales'] > 0) {
            $systemRecommendations[] = [
                'title' => 'Gunakan laporan untuk keputusan operasional',
                'body' => 'Data transaksi sudah cukup untuk dianalisis dan dibagikan ke stakeholder.',
                'action' => 'Generate Excel untuk seluruh data transaksi dan PDF untuk cetak ringkasan detail penjualan.',
                'priority' => 'Medium',
            ];
        }

        if (empty($systemRecommendations)) {
            $systemRecommendations[] = [
                'title' => 'Mulai kumpulkan data transaksi',
                'body' => 'Insight akan semakin kuat setelah transaksi, stok, dan produk aktif terisi.',
                'action' => 'Tambahkan produk dan catat transaksi penjualan pertama.',
                'priority' => 'Setup',
            ];
        }
    } catch (\Throwable $e) {
        // Tetap tampilkan dashboard walau database belum siap.
    }

    return view('dashboard', compact('stats', 'systemInsights', 'systemRecommendations', 'reportingSummary'));
})->middleware('auth')->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    Route::middleware(['role:admin'])->group(function () {
        Route::resource('products', ProductController::class)->only(['create', 'store', 'edit', 'update', 'destroy']);
    });
    Route::resource('products', ProductController::class)->only(['index', 'show']);

    Route::resource('categories', CategoryController::class);

    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/banner', [AdminBannerController::class, 'index'])->name('admin.banner');
        Route::post('/admin/banner', [AdminBannerController::class, 'store'])->name('admin.banner.store');
        Route::view('/admin/panel', 'admin.panel')->name('admin.panel');
    });

    Route::middleware(['role:admin'])->group(function () {
        Route::resource('transactions', TransactionController::class)->only(['create', 'store', 'edit', 'update', 'destroy']);
    });
    Route::resource('transactions', TransactionController::class)->only(['index', 'show']);

    Route::resource('stocks', StockController::class);

    Route::view('/staff/workspace', 'staff.workspace')->name('staff.workspace');

    Route::middleware(['role:admin'])->group(function () {
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/export-excel', [ReportController::class, 'exportExcel'])->name('reports.export-excel');
        Route::get('/reports/export-pdf', [ReportController::class, 'exportPdf'])->name('reports.export-pdf');
    });
});
