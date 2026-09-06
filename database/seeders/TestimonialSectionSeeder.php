<?php

namespace Database\Seeders;

use App\Models\TestimonialSection;
use Illuminate\Database\Seeder;

class TestimonialSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TestimonialSection::query()->updateOrCreate(
            ['singleton_key' => 1],
            [
                'label' => 'Testimonials',
                'title' => 'Where Amazon success stories are born',
                'description' => null,
            ],
        );
    }
}
