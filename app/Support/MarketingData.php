<?php

namespace App\Support;

use App\Models\MarketingSetting;
use Throwable;

class MarketingData
{
    /** @return array<string, bool|string|null> */
    public function resolve(): array
    {
        try {
            $settings = MarketingSetting::query()->first();
        } catch (Throwable) {
            $settings = null;
        }

        return [
            'gtm_enabled' => (bool) ($settings?->gtm_enabled && filled($settings->gtm_container_id)),
            'gtm_container_id' => $settings?->gtm_container_id,
            'ga4_enabled' => (bool) ($settings?->ga4_enabled && filled($settings->ga4_measurement_id)),
            'ga4_measurement_id' => $settings?->ga4_measurement_id,
            'meta_pixel_enabled' => (bool) ($settings?->meta_pixel_enabled && filled($settings->meta_pixel_id)),
            'meta_pixel_id' => $settings?->meta_pixel_id,
            'tiktok_pixel_enabled' => (bool) ($settings?->tiktok_pixel_enabled && filled($settings->tiktok_pixel_id)),
            'tiktok_pixel_id' => $settings?->tiktok_pixel_id,
            'google_search_console_verification' => $settings?->google_search_console_verification,
            'bing_webmaster_verification' => $settings?->bing_webmaster_verification,
            'meta_domain_verification' => $settings?->meta_domain_verification,
            'custom_head_scripts' => $settings?->custom_head_scripts,
            'custom_body_start_scripts' => $settings?->custom_body_start_scripts,
            'custom_body_end_scripts' => $settings?->custom_body_end_scripts,
        ];
    }
}
