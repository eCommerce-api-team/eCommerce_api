<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Admin\CategoryCreateRequest;
use App\Http\Requests\Admin\CategoryUpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\Admin\CategoryService;

class AdminCategoryController extends ApiController
{
    public function __construct(protected CategoryService $categoryService) {}

    public function index()
    {
        $this->authorize('viewAny', Category::class);

        $categories = $this->categoryService->getAllCategories();

        return $this->success(CategoryResource::collection($categories), 'All categories');
    }

    public function show(Category $category)
    {
        $this->authorize('view', $category);

        $category = $this->categoryService->getCategoryDetails($category->id);

        return $this->success(new CategoryResource($category), 'Category details');
    }

    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $this->authorize('update', $category);

        $category = $this->categoryService->updateCategory($category->id, $request->validated());

        return $this->success(new CategoryResource($category), 'Category updated successfully');
    }

    public function store(CategoryCreateRequest $request, Category $category)
    {
        $this->authorize('create', Category::class);

        $addCategory = $this->categoryService->addCategory($request->validated());

        return $this->success(new CategoryResource($addCategory), 'Category added successfully');
    }

    public function destroy(Category $category)
    {
        $this->authorize('delete', $category);

        $category = $this->categoryService->softDeleteCategory($category->id);

        return $this->success(new CategoryResource($category), 'Category deleted successfully');
    }

    public function forceDelete(int $id)
    {
        $category = Category::withTrashed()->findOrFail($id);

        $this->authorize('forceDelete', $category);

        $this->categoryService->deleteCategory($id);

        return $this->success(new CategoryResource($category), 'Category permanently deleted');
    }

    public function restore(int $id)
    {
        $category = Category::withTrashed()->findOrFail($id);

        $this->authorize('restore', $category);

        $category = $this->categoryService->restoreCategory($id);

        return $this->success(new CategoryResource($category), 'Category restored successfully');
    }
}
