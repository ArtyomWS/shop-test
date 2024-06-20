<?php

namespace App\Http\Resources;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Cart */
class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'subtotal' => round((float) $this->whenAggregated('items', 'total', 'sum'), 2),
            'delivery_price' => $this->whenAppended('delivery_price'),
            'total' => $this->whenAppended('total'),
            'items' => CartItemResource::collection($this->whenLoaded('items')),
        ];
    }
}
