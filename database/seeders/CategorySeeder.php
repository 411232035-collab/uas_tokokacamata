<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['name' => 'Kacamata', 'slug' => 'kacamata', 'description' => 'Kategori produk kacamata'],
            ['name' => 'Aksesoris', 'slug' => 'aksesoris', 'description' => 'Kategori aksesoris pendukung'],
            ['name' => 'Lensa', 'slug' => 'lensa', 'description' => 'Kategori lensa kacamata'],
        ];

        foreach ($items as $item) {
            Category::firstOrCreate(['slug' => $item['slug']], $item);
        }
    }
}
