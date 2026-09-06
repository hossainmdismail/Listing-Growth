<?php

namespace Database\Factories;

use App\Models\HomeService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<HomeService>
 */
class HomeServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'icon_path' => 'home-services/icons/ranking-optimization.svg',
            'title' => fake()->sentence(3),
            'short_description' => fake()->paragraph(),
            'button_label' => 'Learn more',
            'button_url' => '/services',
            'sort_order' => fake()->numberBetween(0, 20),
            'is_active' => true,
        ];
    }
}
