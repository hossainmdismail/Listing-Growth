<?php

namespace Database\Factories;

use App\Models\GrowthProofSection;
use App\Models\GrowthProofStatistic;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<GrowthProofStatistic>
 */
class GrowthProofStatisticFactory extends Factory
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
            'label' => fake()->sentence(4),
            'value' => fake()->numerify('##%'),
            'sort_order' => fake()->numberBetween(1, 20),
            'is_active' => true,
        ];
    }
}
