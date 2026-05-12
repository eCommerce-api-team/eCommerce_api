<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Admin\ProductCreateRequest;
use App\Http\Requests\Admin\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\Admin\ProductService;

class ProductController extends ApiController
{
    public function __construct(protected ProductService $productService) {}

    public function index()
    {
        $this->authorize('viewAny', Product::class);

        $products = $this->productService->getAllProducts();

        return $this->success(ProductResource::collection($products), 'All products');
    }

    public function show(int $id)
    {
        $product = $this->productService->getProductDetails($id);

        $this->authorize('view', $product);

        return $this->success(new ProductResource($product), 'Product details');
    }

    public function update(ProductUpdateRequest $request, int $id)
    {
        $product = $this->productService->updateProduct($id, $request->validated());

        $this->authorize('update', $product);

        return $this->success(new ProductResource($product), 'Product updated successfully');
    }

    public function store(ProductCreateRequest $request)
    {
        $this->authorize('create', Product::class);

        $product = $this->productService->addProduct($request->validated());

        return $this->success(new ProductResource($product), 'Product added successfully');
    }

    public function destroy(string $id)
    {
        $product = $this->productService->softDeleteProduct($id);

        $this->authorize('delete', $product);

        return $this->success(new ProductResource($product), 'Product deleted successfully');
    }

    public function forceDelete(string $id)
    {
        $product = $this->productService->deleteProduct($id);

        $this->authorize('forceDelete', $product);

        return $this->success(new ProductResource($product), 'Product permanently deleted');
    }

    public function restore(string $id)
    {
        $product = $this->productService->restoreProduct($id);

        $this->authorize('restore', $product);

        return $this->success(new ProductResource($product), 'Product restored successfully');
    }
}
