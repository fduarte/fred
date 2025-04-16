<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;

final class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure there are categories to assign posts to
        if (Category::count() === 0) {
            $this->call(CategorySeeder::class);
        }

        // Create 50 posts
        Post::factory()->count(50)->create();
    }
}
