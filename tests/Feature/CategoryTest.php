<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\ApiBaseTest;

class CategoryTest extends ApiBaseTest
{
    use RefreshDatabase;

    public function test_get_Categories_List(): void
    {
       $category = \App\Models\Category::factory()->create();
      
       $response = $this->getJson('/api/category');

        $this->assertApiSuccess($response);
    }
    
    public function test_get_Category_Details(): void
    {
          
    $category = \App\Models\Category::factory()->create();

   
    $response = $this->getJson('/api/category/'.$category->id);

        $this->assertApiSuccess($response);
    }
}
