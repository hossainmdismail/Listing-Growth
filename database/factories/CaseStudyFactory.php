<?php

namespace Database\Factories;

use App\Models\CaseStudy;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CaseStudy>
 */
class CaseStudyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'label' => fake()->randomElement(['Home & Outdoor', 'Electronics', 'Beauty']),
            'subtitle' => fake()->sentence(6),
            'title' => 'Page 5 → Page 1',
            'short_description' => fake()->paragraph(),
            'content' => null,
            'statistics' => [
                ['label' => 'Revenue / 30 days', 'value' => '$178K'],
                ['label' => 'ROI', 'value' => '200%'],
            ],
            'sort_order' => fake()->numberBetween(1, 20),
            'is_active' => true,
        ];
    }
}
