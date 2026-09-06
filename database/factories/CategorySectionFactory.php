<?php

namespace Database\Factories;

use App\Models\CategorySection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CategorySection>
 */
class CategorySectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'singleton_key' => 1,
            'label' => 'Categories',
            'title' => fake()->sentence(6),
            'description' => fake()->sentence(14),
        ];
    }
}
