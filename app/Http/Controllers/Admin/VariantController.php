<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Api\ApiController;
use App\Services\Admin\VariantService;
use App\Http\Requests\Admin\VariantUpdateRequest;
use App\Http\Requests\Admin\VariantCreateRequest;
use App\Http\Resources\VariantResource;

class variantController extends ApiController
{
    public function __construct(protected VariantService $variantService){
    }
      public function index()
    {
        $variants = $this->variantService->getAllVariants();

        return $this->success(VariantResource::collection($variants), 'All variants');   
    }
    public function show(int $id)
    {
        $variantDetails = $this->VariantService->getVariantDetails($id);

        return $this->success(new VariantResource($variantDetails), 'Variant details');
    }

    public function update(VariantUpdateRequest $request, int $id)
    {
        $updateVariant = $this->variantService->updateVariant($id, $request->validated());

        return $this->success(new VariantResource($updateVariant), 'variant updated successfully');
    }
    public function store(VariantCreateRequest $request)
    {
        $addVariant = $this->variantService->addVariant($request->validated());

        return $this->success(new VariantResource($addVariant), 'Variant added successfully');
    }
    public function destroy(string $id)
    {
        $deleteVariant = $this->variantService->softDeleteVariant($id);

        return $this->success(new VariantResource($deleteVariant), 'variant deleted successfully');
    }
    public function forceDelete(string $id)
    {
        $forceDeleteVariant = $this->variantService->deleteVariant($id);

        return $this->success(new VariantResource($forceDeleteVariant), 'variant permanently deleted');
    }
    public function restore(string $id)
    {
        $restoreVariant = $this->variantService->restoreVariant($id);

        return $this->success(new VariantResource($restoreVariant), 'variant restored successfully');
    }
}
