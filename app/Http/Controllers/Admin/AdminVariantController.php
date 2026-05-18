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

    public function show(Variant $variant)
    {
        $this->authorize('view', $variant);

        $variant = $this->variantService->getVariantDetails($variant->id);

        return $this->success(new VariantResource($variant), 'Variant details');
    }

    public function update(VariantUpdateRequest $request, Variant $variant)
    {
        $this->authorize('update', $variant);

        $variant = $this->variantService->updateVariant($variant->id, $request->validated());

        return $this->success(new VariantResource($variant), 'variant updated successfully');
    }

    public function store(VariantCreateRequest $request)
    {
        $this->authorize('create', Variant::class);

        $addVariant = $this->variantService->addVariant($request->validated());

        return $this->success(new VariantResource($addVariant), 'Variant added successfully');
    }

    public function destroy(Variant $variant)
    {
        $this->authorize('delete', $variant);

        $variant = $this->variantService->softDeleteVariant($variant->id);

        return $this->success(new VariantResource($variant), 'variant deleted successfully');
    }

    public function forceDelete(int $id)
    {
        $variant = Variant::withTrashed()->findOrFail($id);

        $this->authorize('forceDelete', $variant);

        $this->variantService->deleteVariant($id);

        return $this->success(new VariantResource($variant), 'Variant permanently deleted');
    }

    public function restore(int $id)
    {
        $variant = Variant::withTrashed()->findOrFail($id);

        $this->authorize('restore', $variant);

        $variant = $this->variantService->restoreVariant($id);

        return $this->success(new VariantResource($variant), 'Variant restored successfully');
    }
}
