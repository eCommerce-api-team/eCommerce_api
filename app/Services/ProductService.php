<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    /**
     * Create a new class instance.
     */
    public function getAllProducts()
    {
        return Product::Filter($request)->get();
    }

    public function getProductDetails(int $id)
    {
        return Product::with('variants')->findOrFail($id);
    }
}
