<?php

namespace App\Services;
use App\Models\Category;

class CategoryService
{
    public function getAllCategories(){

    return Category::all();
    }  

    public function getCategoryDetails(int $id){

        return Category::with('products')->findOrFail($id);
    }
}
