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
            'name' => fake()->name(),
            'price' => fake()->randomFloat(2, 0, 100),
            'stock' => fake()->randomNumber(2, 0, 10),
            'description' => fake()->sentence(10),
            'address' => fake()->streetAddress(),
            'addres_detail' => fake()->text(50),
            'date_info' => fake()->date(),
            'grade' => fake()->randomElement(['Grade A', 'Grade B']),
            'image' => fake()->imageUrl(640, 480, 'products', true),
            'latitude' => fake()->latitude(),
            'longitude' => fake()->longitude(),
        ];
    }
}
