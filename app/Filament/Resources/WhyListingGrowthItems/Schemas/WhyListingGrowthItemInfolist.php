<?php

namespace App\Filament\Resources\WhyListingGrowthItems\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class WhyListingGrowthItemInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Why ListingGrowth item')
                    ->schema([
                        TextEntry::make('label'),
                        TextEntry::make('title'),
                        TextEntry::make('description')->columnSpanFull(),
                        TextEntry::make('sort_order')->label('Sort Order'),
                        IconEntry::make('is_active')->label('Active')->boolean(),
                        TextEntry::make('created_at')->dateTime(),
                        TextEntry::make('updated_at')->dateTime(),
                    ])
                    ->columns(2),
            ]);
    }
}
