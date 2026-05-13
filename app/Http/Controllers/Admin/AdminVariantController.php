<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Admin\VariantCreateRequest;
use App\Http\Requests\Admin\VariantUpdateRequest;
use App\Http\Resources\VariantResource;
use App\Models\Variant;
use App\Services\Admin\VariantService;

class AdminVariantController extends ApiController
{
    public function __construct(protected VariantService $variantService) {}

    public function index()
    {
        $this->authorize('viewAny', Variant::class);

        $variants = $this->variantService->getAllVariants();

        return $this->success(VariantResource::collection($variants), 'All variants');
    }

    public function show(int $id)
    {
        $variant = $this->variantService->getVariantDetails($id);

        $this->authorize('view', $variant);

        return $this->success(new VariantResource($variant), 'Variant details');
    }

    public function update(VariantUpdateRequest $request, int $id)
    {
        $variant = $this->variantService->updateVariant($id, $request->validated());

        $this->authorize('update', $variant);

        return $this->success(new VariantResource($variant), 'variant updated successfully');
    }

    public function store(VariantCreateRequest $request)
    {
        $this->authorize('create', Variant::class);

        $addVariant = $this->variantService->addVariant($request->validated());

        return $this->success(new VariantResource($addVariant), 'Variant added successfully');
    }

    public function destroy(string $id)
    {
        $variant = $this->variantService->softDeleteVariant($id);

        $this->authorize('delete', $variant);

        return $this->success(new VariantResource($variant), 'variant deleted successfully');
    }

    public function forceDelete(string $id)
    {
        $variant = $this->variantService->deleteVariant($id);

        $this->authorize('forceDelete', $variant);

        return $this->success(new VariantResource($variant), 'variant permanently deleted');
    }

    public function restore(string $id)
    {
        $variant = $this->variantService->restoreVariant($id);

        $this->authorize('restore', $variant);

        return $this->success(new VariantResource($variant), 'variant restored successfully');
    }
}
