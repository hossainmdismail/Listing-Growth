<?php

namespace Database\Seeders;

use App\Models\FaqItem;
use App\Models\FaqSection;
use Illuminate\Database\Seeder;

class FaqItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $section = FaqSection::singleton();

        $items = [
            [
                'question' => 'Is ListingGrowth\'s approach "white hat"?',
                'answer' => 'Yes. We only use ethical, TOS-compliant methods — genuine shoppers who independently discover, purchase, and evaluate your product. No fake reviews, no shortcuts.',
                'sort_order' => 1,
            ],
            [
                'question' => 'How do you determine the best keywords for my product?',
                'answer' => 'We combine tools like Helium 10 with manual market research to find high-conversion, low-competition keywords for a balanced traffic and sales approach.',
                'sort_order' => 2,
            ],
            [
                'question' => 'How does external traffic improve my Amazon ranking?',
                'answer' => 'Amazon rewards listings that pull in diverse traffic from outside the platform. Targeted external shoppers signal demand and strengthen your organic position.',
                'sort_order' => 3,
            ],
            [
                'question' => 'How long until I see results?',
                'answer' => 'Most clients see measurable ranking and traffic improvement within 2–6 weeks, with ongoing optimization to sustain it long-term.',
                'sort_order' => 4,
            ],
            [
                'question' => 'Do I still need PPC if I work with you?',
                'answer' => 'No — but you can absolutely pair both. Many clients combine organic ranking with a lean PPC strategy for maximum reach.',
                'sort_order' => 5,
            ],
        ];

        foreach ($items as $item) {
            FaqItem::query()->updateOrCreate(
                [
                    'faq_section_id' => $section->id,
                    'sort_order' => $item['sort_order'],
                ],
                [...$item, 'is_active' => true],
            );
        }
    }
}
