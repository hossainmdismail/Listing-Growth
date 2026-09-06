<?php

namespace App\Filament\Resources\WhyListingGrowthItems\Pages;

use App\Filament\Resources\WhyListingGrowthItems\WhyListingGrowthItemResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditWhyListingGrowthItem extends EditRecord
{
    protected static string $resource = WhyListingGrowthItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
