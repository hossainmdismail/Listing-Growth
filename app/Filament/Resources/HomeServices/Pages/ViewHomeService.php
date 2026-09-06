<?php

namespace App\Filament\Resources\HomeServices\Pages;

use App\Filament\Resources\HomeServices\HomeServiceResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewHomeService extends ViewRecord
{
    protected static string $resource = HomeServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
