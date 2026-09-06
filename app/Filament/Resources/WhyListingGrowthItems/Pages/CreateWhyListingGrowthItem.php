<?php

namespace App\Filament\Resources\WhyListingGrowthItems\Pages;

use App\Filament\Resources\WhyListingGrowthItems\WhyListingGrowthItemResource;
use App\Models\WhyListingGrowthSection;
use Filament\Resources\Pages\CreateRecord;

class CreateWhyListingGrowthItem extends CreateRecord
{
    protected static string $resource = WhyListingGrowthItemResource::class;

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['why_listing_growth_section_id'] = WhyListingGrowthSection::singleton()->id;

        return $data;
    }
}
