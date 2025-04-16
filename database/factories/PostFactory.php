<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

final class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        $title = $this->faker->sentence(6);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'body' => $this->faker->paragraphs(5, true),
            'image' => $this->faker->imageUrl(800, 600, 'nature', true, 'Post'),
            'published' => $this->faker->boolean(80), // 80% chance of being published
            'featured' => $this->faker->boolean(20), // 20% chance of being featured
            'tags' => json_encode($this->faker->words(3)), // Random tags
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
