<?php

namespace App\Filament\Resources\HomeServices\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class HomeServiceInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Service card')
                    ->schema([
                        ImageEntry::make('icon_path')
                            ->label('SVG Icon')
                            ->disk('public'),
                        TextEntry::make('title'),
                        TextEntry::make('short_description')
                            ->label('Short Description')
                            ->columnSpanFull(),
                        TextEntry::make('button_label')->label('Link Label'),
                        TextEntry::make('button_url')->label('Link URL'),
                        TextEntry::make('sort_order')->label('Sort Order'),
                        IconEntry::make('is_active')->label('Active')->boolean(),
                        TextEntry::make('created_at')->dateTime(),
                        TextEntry::make('updated_at')->dateTime(),
                    ])
                    ->columns(2),
            ]);
    }
}
