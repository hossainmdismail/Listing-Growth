<?php

namespace Database\Factories;

use App\Models\SeoPage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SeoPage>
 */
class SeoPageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $pageName = fake()->unique()->words(2, true);

        return [
            'page_name' => str($pageName)->title()->toString(),
            'page_key' => str($pageName)->slug()->toString(),
            'page_type' => 'static',
            'meta_title' => fake()->sentence(6),
            'meta_description' => fake()->sentence(16),
            'robots_index' => true,
            'robots_follow' => true,
            'is_active' => true,
        ];
    }
}
