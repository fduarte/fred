<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        /**
         * There's an unique constraint on parent_id and order
         * so we'll need to handle it separately, via the seeder, etc.
         */
        return [
            'name' => $this->faker->word(),
            'parent_id' => $this->faker->optional()->randomElement(Category::pluck('id')->toArray()),
            'order' => null, // Handled dynamically in the seeder
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
