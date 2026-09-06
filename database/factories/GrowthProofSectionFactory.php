<?php

namespace Database\Factories;

use App\Models\GrowthProofSection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<GrowthProofSection>
 */
class GrowthProofSectionFactory extends Factory
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
            'label' => 'The Fastest Way to Grow',
            'title' => fake()->sentence(6),
        ];
    }
}
