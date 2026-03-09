<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\ApiBaseTest;

class ProductTest extends ApiBaseTest
{
    use RefreshDatabase;
   
    public function test_get_Products_List(): void
    {
        $response = $this->getJson('/api/product');

        $this->assertApiSuccess($response);
    }

    public function test_get_Product_Details(): void
    {
        $response = $this->getJson('/api/product/1');

        $this->assertApiSuccess($response);
    }
}
