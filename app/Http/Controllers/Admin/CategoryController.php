<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Admin\CategoryCreateRequest;
use App\Http\Requests\Admin\CategoryUpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\Admin\CategoryService;

class CategoryController extends ApiController
{
    public function __construct(protected CategoryService $categoryService) {}

    public function index()
    {
        $this->authorize('viewAny', Category::class);

        $categories = $this->categoryService->getAllCategories();

        return $this->success(CategoryResource::collection($categories), 'All categories');
    }

    public function show(int $id)
    {
        $category = $this->categoryService->getCategoryDetails($id);

        $this->authorize('view', $category);

        return $this->success(new CategoryResource($category), 'Category details');
    }

    public function update(CategoryUpdateRequest $request, int $id)
    {
        $category = $this->categoryService->updateCategory($id, $request->validated());

        $this->authorize('update', $category);

        return $this->success(new CategoryResource($category), 'Category updated successfully');
    }

    public function store(CategoryCreateRequest $request)
    {
        $this->authorize('create', Category::class);

        $addCategory = $this->categoryService->addCategory($request->validated());

        return $this->success(new CategoryResource($addCategory), 'Category added successfully');
    }

    public function destroy(string $id)
    {
        $category = $this->categoryService->softDeleteCategory($id);

        $this->authorize('delete', $category);

        return $this->success(new CategoryResource($category), 'Category deleted successfully');
    }

    public function forceDelete(string $id)
    {
        $category = $this->categoryService->deleteCategory($id);

        $this->authorize('forceDelete', $category);

        return $this->success(new CategoryResource($category), 'Category permanently deleted');
    }

    public function restore(string $id)
    {
        $category = $this->categoryService->restoreCategory($id);

        $this->authorize('restore', $category);

        return $this->success(new CategoryResource($category), 'Category restored successfully');
    }
}
