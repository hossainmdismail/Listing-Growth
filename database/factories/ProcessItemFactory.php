<?php

namespace Database\Factories;

use App\Models\ProcessItem;
use App\Models\ProcessSection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProcessItem>
 */
class ProcessItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'process_section_id' => ProcessSection::factory(),
            'label_number' => fake()->numerify('##'),
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(),
            'sort_order' => fake()->numberBetween(1, 20),
            'is_active' => true,
        ];
    }
}
