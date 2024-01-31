<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
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
            'name' => $this->faker->word(3),
            'description' => $this->faker->sentence,
            'price' => $this->faker->numberBetween(100, 1000),
            'quantity' => $this->faker->numberBetween(0, 100)
        ];
    }
}
