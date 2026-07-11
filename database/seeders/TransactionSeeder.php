<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();
        for ($i = 1; $i <= 30; $i++) {
            foreach ($products as $product) {
                if ($i % 2 === 0) {
                    $qty = ($i + $product->id) % 5 + 1;
                    $transactionNumber = 'TRX-202607' . str_pad($i, 2, '0', STR_PAD_LEFT) . '-' . str_pad($product->id, 2, '0', STR_PAD_LEFT);

                    Transaction::updateOrCreate(['transaction_number' => $transactionNumber], [
                        'transaction_number' => $transactionNumber,
                        'transaction_date' => now()->subDays(30 - $i)->toDateString(),
                        'merchant_code' => 'MRC' . str_pad($i % 5 + 1, 3, '0', STR_PAD_LEFT),
                        'product_id' => $product->id,
                        'qty' => $qty,
                        'price' => $product->selling_price,
                        'subtotal' => $product->selling_price * $qty,
                    ]);
                }
            }
        }
    }
}
