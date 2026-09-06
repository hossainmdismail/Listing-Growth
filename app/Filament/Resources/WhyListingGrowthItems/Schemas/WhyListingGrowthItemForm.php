<?php

namespace App\Filament\Resources\WhyListingGrowthItems\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class WhyListingGrowthItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Why ListingGrowth item')
                    ->description('Add as many rows as needed and control their homepage order.')
                    ->schema([
                        TextInput::make('label')
                            ->placeholder('Rank')
                            ->required()
                            ->maxLength(100),
                        TextInput::make('title')
                            ->placeholder('Rank #1 for your top keywords')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('description')
                            ->required()
                            ->rows(4)
                            ->maxLength(2000)
                            ->columnSpanFull(),
                        TextInput::make('sort_order')
                            ->label('Sort Order')
                            ->numeric()
                            ->minValue(0)
                            ->default(0)
                            ->required(),
                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }
}
