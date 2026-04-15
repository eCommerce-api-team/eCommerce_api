<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    
    public function getAllProducts($request = null)
    {
        return Product::Filter($request)->where('stock','>',0)->get();
    }

    public function getProductDetails(int $id)
    {
        return Product::with('variants')->findOrFail($id);
    }
}
