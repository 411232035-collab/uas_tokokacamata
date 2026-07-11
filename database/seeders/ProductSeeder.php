<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::pluck('id', 'slug');

        $items = [
            ['product_code' => 'PRD001', 'product_name' => 'Ray-Ban Aviator Classic', 'category_id' => $categories['kacamata'] ?? null, 'purchase_price' => 1600000, 'selling_price' => 2990000, 'stock' => 24, 'minimum_stock' => 8, 'photo_path' => 'https://flightsunglasses.com/cdn/shop/products/greenav_2048x.png?v=1509219421'],
            ['product_code' => 'PRD002', 'product_name' => 'Ray-Ban Wayfarer', 'category_id' => $categories['kacamata'] ?? null, 'purchase_price' => 1450000, 'selling_price' => 2690000, 'stock' => 18, 'minimum_stock' => 6, 'photo_path' => 'https://gearmoose.com/wp-content/uploads/2023/06/Ray-Ban-Original-Wayfarer-Sunglasses.jpg'],
            ['product_code' => 'PRD003', 'product_name' => 'Gucci GG0061S', 'category_id' => $categories['kacamata'] ?? null, 'purchase_price' => 2200000, 'selling_price' => 3890000, 'stock' => 12, 'minimum_stock' => 5, 'photo_path' => 'https://www.fashioneyewear.com/cdn/shop/products/0003_GG0061S00156.jpg?v=1683893504'],
            ['product_code' => 'PRD004', 'product_name' => 'Prada PR 52', 'category_id' => $categories['kacamata'] ?? null, 'purchase_price' => 2400000, 'selling_price' => 4190000, 'stock' => 3, 'minimum_stock' => 4, 'photo_path' => 'https://www.fashioneyewear.com/cdn/shop/products/0000_PRB52S5AK09Z.jpg'],
            ['product_code' => 'PRD005', 'product_name' => 'Oakley Holbrook', 'category_id' => $categories['kacamata'] ?? null, 'purchase_price' => 1200000, 'selling_price' => 2390000, 'stock' => 20, 'minimum_stock' => 7, 'photo_path' => 'https://www.skates.ro/bmz_cache/o/oakley-holbrook-polished-black-prizm-black-oo9102-e155jpg-2022.image.700x700.jpg'],
            ['product_code' => 'PRD006', 'product_name' => 'Versace VE2230', 'category_id' => $categories['kacamata'] ?? null, 'purchase_price' => 2100000, 'selling_price' => 3690000, 'stock' => 4, 'minimum_stock' => 4, 'photo_path' => 'https://assets2.lenscrafters.com/prod-onecp-record-files/pieyewear/608aa589-7c34-4a00-87ab-b37000ff92b2/0VE2290__100180__P21__noshad__fr.png?imwidth=700'],
            ['product_code' => 'PRD007', 'product_name' => 'Dior Dioriviera', 'category_id' => $categories['kacamata'] ?? null, 'purchase_price' => 2600000, 'selling_price' => 4490000, 'stock' => 2, 'minimum_stock' => 3, 'photo_path' => 'https://www.mrporter.com/variants/images/1647597338768892/in/w2000_q60.jpg'],
        ];

        foreach ($items as $item) {
            Product::updateOrCreate(
                ['product_code' => $item['product_code']],
                $item
            );
        }
    }
}
