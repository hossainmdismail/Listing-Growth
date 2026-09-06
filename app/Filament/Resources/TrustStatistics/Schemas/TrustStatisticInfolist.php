<?php

namespace App\Filament\Resources\TrustStatistics\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TrustStatisticInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Statistic')
                    ->schema([
                        TextEntry::make('field_name')->label('Field Name'),
                        TextEntry::make('field_value')->label('Field Value'),
                        TextEntry::make('sort_order')->label('Sort Order'),
                        IconEntry::make('is_active')->label('Active')->boolean(),
                        TextEntry::make('created_at')->dateTime(),
                        TextEntry::make('updated_at')->dateTime(),
                    ])
                    ->columns(2),
            ]);
    }
}
