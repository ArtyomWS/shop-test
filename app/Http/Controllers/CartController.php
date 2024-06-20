<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartResource;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): CartResource
    {
        $request->user()->cart
            ->load([
                'items' => [
                    'product',
                    'offer',
                ],
            ])
            ->loadSum('items', 'total')
            ->append(['delivery_price', 'total']);

        return CartResource::make($request->user()->cart);
    }
}
