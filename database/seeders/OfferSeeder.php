<?php

namespace Database\Seeders;

use App\Enums\DiscountType;
use App\Models\Offer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = now()->toDateTimeString();

        $offers = [
            ['product_id' => 1, 'name' => 'Second item with 50% discount', 'products_required' => 1, 'discount_type' => DiscountType::Percentage, 'discount' => 0.50],
        ];

        $offers = collect($offers)
            ->map(fn(array $product) => [...$product, 'created_at' => $date, 'updated_at' => $date])
            ->toArray();

        Offer::query()->insert($offers);
    }
}
