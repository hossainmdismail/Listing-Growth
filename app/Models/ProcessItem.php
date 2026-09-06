<?php

namespace App\Models;

use Database\Factories\ProcessItemFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProcessItem extends Model
{
    /** @use HasFactory<ProcessItemFactory> */
    use HasFactory;

    protected $fillable = [
        'process_section_id',
        'label_number',
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

    /** @return BelongsTo<ProcessSection, $this> */
    public function section(): BelongsTo
    {
        return $this->belongsTo(ProcessSection::class, 'process_section_id');
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
