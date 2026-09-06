<?php

namespace App\Models;

use Database\Factories\MarketingSettingFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketingSetting extends Model
{
    /** @use HasFactory<MarketingSettingFactory> */
    use HasFactory;

    protected $fillable = [
        'gtm_enabled',
        'gtm_container_id',
        'ga4_enabled',
        'ga4_measurement_id',
        'meta_pixel_enabled',
        'meta_pixel_id',
        'tiktok_pixel_enabled',
        'tiktok_pixel_id',
        'google_search_console_verification',
        'bing_webmaster_verification',
        'meta_domain_verification',
        'custom_head_scripts',
        'custom_body_start_scripts',
        'custom_body_end_scripts',
    ];

    protected function casts(): array
    {
        return [
            'gtm_enabled' => 'boolean',
            'ga4_enabled' => 'boolean',
            'meta_pixel_enabled' => 'boolean',
            'tiktok_pixel_enabled' => 'boolean',
        ];
    }
}
