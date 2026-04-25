<?php

namespace Tests\Feature;

use App\Events\OrderPlaced;
use App\Listeners\SendOrderEmailListener;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SendOrderEmailListenerTest extends ApiBaseTest
{
    use RefreshDatabase;

    public function test_listener_handle_event()
    {
        $user = \App\Models\User::factory()->create();

        $wallet = \App\Models\Wallet::factory()->create();

        $product = \App\Models\Product::factory()->create();

        $variant = \App\Models\Variant::factory()->create();

        $order = \App\Models\Order::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'total_amount' => 100,
            'status' => 'pending',
        ]);
        $response = $this->actingAs($user, 'sanctum')
            ->postJson('api/checkout', [
                'variant_id' => $variant->id,
                'quantity' => 1,
            ]);
        $event = new OrderPlaced($order);

        (new SendOrderEmailListener)->handle($event);

        $this->assertApiSuccess($response);
    }
}
