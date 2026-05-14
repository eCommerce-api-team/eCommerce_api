<?php

namespace App\Services\Admin;

use App\Models\Variant;

class VariantService
{
    public function getAllVariants($request = null, int $perPage = 10)
    {
        return $variants = Variant::Filter($request)->paginate($perPage);
    }

    public function getVariantDetails(int $id)
    {
        return $variant = Variant::findOrFail($id);
    }

    public function addVariant(array $data)
    {
        return $variant = Variant::create($data);
    }

    public function updateVariant(int $id, array $data)
    {
        $variant = Variant::findOrFail($id);
        $variant->update($data);

        return $variant;
    }

    public function softDeleteVariant(int $id)
    {
        $variant = Variant::findOrFail($id);
        $variant->delete();

        return $variant;
    }

    public function restoreVariant(int $id)
    {
        $variant = Variant::withTrashed()->findOrFail($id);
        $variant->restore();

        return $variant;
    }

    public function deleteVariant(int $id)
    {
        $variant = Variant::withTrashed()->findOrFail($id);
        $variant->forceDelete();

        return $variant;
    }
}
