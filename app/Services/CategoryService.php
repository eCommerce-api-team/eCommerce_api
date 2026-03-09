<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function getAllCategories($request = null)
    {

        return Category::Filter($request)->get();
    }

    public function getCategoryDetails(int $id)
    {

        return Category::with('products')->findOrFail($id);
    }
}
