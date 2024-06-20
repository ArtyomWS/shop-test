<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $products = Product::query()
            ->with(['offer'])
            ->latest('id')
            ->cursorPaginate($request->integer('per_page', 10));

        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // TODO: Implement
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // TODO: Implement
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // TODO: Implement
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // TODO: Implement
    }
}
