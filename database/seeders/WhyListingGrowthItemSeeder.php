<?php

namespace Database\Seeders;

use App\Models\WhyListingGrowthItem;
use App\Models\WhyListingGrowthSection;
use Illuminate\Database\Seeder;

class WhyListingGrowthItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $section = WhyListingGrowthSection::singleton();

        $items = [
            [
                'label' => 'Rank',
                'title' => 'Rank #1 for your top keywords',
                'description' => 'Organic rank builds lasting brand authority — it doesn\'t switch off the moment your ad budget does.',
                'sort_order' => 1,
            ],
            [
                'label' => 'Compete',
                'title' => 'Grow lean, beat bigger rivals',
                'description' => 'Outrank competitors with deeper ad budgets using a cost-efficient method built on visibility, not spend.',
                'sort_order' => 2,
            ],
            [
                'label' => 'Build',
                'title' => 'Build products people actually want',
                'description' => 'Pre- and post-launch testing gives real customer insight — shape product and listing around what shoppers respond to.',
                'sort_order' => 3,
            ],
            [
                'label' => 'Price',
                'title' => 'Nail your pricing strategy',
                'description' => 'See your product through your customer\'s eyes and price competitively without leaving money on the table.',
                'sort_order' => 4,
            ],
            [
                'label' => 'Protect',
                'title' => 'Start with a strong reputation',
                'description' => 'Catch issues before they become bad reviews — fewer returns, stronger long-term listing health.',
                'sort_order' => 5,
            ],
        ];

        foreach ($items as $item) {
            WhyListingGrowthItem::query()->updateOrCreate(
                [
                    'why_listing_growth_section_id' => $section->id,
                    'label' => $item['label'],
                ],
                [...$item, 'is_active' => true],
            );
        }
    }
}
