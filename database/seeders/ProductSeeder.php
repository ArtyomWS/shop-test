<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = now()->toDateTimeString();

        $products = [
            ['name' => 'Red Widget', 'code' => 'R01', 'price' => 32.95],
            ['name' => 'Green Widget', 'code' => 'G01', 'price' => 24.95],
            ['name' => 'Blue Widget', 'code' => 'B01', 'price' => 7.95],
        ];

        $products = collect($products)
            ->map(fn(array $product) => [...$product, 'created_at' => $date, 'updated_at' => $date])
            ->toArray();

        Product::query()->insert($products);
    }
}
