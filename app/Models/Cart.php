<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    protected $guarded = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    protected function deliveryPrice(): Attribute
    {
        return Attribute::get(function () {

            if (!$this->hasAttribute('items_sum_total')) {
                $this->loadSum('items', 'total');
            }

            return match (true) {
                (float) $this->items_sum_total >= 90.00 => 0.00,
                (float) $this->items_sum_total >= 50.00 => 2.95,
                default => 4.95
            };


        });
    }

    protected function total(): Attribute
    {
        return Attribute::get(function () {

            if (!$this->hasAttribute('items_sum_total')) {
                $this->loadSum('items', 'total');
            }

            return round( (float) $this->items_sum_total + $this->delivery_price, 2);

        });
    }
}
