<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\CategoryService;
use App\Http\Resources\Categories\CategoryResource;
use App\Http\Resources\Categories\CategoryDetailsResource;

class CategoryControllerResource extends ِApiController
{
    /**
     * Display a listing of the resource.
     */
    protected CategoryService $categoryService ;

    public function __construct(CategoryService $categoryService){
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->getAllCategories(); 
        return $this->success(CategoryResource::collection($categories),'All Categories');
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $categoryDetails = $this->categoryService->getCategoryDetails($id); 
        return $this->success( new CategoryDetailsResource($categoryDetails),'Category Details');
      
         
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
