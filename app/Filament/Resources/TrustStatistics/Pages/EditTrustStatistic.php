<?php

namespace App\Filament\Resources\TrustStatistics\Pages;

use App\Filament\Resources\TrustStatistics\TrustStatisticResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditTrustStatistic extends EditRecord
{
    protected static string $resource = TrustStatisticResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
