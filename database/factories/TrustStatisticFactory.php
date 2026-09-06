<?php

namespace Database\Factories;

use App\Models\TrustStatistic;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TrustStatistic>
 */
class TrustStatisticFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'field_name' => fake()->words(2, true),
            'field_value' => fake()->numerify('###+'),
            'sort_order' => fake()->numberBetween(0, 20),
            'is_active' => true,
        ];
    }
}
