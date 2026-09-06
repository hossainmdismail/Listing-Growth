<?php

namespace Database\Factories;

use App\Models\WhyListingGrowthItem;
use App\Models\WhyListingGrowthSection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<WhyListingGrowthItem>
 */
class WhyListingGrowthItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'why_listing_growth_section_id' => WhyListingGrowthSection::factory(),
            'label' => fake()->word(),
            'title' => fake()->sentence(6),
            'description' => fake()->sentence(16),
            'sort_order' => fake()->numberBetween(1, 20),
            'is_active' => true,
        ];
    }
}
