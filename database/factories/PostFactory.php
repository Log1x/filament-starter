<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'slug' => $this->faker->slug(),
            'content' => [[
                'type' => 'markdown',
                'data' => ['content' => $this->faker->paragraphs(5, true)],
            ]],
            'user_id' => 1,
            'is_published' => $this->faker->boolean(75),
            'published_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
