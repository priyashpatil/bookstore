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
        return [
            'title' => $this->faker->title,
            'author' => $this->faker->name,
            'genre' => $this->faker->word,
            'image' => $this->faker->imageUrl,
            'published' => $this->faker->date,
            'publisher' => $this->faker->company,
            'desc' => $this->faker->paragraphs(3, true)
        ];
    }
}
