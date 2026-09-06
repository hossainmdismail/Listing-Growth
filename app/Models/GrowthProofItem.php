<?php

namespace App\Models;

use Database\Factories\GrowthProofItemFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GrowthProofItem extends Model
{
    /** @use HasFactory<GrowthProofItemFactory> */
    use HasFactory;

    protected $fillable = [
        'growth_proof_section_id',
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

    /** @return BelongsTo<GrowthProofSection, $this> */
    public function section(): BelongsTo
    {
        return $this->belongsTo(GrowthProofSection::class, 'growth_proof_section_id');
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
