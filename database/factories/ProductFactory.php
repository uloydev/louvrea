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
            'name' => $this->faker->sentence(3),
            'short_description' => ($this->faker->randomDigitNotZero() * 10) . 'ml',
            'description' => $this->faker->paragraph(7),
            'price' => $this->faker->randomDigitNotZero() * 10000,
            'stock' => $this->faker->randomDigitNotZero() * 2,
            'image' => 'img/bbb.jpg',
        ];
    }
}
