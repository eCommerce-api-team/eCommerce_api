<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\VariantResource;
use App\Services\VariantService;
class VariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(protected VariantService $variantService){
        $this->variantService = $variantService;
    }

    public function index()
    {
       $variants = $this->variantService->getAllVariant();
       
       return $this->success(VariantResource::collection($variants) , 'All Variants');
    }

}
