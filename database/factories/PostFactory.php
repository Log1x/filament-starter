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
        $content = [
            $this->faker->paragraphs(2, true),
            "## {$this->faker->sentence()}",
            $this->faker->paragraphs(3, true),
            "## {$this->faker->sentence()}",
            $this->faker->paragraphs(2, true),
            "### {$this->faker->sentence()}",
            $this->faker->paragraphs(3, true),
            "### {$this->faker->sentence()}",
            $this->faker->paragraphs(2, true),
            "## {$this->faker->sentence()}",
            $this->faker->paragraphs(3, true),
        ];

        return [
            'title' => $this->faker->sentence(),
            'slug' => $this->faker->slug(),
            'content' => [[
                'type' => 'markdown',
                'data' => ['content' => implode("\n\n", $content)],
            ]],
            'user_id' => 1,
            'is_published' => $this->faker->boolean(75),
            'published_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
