<?php

namespace App\Filament\Resources\CaseStudies\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CaseStudyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Case study content')
                    ->schema([
                        TextInput::make('label')
                            ->required()
                            ->maxLength(100)
                            ->placeholder('Home & Outdoor'),
                        TextInput::make('subtitle')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('$0 to $178K in 30 days'),
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Page 5 → Page 1'),
                        Textarea::make('short_description')
                            ->label('Short Description')
                            ->required()
                            ->rows(4)
                            ->maxLength(2000)
                            ->columnSpanFull(),
                        RichEditor::make('content')
                            ->label('Rich Text (Optional)')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Section::make('Statistics')
                    ->description('Add as many label and value pairs as needed.')
                    ->schema([
                        Repeater::make('statistics')
                            ->hiddenLabel()
                            ->schema([
                                TextInput::make('value')
                                    ->required()
                                    ->maxLength(100)
                                    ->placeholder('$178K'),
                                TextInput::make('label')
                                    ->required()
                                    ->maxLength(150)
                                    ->placeholder('Revenue / 30 days'),
                            ])
                            ->columns(2)
                            ->itemLabel(fn (array $state): ?string => $state['label'] ?? null)
                            ->addActionLabel('Add statistic')
                            ->reorderable()
                            ->collapsible()
                            ->defaultItems(0)
                            ->columnSpanFull(),
                    ]),
                Section::make('Publishing')
                    ->schema([
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
