<?php

namespace Database\Factories;

use App\Models\WhyListingGrowthSection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<WhyListingGrowthSection>
 */
class WhyListingGrowthSectionFactory extends Factory
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
            'section_label' => 'Why ListingGrowth',
            'title' => fake()->sentence(6),
            'description' => fake()->sentence(14),
        ];
    }
}
