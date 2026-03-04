<?php

namespace App\Services;
use App\Models\Product;

class ProductService
{
    /**
     * Create a new class instance.
     */
    public function getAllProducts(){
        return Product::lazyById(100);  
    }

    public function getProductDetails(int $id){
        return Product::with('variants')->findOrFail($id);
    }
}
