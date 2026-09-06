<?php

namespace App\Models;

use Database\Factories\FinalCtaSectionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalCtaSection extends Model
{
    /** @use HasFactory<FinalCtaSectionFactory> */
    use HasFactory;

    protected $fillable = [
        'label',
        'title',
        'description',
        'primary_button_text',
        'primary_button_url',
        'secondary_button_text',
        'secondary_button_url',
    ];

    public static function singleton(): self
    {
        return self::query()->firstOrCreate(
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
