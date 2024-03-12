<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $title = fake()->unique()->words(rand(1, 3), true);
        $slug = Str::of($title)->slug();
        $price = fake()->randomFloat(2, 10, 100);

        return [
            'title' => $title,
            'slug' => $slug,
            'description' => fake()->sentences(rand(1, 5), true),
            'SKU' => fake()->unique()->ean13(),
            'price' => $price,
            'new_price' => (rand(1, 5) % 2 === 0 ? fake()->randomFloat(2, 5, ($price - ($price * 0.05))) : null),
            'quantity' => rand(0, 20),
            'thumbnail' => fake()->imageUrl(),
        ];
    }
}
