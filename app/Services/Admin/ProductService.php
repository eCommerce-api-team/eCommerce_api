<?php

namespace App\Services\Admin;

use App\Models\Product;

class ProductService
{
    public function getAllProducts($request = null, int $perPage = 10){
       return $products = Product::Filter($request)->paginate($perPage);
    }
    public function getProductDetails(int $id){
       return $product = Product::findOrFail($id);
    }
    public function addProduct(array $data){
       return $product = Product::create($data);
    }
    public function updateProduct(int $id, array $data){
        $product = Product::findOrFail($id);
        $product->update($data);

        return $product;
    }
    public function softDeleteProduct(int $id){
       $product = Product::findOrFail($id);
       $product->delete();

        return $product;
    }
    public function restoreProduct(int $id){
       $product = Product::withTrashed()->findOrFail($id);
       $product->restore();
       
        return $product;
    }
     public function deleteProduct(int $id) {
        $product = Product::withTrashed()->findOrFail($id);
        $product->forceDelete();

        return $product;
    }
}

