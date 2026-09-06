<?php

namespace Database\Seeders;

use App\Models\FinalCtaSection;
use Illuminate\Database\Seeder;

class FinalCtaSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FinalCtaSection::query()->updateOrCreate(
            ['singleton_key' => 1],
            [
                'label' => 'Ready When You Are',
                'title' => "Scaling on Amazon shouldn't be hard.\nLet's simplify it.",
                'description' => 'Get a free Amazon SEO audit and a tailored growth plan — no cost, no obligation.',
                'primary_button_text' => 'Get My Free Amazon SEO Audit →',
                'primary_button_url' => '/contact',
                'secondary_button_text' => 'Book a Consultation',
                'secondary_button_url' => '/contact',
            ],
        );
    }
}
