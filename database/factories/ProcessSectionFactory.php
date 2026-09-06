<?php

namespace Database\Factories;

use App\Models\ProcessSection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProcessSection>
 */
class ProcessSectionFactory extends Factory
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
            'label' => 'Our Process',
            'title' => fake()->sentence(4),
            'description' => fake()->sentence(),
        ];
    }
}
