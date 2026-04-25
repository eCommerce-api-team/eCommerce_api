<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends ApiBaseTest
{
    use RefreshDatabase;

    public function test_order_checkout(): void
    {
        $user = \App\Models\User::factory()->create();

        $wallet = \App\Models\Wallet::factory()->create();

        $product = \App\Models\Product::factory()->create();

        $variant = \App\Models\Variant::factory()->create();

        $response = $this->actingAs($user, 'sanctum')
            ->postJson('api/checkout', [
                'variant_id' => $variant->id,
                'quantity' => 1,
            ]);

        $this->assertApiSuccess($response);
    }
}
