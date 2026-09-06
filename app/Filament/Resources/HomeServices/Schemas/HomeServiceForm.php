<?php

namespace App\Filament\Resources\HomeServices\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class HomeServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Service card')
                    ->description('Manage one card in the homepage services grid.')
                    ->schema([
                        FileUpload::make('icon_path')
                            ->label('SVG Icon')
                            ->disk('public')
                            ->directory('home-services/icons')
                            ->acceptedFileTypes(['image/svg+xml'])
                            ->maxSize(1024)
                            ->preserveFilenames()
                            ->downloadable()
                            ->openable()
                            ->required()
                            ->columnSpanFull(),
                        TextInput::make('title')
                            ->required()
                            ->maxLength(150),
                        Textarea::make('short_description')
                            ->label('Short Description')
                            ->required()
                            ->rows(5)
                            ->maxLength(1000)
                            ->columnSpanFull(),
                        TextInput::make('button_label')
                            ->label('Link Label')
                            ->required()
                            ->maxLength(50),
                        TextInput::make('button_url')
                            ->label('Link URL')
                            ->maxLength(2048)
                            ->placeholder('/services'),
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
