<?php

namespace Database\Factories;

use App\Models\GrowthProofItem;
use App\Models\GrowthProofSection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<GrowthProofItem>
 */
class GrowthProofItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'growth_proof_section_id' => GrowthProofSection::factory(),
            'label' => fake()->numerify('##'),
            'title' => fake()->sentence(6),
            'description' => fake()->sentence(16),
            'sort_order' => fake()->numberBetween(1, 20),
            'is_active' => true,
        ];
    }
}
