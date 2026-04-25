<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;

class VariantTest extends ApiBaseTest
{
    use RefreshDatabase;

    public function test_get_variant(): void
    {
        $product = \App\Models\Variant::factory()->create();

        $response = $this->getJson('/api/variant');

        $this->assertApiSuccess($response);
    }
}
