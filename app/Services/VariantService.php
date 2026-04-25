<?php

namespace App\Services;

use App\Models\Variant;

class VariantService
{
    public function getAllVariant($request = null)
    {
        return Variant::Filter($request)->where('variant_stock', '>', 0)->get();
    }
}
