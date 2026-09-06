<?php

namespace Database\Seeders;

use App\Models\HomeService;
use Illuminate\Database\Seeder;

class HomeServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'icon_path' => 'home-services/icons/ranking-optimization.svg',
                'title' => 'Ranking Optimization',
                'short_description' => 'Full-funnel organic strategy — keyword research, external traffic, and listing improvements built to push you up the results and keep you there.',
                'button_label' => 'Learn more',
                'button_url' => '/services',
                'sort_order' => 1,
            ],
            [
                'icon_path' => 'home-services/icons/pre-launch-lab.svg',
                'title' => 'Pre-Launch Lab',
                'short_description' => 'Test your product with real shoppers before launch. Honest feedback on packaging, pricing, and positioning — before it costs you sales.',
                'button_label' => 'Learn more',
                'button_url' => '/services',
                'sort_order' => 2,
            ],
            [
                'icon_path' => 'home-services/icons/keyword-research.svg',
                'title' => 'Keyword & Competitor Research',
                'short_description' => 'High-conversion, low-competition keywords, mapped directly against where your top competitors stand today.',
                'button_label' => 'Learn more',
                'button_url' => '/services',
                'sort_order' => 3,
            ],
            [
                'icon_path' => 'home-services/icons/external-traffic.svg',
                'title' => 'External Traffic Campaigns',
                'short_description' => 'Amazon rewards listings that pull traffic from outside the platform. We send targeted shoppers using the exact keywords you want to own.',
                'button_label' => 'Learn more',
                'button_url' => '/services',
                'sort_order' => 4,
            ],
            [
                'icon_path' => 'home-services/icons/listing-optimization.svg',
                'title' => 'Listing & Conversion Optimization',
                'short_description' => 'Titles, images, A+ content — refined from real shopper behavior so more clicks turn into sales.',
                'button_label' => 'Learn more',
                'button_url' => '/services',
                'sort_order' => 5,
            ],
            [
                'icon_path' => 'home-services/icons/strategy-consultation.svg',
                'title' => '1-on-1 Strategy Consultation',
                'short_description' => 'Direct access to a growth strategist for a tailored roadmap — launch planning, pricing, or fixing a ranking drop.',
                'button_label' => 'Book a call',
                'button_url' => '/contact',
                'sort_order' => 6,
            ],
        ];

        foreach ($services as $service) {
            HomeService::query()->updateOrCreate(
                ['title' => $service['title']],
                [...$service, 'is_active' => true],
            );
        }
    }
}
