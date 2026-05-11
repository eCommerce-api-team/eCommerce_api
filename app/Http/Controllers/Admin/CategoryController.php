<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Api\ApiController;
use App\Services\Admin\CategoryService;
use App\Http\Requests\Admin\CategoryUpdateRequest;
use App\Http\Requests\Admin\CategoryCreateRequest;
use App\Http\Resources\CategoryResource;

class CategoryController extends ApiController
{
    public function __construct(protected CategoryService $categoryService){
    }
      public function index()
    {
        $categories = $this->categoryService->getAllCategories();

        return $this->success(CategoryResource::collection($categories), 'All categories');   
    }
    public function show(int $id)
    {
        $categoryDetails = $this->categoryService->getCategoryDetails($id);

        return $this->success(new CategoryResource($categoryDetails), 'Category details');
    }

    public function update(CategoryUpdateRequest $request, int $id)
    {
        $updateCategory = $this->categoryService->updateCategory($id, $request->validated());

        return $this->success(new CategoryResource($updateCategory), 'Category updated successfully');
    }
    public function store(CategoryCreateRequest $request)
    {
        $addCategory = $this->categoryService->addCategory($request->validated());

        return $this->success(new CategoryResource($addCategory), 'Category added successfully');
    }
    public function destroy(string $id)
    {
        $deleteCategory = $this->categoryService->softDeleteCategory($id);

        return $this->success(new CategoryResource($deleteCategory), 'Category deleted successfully');
    }
    public function forceDelete(string $id)
    {
        $forceDeleteCategory = $this->categoryService->deleteCategory($id);

        return $this->success(new CategoryResource($forceDeleteCategory), 'Category permanently deleted');
    }
    public function restore(string $id)
    {
        $restoreCategory = $this->categoryService->restoreCategory($id);

        return $this->success(new CategoryResource($restoreCategory), 'Category restored successfully');
    }
}
