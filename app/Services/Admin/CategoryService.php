<?php

namespace App\Services\Admin;

use App\Models\Category;

class CategoryService
{
    public function getAllCategories($request = null, int $perPage = 10)
    {
        return $categories = Category::Filter($request)->paginate($perPage);
    }

    public function getCategoryDetails(int $id)
    {
        return $category = Category::findOrFail($id);
    }

    public function addCategory(array $data)
    {
        return $category = Category::create($data);
    }

    public function updateCategory(int $id, array $data)
    {
        $category = Category::findOrFail($id);
        $category->update($data);

        return $category;
    }

    public function softDeleteCategory(int $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return $category;
    }

    public function restoreCategory(int $id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        $category->restore();

        return $category;
    }

    public function deleteCategory(int $id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        $category->forceDelete();

        return $category;
    }
}
