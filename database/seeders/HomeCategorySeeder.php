<?php

namespace Database\Seeders;

use App\Models\CategorySection;
use App\Models\HomeCategory;
use Illuminate\Database\Seeder;

class HomeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $section = CategorySection::singleton();

        $categories = [
            'Home & Kitchen',
            'Sports & Outdoors',
            'Health & Household',
            'Beauty & Personal Care',
            'Toys & Games',
            'Electronics',
            'Pet Supplies',
            'Baby Products',
            'Tools & Home Improvement',
            'Grocery & Gourmet',
            'Office Products',
            'Automotive',
        ];

        foreach ($categories as $index => $category) {
            HomeCategory::query()->updateOrCreate(
                [
                    'category_section_id' => $section->id,
                    'name' => $category,
                ],
                [
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ],
            );
        }
    }
}
