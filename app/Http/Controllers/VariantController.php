<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\VariantResource;
use App\Services\VariantService;

class VariantController extends ApiController
{
    public function __construct(protected VariantService $variantService)
    {
        $this->variantService = $variantService;
    }

    public function index()
    {
        $variants = $this->variantService->getAllVariant();

        return $this->success(VariantResource::collection($variants), 'All Variants');
    }
}
