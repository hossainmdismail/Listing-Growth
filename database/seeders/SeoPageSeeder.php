<?php

namespace Database\Seeders;

use App\Models\SeoPage;
use Illuminate\Database\Seeder;

class SeoPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SeoPage::query()->updateOrCreate(
            ['page_key' => 'home'],
            [
                'page_name' => 'Home',
                'page_type' => 'static',
                'meta_title' => 'ListingGrowth | Rank #1 on Amazon Organically',
                'meta_description' => 'Grow your Amazon listing organically with proven ranking strategy, shopper feedback, and targeted external traffic.',
                'robots_index' => true,
                'robots_follow' => true,
                'is_active' => true,
            ],
        );

        SeoPage::query()->updateOrCreate(
            ['page_key' => 'contact'],
            [
                'page_name' => 'Contact',
                'page_type' => 'static',
                'meta_title' => 'Contact ListingGrowth | Free Amazon SEO Audit',
                'meta_description' => 'Tell us about your Amazon listing and receive a free audit with a tailored organic growth plan.',
                'robots_index' => true,
                'robots_follow' => true,
                'is_active' => true,
            ],
        );

        SeoPage::query()->updateOrCreate(
            ['page_key' => 'about'],
            [
                'page_name' => 'About',
                'page_type' => 'static',
                'meta_title' => 'About ListingGrowth | Organic Amazon Growth',
                'meta_description' => 'Learn why ListingGrowth helps Amazon sellers earn durable organic rankings through search strategy and real shopper feedback.',
                'robots_index' => true,
                'robots_follow' => true,
                'is_active' => true,
            ],
        );

        SeoPage::query()->updateOrCreate(
            ['page_key' => 'services'],
            [
                'page_name' => 'Services',
                'page_type' => 'static',
                'meta_title' => 'Amazon Organic Growth Services | ListingGrowth',
                'meta_description' => 'Explore Amazon ranking optimization, shopper feedback, keyword research, external traffic, and conversion services from ListingGrowth.',
                'robots_index' => true,
                'robots_follow' => true,
                'is_active' => true,
            ],
        );
    }
}
