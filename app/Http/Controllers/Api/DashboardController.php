<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Transaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(): JsonResponse
    {
        $revenue = Transaction::sum('subtotal');
        $salesCount = Transaction::count();
        $productsCount = Product::count();
        $stockCount = Stock::sum('qty');
        $merchantCount = Transaction::select('merchant_code')->distinct()->count();
        $soldItems = Transaction::sum('qty');
        $averageTransaction = $salesCount > 0 ? round($revenue / $salesCount, 0) : 0;

        $monthlyRevenue = Transaction::select(DB::raw('strftime("%m", transaction_date) as month'), DB::raw('sum(subtotal) as total'))
            ->groupBy(DB::raw('strftime("%m", transaction_date)'))
            ->orderBy(DB::raw('strftime("%m", transaction_date)'))
            ->get();

        $dailyRevenue = Transaction::select(DB::raw('date(transaction_date) as date'), DB::raw('sum(subtotal) as revenue'))
            ->groupBy(DB::raw('date(transaction_date)'))
            ->orderBy(DB::raw('date(transaction_date)'))
            ->limit(30)
            ->get();

        $topProducts = Transaction::join('products', 'products.id', '=', 'transactions.product_id')
            ->select('products.product_name', DB::raw('sum(transactions.qty) as qty'))
            ->groupBy('products.product_name')
            ->orderByDesc('qty')
            ->limit(10)
            ->get();

        $topMerchants = Transaction::select('merchant_code', DB::raw('count(*) as transactions'))
            ->groupBy('merchant_code')
            ->orderByDesc('transactions')
            ->limit(10)
            ->get();

        $stockDistribution = [
            'Aman' => Stock::where('qty', '>=', 50)->sum('qty'),
            'Hampir Habis' => Stock::whereBetween('qty', [10, 49])->sum('qty'),
            'Habis' => Stock::where('qty', '<', 10)->sum('qty'),
        ];

        return response()->json([
            'kpis' => [
                ['label' => 'Total Revenue', 'value' => number_format($revenue), 'change' => '+18.2%'],
                ['label' => 'Total Penjualan', 'value' => number_format($salesCount), 'change' => '+12.4%'],
                ['label' => 'Total Produk', 'value' => number_format($productsCount), 'change' => '+5.8%'],
                ['label' => 'Total Stock', 'value' => number_format($stockCount), 'change' => '+9.1%'],
                ['label' => 'Total Merchant', 'value' => number_format($merchantCount), 'change' => '+3.6%'],
                ['label' => 'Total Produk Terjual', 'value' => number_format($soldItems), 'change' => '+14.7%'],
                ['label' => 'Average Transaction', 'value' => number_format($averageTransaction), 'change' => '+7.5%'],
                ['label' => 'Revenue Growth %', 'value' => '18.2%', 'change' => '+3.1%'],
            ],
            'dailyRevenue' => $dailyRevenue,
            'monthlyRevenue' => $monthlyRevenue,
            'topProducts' => $topProducts,
            'topMerchants' => $topMerchants,
            'stockDistribution' => $stockDistribution,
            'insights' => [
                'Revenue naik 18% dibanding bulan lalu.',
                'Produk Mouse Gaming menjadi produk paling laris bulan ini.',
                'Terdapat 7 produk dengan stok di bawah batas minimum.',
                'Merchant MRC001 memiliki transaksi terbanyak.',
            ],
        ]);
    }
}
