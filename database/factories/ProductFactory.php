<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel:product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'category_id' => Category::inRandomOrder()->first()?->id ?? 1,

            'name' => $this->faker->name(),

            'slug' => Str::slug('name').'-'.Str::random(5),

            'description' => $this->faker->sentence(),

            'base_price' => $this->faker->randomFloat(100, 10, 2),
            
            'stock' => $this->faker->numberBetween(0, 100),

            'created_at' => now(),

            'updated_at' => now(),

        ];
    }
}
