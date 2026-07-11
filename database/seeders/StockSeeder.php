<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Stock;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();
        foreach ($products as $product) {
            $stockCode = 'STK-' . now()->format('Ymd') . '-' . str_pad($product->id, 4, '0', STR_PAD_LEFT);

            Stock::updateOrCreate(['stock_code' => $stockCode], [
                'stock_code' => 'STK-' . now()->format('Ymd') . '-' . str_pad($product->id, 4, '0', STR_PAD_LEFT),
                'stock_date' => now()->toDateString(),
                'product_id' => $product->id,
                'qty' => $product->stock,
            ]);
        }
    }
}
