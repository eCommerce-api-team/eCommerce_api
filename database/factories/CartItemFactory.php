<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Cart;
use App\Models\Variant;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel:cartItem>
 */
class CartItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        
         'cart_id' => Cart::inRandomOrder()->first()?->id ?? 1, 
         
         'variant_id' => Variant::inRandomOrder()->first()?->id ?? 1, 

         'quantity' => $this->faker->numberBetween(1,5),

         'created_at' => now(),
            
         'updated_at' => now(),

        ];
    }
}
