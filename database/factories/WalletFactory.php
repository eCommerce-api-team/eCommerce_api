<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Wallet;
use App\Models\User;

class WalletFactory extends Factory
{
    protected $model = Wallet::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
         
            'user_id' => User::inRandomOrder()->first()?->id ?? 1,

            'balance' => $this->faker->randomFloat(2, 10, 100),
        ];
    }
}