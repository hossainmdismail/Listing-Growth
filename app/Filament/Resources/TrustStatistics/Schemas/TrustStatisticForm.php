<?php

namespace App\Filament\Resources\TrustStatistics\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TrustStatisticForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Statistic')
                    ->description('Manage one statistic shown in the homepage trust strip.')
                    ->schema([
                        TextInput::make('field_name')
                            ->label('Field Name')
                            ->placeholder('Brands scaled')
                            ->required()
                            ->maxLength(100),
                        TextInput::make('field_value')
                            ->label('Field Value')
                            ->placeholder('500+')
                            ->required()
                            ->maxLength(50),
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
