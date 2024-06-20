<?php

namespace App\Models;

use App\Enums\DiscountType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    protected $guarded = ['id'];

    protected static function booted(): void
    {
        static::creating(function (CartItem $cartItem) {
            $cartItem->calculateOffer();
        });
    }

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function offer(): BelongsTo
    {
        return $this->belongsTo(Offer::class);
    }

    public function calculateOffer(): void
    {
        $this->total = $this->product->price;

        if (!$this->product->offer) {
            return;
        }

        if ($this->cart->items()->where('product_id', $this->product_id)->whereNotNull('offer_id')->exists()) {
            return;
        }

        $sameCountInCart = $this->cart->items()->where('product_id', $this->product_id)->count();

        $offer = $this->product->offer;

        if ($offer->products_required > $sameCountInCart) {
            return;
        }

        $this->offer_id = $offer->id;

        $this->total = match ($offer->discount_type) {
            DiscountType::Percentage => round((float) $this->product->price * (float) $offer->discount, 2),
            // TODO: Need validation if price < 0
            DiscountType::Fixed => round((float) $this->product->price - (float) $offer->discount, 2),
        };
    }
}
