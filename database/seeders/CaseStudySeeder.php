<?php

namespace Database\Seeders;

use App\Models\CaseStudy;
use Illuminate\Database\Seeder;

class CaseStudySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $caseStudies = [
            [
                'label' => 'Home & Outdoor',
                'subtitle' => '$0 to $178K in 30 days',
                'title' => 'Page 5 → Page 1',
                'short_description' => 'A 4-step ranking strategy combining keyword-targeted external traffic with real shopper feedback, for the competitive keyword "pool basketball hoop."',
                'statistics' => [
                    ['value' => '$178K', 'label' => 'Revenue / 30 days'],
                    ['value' => '200%', 'label' => 'ROI'],
                    ['value' => '10 days', 'label' => 'To Page 1'],
                ],
                'sort_order' => 1,
            ],
            [
                'label' => 'Electronics',
                'subtitle' => 'Ranked & sustained for 18 months',
                'title' => 'Page 4 → #3',
                'short_description' => 'Ongoing monthly optimization kept this listing inside the top 5 results through two category-wide algorithm shifts.',
                'statistics' => [
                    ['value' => '$94K', 'label' => 'Revenue / 30 days'],
                    ['value' => '3.4x', 'label' => 'Sales growth'],
                    ['value' => '18 mo', 'label' => 'Sustained rank'],
                ],
                'sort_order' => 2,
            ],
        ];

        foreach ($caseStudies as $caseStudy) {
            CaseStudy::query()->updateOrCreate(
                ['sort_order' => $caseStudy['sort_order']],
                [...$caseStudy, 'content' => null, 'is_active' => true],
            );
        }
    }
}
