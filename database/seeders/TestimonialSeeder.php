<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use App\Models\TestimonialSection;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $section = TestimonialSection::singleton();

        $testimonials = [
            [
                'feedback' => 'Really thankful for the ListingGrowth team — one of the best organic ranking partners we\'ve worked with.',
                'name' => 'Client Name',
                'objective' => 'Brand Founder',
                'sort_order' => 1,
            ],
            [
                'feedback' => 'They took our product to Page 1 and kept it there for five straight years. Can\'t imagine launching without them.',
                'name' => 'Client Name',
                'objective' => 'E-commerce Director',
                'sort_order' => 2,
            ],
            [
                'feedback' => 'Buyer quality score is noticeably higher compared to every other service we\'ve tried.',
                'name' => 'Client Name',
                'objective' => 'Amazon Seller',
                'sort_order' => 3,
            ],
            [
                'feedback' => 'I\'ve trusted this team with my business for years — the results speak for themselves.',
                'name' => 'Client Name',
                'objective' => 'Brand CEO',
                'sort_order' => 4,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::query()->updateOrCreate(
                [
                    'testimonial_section_id' => $section->id,
                    'sort_order' => $testimonial['sort_order'],
                ],
                [...$testimonial, 'is_active' => true],
            );
        }
    }
}
