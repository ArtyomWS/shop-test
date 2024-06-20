<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartItemRequest;
use App\Http\Resources\CartItemResource;
use App\Models\CartItem;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Throwable;

class CartItemController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(CartItemRequest $request): CartItemResource
    {
        $cartItem = $request->user()->cart->items()->create($request->validated());

       return CartItemResource::make($cartItem);
    }

    /**
     * Remove the specified resource from storage.
     * @throws Throwable
     */
    public function destroy(CartItem $cartItem): JsonResponse
    {
        // TODO: Must be with policy
        Gate::allowIf(fn(User $user) => $user->cart->id === $cartItem->cart_id);

        $cartItem->deleteOrFail();

        return response()->json(null);
    }
}
