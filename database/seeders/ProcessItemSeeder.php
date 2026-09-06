<?php

namespace Database\Seeders;

use App\Models\ProcessItem;
use App\Models\ProcessSection;
use Illuminate\Database\Seeder;

class ProcessItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $section = ProcessSection::singleton();

        $items = [
            [
                'label_number' => '01',
                'title' => 'Market & competitor research',
                'description' => 'We analyze your category, competitors, and target keywords to find where the real opportunity is.',
                'sort_order' => 1,
            ],
            [
                'label_number' => '02',
                'title' => 'Real shopper feedback',
                'description' => 'Genuine shoppers test your listing and product, giving honest insight into what\'s working and what isn\'t.',
                'sort_order' => 2,
            ],
            [
                'label_number' => '03',
                'title' => 'Listing & product optimization',
                'description' => 'We turn feedback into action — sharpened titles, images, and A+ content built to convert.',
                'sort_order' => 3,
            ],
            [
                'label_number' => '04',
                'title' => 'Rank, sell, repeat',
                'description' => 'Watch your product climb and sales follow, with monthly reporting to stay sharp as your category shifts.',
                'sort_order' => 4,
            ],
        ];

        foreach ($items as $item) {
            ProcessItem::query()->updateOrCreate(
                [
                    'process_section_id' => $section->id,
                    'sort_order' => $item['sort_order'],
                ],
                [...$item, 'is_active' => true],
            );
        }
    }
}
