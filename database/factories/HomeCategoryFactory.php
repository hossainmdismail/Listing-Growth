<?php

namespace Database\Factories;

use App\Models\CategorySection;
use App\Models\HomeCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<HomeCategory>
 */
class HomeCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_section_id' => CategorySection::factory(),
            'name' => fake()->unique()->words(2, true),
            'sort_order' => fake()->numberBetween(1, 20),
            'is_active' => true,
        ];
    }
}
