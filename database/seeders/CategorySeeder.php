<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 5 parent categories
        Category::factory()->count(5)->create()->each(function ($parent) {
            // Create 3 child categories for each parent
            Category::factory()->count(3)->create([
                'parent_id' => $parent->id,
            ])->each(function ($child, $index) {
                // Assign a unique order within each parent
                $child->update(['order' => $index + 1]);
            });
        });
    }
}
