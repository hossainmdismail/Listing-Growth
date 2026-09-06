<?php

namespace App\Models;

use Database\Factories\WhyListingGrowthSectionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WhyListingGrowthSection extends Model
{
    /** @use HasFactory<WhyListingGrowthSectionFactory> */
    use HasFactory;

    protected $fillable = [
        'section_label',
        'title',
        'description',
    ];

    /** @return HasMany<WhyListingGrowthItem, $this> */
    public function items(): HasMany
    {
        return $this->hasMany(WhyListingGrowthItem::class);
    }

    public static function singleton(): self
    {
        return self::query()->firstOrCreate(
            ['singleton_key' => 1],
            [
                'section_label' => 'Why ListingGrowth',
                'title' => 'Months to rank? Not with us.',
                'description' => 'We put your product on Page 1 — and build the system that keeps it there.',
            ],
        );
    }
}
