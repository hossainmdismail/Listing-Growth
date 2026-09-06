<?php

namespace Database\Seeders;

use App\Models\GrowthProofItem;
use App\Models\GrowthProofSection;
use Illuminate\Database\Seeder;

class GrowthProofItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $section = GrowthProofSection::singleton();

        $items = [
            [
                'label' => '01',
                'title' => 'Page 1 ranking, not page 5',
                'description' => 'We boost your Best Seller Rank quickly while staying fully compliant with Amazon\'s Terms of Service.',
                'sort_order' => 1,
            ],
            [
                'label' => '02',
                'title' => 'More eyes, more sales',
                'description' => 'We make your product genuinely discoverable so shoppers find you before they find your competitors.',
                'sort_order' => 2,
            ],
            [
                'label' => '03',
                'title' => 'A brand people trust',
                'description' => 'People buy from brands they recognize. We help you build credibility that compounds over time.',
                'sort_order' => 3,
            ],
            [
                'label' => '04',
                'title' => 'Feedback from real shoppers',
                'description' => 'Your target market audits the entire buying experience, from listing to unboxing.',
                'sort_order' => 4,
            ],
        ];

        foreach ($items as $item) {
            GrowthProofItem::query()->updateOrCreate(
                [
                    'growth_proof_section_id' => $section->id,
                    'label' => $item['label'],
                ],
                [...$item, 'is_active' => true],
            );
        }
    }
}
