<?php

namespace App\Services;
use App\Models\Variant;
class VariantService
{
    /**
     * Create a new class instance.
     */
   public function getVariant()
   {
      return Variant::Filter($request)->get();
   }
}
