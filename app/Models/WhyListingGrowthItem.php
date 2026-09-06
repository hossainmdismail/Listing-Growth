<?php

namespace App\Models;

use Database\Factories\WhyListingGrowthItemFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WhyListingGrowthItem extends Model
{
    /** @use HasFactory<WhyListingGrowthItemFactory> */
    use HasFactory;

    protected $fillable = [
        'why_listing_growth_section_id',
        'label',
        'title',
        'description',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    /** @return BelongsTo<WhyListingGrowthSection, $this> */
    public function section(): BelongsTo
    {
        return $this->belongsTo(WhyListingGrowthSection::class, 'why_listing_growth_section_id');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }
}
