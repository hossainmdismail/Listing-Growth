<?php

namespace App\Models;

use Database\Factories\FaqItemFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FaqItem extends Model
{
    /** @use HasFactory<FaqItemFactory> */
    use HasFactory;

    protected $fillable = [
        'faq_section_id',
        'question',
        'answer',
        'sort_order',
        'is_active',
        'show_on_contact_page',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
            'is_active' => 'boolean',
            'show_on_contact_page' => 'boolean',
        ];
    }

    /** @return BelongsTo<FaqSection, $this> */
    public function section(): BelongsTo
    {
        return $this->belongsTo(FaqSection::class, 'faq_section_id');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    public function scopeForHomePage(Builder $query): Builder
    {
        return $query->where('show_on_contact_page', false);
    }

    public function scopeForContactPage(Builder $query): Builder
    {
        return $query->where('show_on_contact_page', true);
    }
}
