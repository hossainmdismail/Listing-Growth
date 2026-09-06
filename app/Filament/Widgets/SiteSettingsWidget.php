<?php

namespace App\Filament\Widgets;

use App\Filament\Pages\GlobalSettings;
use App\Filament\Pages\MarketingSettings;
use App\Filament\Resources\SeoPages\SeoPageResource;
use Filament\Widgets\Widget;

class SiteSettingsWidget extends Widget
{
    protected static ?int $sort = 2;

    protected static bool $isLazy = false;

    protected int|string|array $columnSpan = 'full';

    protected string $view = 'filament.widgets.site-settings-widget';

    /** @return array<string, array<int, array<string, string>>> */
    protected function getViewData(): array
    {
        return [
            'settings' => [
                [
                    'label' => 'Global Settings',
                    'description' => 'Logo, contact details, social links, footer, and SEO fallbacks.',
                    'icon' => 'heroicon-o-cog-6-tooth',
                    'url' => GlobalSettings::getUrl(),
                ],
                [
                    'label' => 'Marketing Settings',
                    'description' => 'Tracking pixels, webmaster verification, and script injection.',
                    'icon' => 'heroicon-o-megaphone',
                    'url' => MarketingSettings::getUrl(),
                ],
                [
                    'label' => 'SEO Pages',
                    'description' => 'Control page metadata, social previews, schema, and indexing.',
                    'icon' => 'heroicon-o-document-magnifying-glass',
                    'url' => SeoPageResource::getUrl(),
                ],
            ],
        ];
    }
}
