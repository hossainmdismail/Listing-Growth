<?php

namespace App\Models;

use Database\Factories\ContactSubmissionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactSubmission extends Model
{
    /** @use HasFactory<ContactSubmissionFactory> */
    use HasFactory;

    public const STATUS_NEW = 'new';

    public const STATUS_IN_PROGRESS = 'in_progress';

    public const STATUS_CONTACTED = 'contacted';

    public const STATUS_CLOSED = 'closed';

    protected $fillable = [
        'name',
        'email',
        'listing_url',
        'category',
        'service',
        'message',
        'status',
        'admin_notes',
    ];

    protected $attributes = [
        'status' => self::STATUS_NEW,
    ];

    /** @return array<string, string> */
    public static function statusOptions(): array
    {
        return [
            self::STATUS_NEW => 'New',
            self::STATUS_IN_PROGRESS => 'In progress',
            self::STATUS_CONTACTED => 'Contacted',
            self::STATUS_CLOSED => 'Closed',
        ];
    }

    /** @return array<string, string> */
    public static function categoryOptions(): array
    {
        return [
            'Home & Kitchen' => 'Home & Kitchen',
            'Electronics' => 'Electronics',
            'Beauty & Personal Care' => 'Beauty & Personal Care',
            'Sports & Outdoors' => 'Sports & Outdoors',
            'Pet Supplies' => 'Pet Supplies',
            'Other' => 'Other',
        ];
    }

    /** @return array<string, string> */
    public static function serviceOptions(): array
    {
        return [
            'Ranking Optimization' => 'Ranking Optimization',
            'Pre-Launch Lab' => 'Pre-Launch Lab',
            '1-on-1 Strategy Consultation' => '1-on-1 Strategy Consultation',
            'Not sure — send me the free audit' => 'Not sure — send me the free audit',
        ];
    }
}
