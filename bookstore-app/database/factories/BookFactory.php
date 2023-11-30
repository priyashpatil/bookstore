<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $price = $this->faker->numberBetween(500, 3000);
        $discount = $this->faker->numberBetween(100, 300);
        return [
            'title' => $this->faker->sentence,
            'author' => $this->faker->name,
            'genre' => $this->faker->randomElement([
                'Science Fiction',
                'Fantasy',
                'Mystery/Thriller',
                'Historical Fiction',
                'Classic Literature',
                'Non-Fiction',
                'Science',
                'Self-Help/Motivational',
                'Dystopian Fiction',
                'Biography/Memoir']),
            'isbn' => $this->faker->unique()->isbn13(),
            'image' => $this->faker->imageUrl(width: 500, height: 650),
            'published' => $this->faker->date,
            'publisher' => $this->faker->company,
            'desc' => $this->faker->paragraphs(10, true),
            'price' => $price,
            'sale_price' => $price - $discount,
        ];
    }
}
