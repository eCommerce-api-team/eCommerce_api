<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel:cart>
 */
class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        
         'user_id' => User::inRandomOrder()->first()?->id ?? 1, 

         'created_at' => now(),
            
         'updated_at' => now(),
         
        ];
    }
}
