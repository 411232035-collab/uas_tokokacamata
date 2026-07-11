<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'agus@gmail.com'],
            [
                'name' => 'Agus',
                'password' => Hash::make('salim1234'),
                'role' => 'admin',
            ]
        );

        User::firstOrCreate(
            ['email' => 'admin@smartcatalog.test'],
            [
                'name' => 'Admin Smart Catalog',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
            TransactionSeeder::class,
            StockSeeder::class,
        ]);
    }
}
