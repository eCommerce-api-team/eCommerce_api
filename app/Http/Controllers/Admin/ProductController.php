<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Api\ApiController;
use App\Services\Admin\ProductService;
use App\Http\Requests\Admin\ProductUpdateRequest;
use App\Http\Requests\Admin\ProductCreateRequest;
use App\Http\Resources\ProductResource;

class ProductController extends ApiController
{
    public function __construct(protected ProductService $productService){
    }
      public function index()
    {
        $products = $this->productService->getAllProducts();

        return $this->success(ProductResource::collection($products), 'All products');   
    }
    public function show(int $id)
    {
        $productDetails = $this->productService->getProductDetails($id);

        return $this->success(new ProductResource($productDetails), 'Product details');
    }

    public function update(ProductUpdateRequest $request, int $id)
    {
        $updateProduct = $this->productService->updateProduct($id, $request->validated());

        return $this->success(new ProductResource($updateProduct), 'Product updated successfully');
    }
    public function store(ProductCreateRequest $request)
    {
        $addProduct = $this->productService->addProduct($request->validated());

        return $this->success(new ProductResource($addProduct), 'Product added successfully');
    }
    public function destroy(string $id)
    {
        $deleteProduct = $this->productService->softDeleteProduct($id);

        return $this->success(new ProductResource($deleteProduct), 'Product deleted successfully');
    }
    public function forceDelete(string $id)
    {
        $forceDeleteProduct = $this->productService->deleteProduct($id);

        return $this->success(new ProductResource($forceDeleteProduct), 'Product permanently deleted');
    }
    public function restore(string $id)
    {
        $restoreProduct = $this->productService->restoreProduct($id);

        return $this->success(new ProductResource($restoreProduct), 'Product restored successfully');
    }
}
