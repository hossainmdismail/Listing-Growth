<?php

namespace App\Filament\Resources\SeoPages\Schemas;

use Filament\Forms\Components\CodeEditor;
use Filament\Forms\Components\CodeEditor\Enums\Language;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class SeoPageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('SEO page')
                    ->tabs([
                        Tab::make('Page')
                            ->schema([
                                Section::make('Page identity')
                                    ->schema([
                                        TextInput::make('page_name')
                                            ->required()
                                            ->maxLength(150),
                                        TextInput::make('page_key')
                                            ->helperText('The Blade page uses this key to load its SEO record.')
                                            ->required()
                                            ->unique(ignoreRecord: true)
                                            ->alphaDash()
                                            ->maxLength(191)
                                            ->placeholder('home'),
                                        Select::make('page_type')
                                            ->options([
                                                'static' => 'Static',
                                                'dynamic' => 'Dynamic',
                                                'landing' => 'Landing page',
                                                'custom' => 'Custom',
                                            ])
                                            ->required()
                                            ->default('static')
                                            ->native(false),
                                        Toggle::make('is_active')
                                            ->default(true),
                                    ])
                                    ->columns(2),
                            ]),
                        Tab::make('Search')
                            ->schema([
                                Section::make('Search metadata')
                                    ->schema([
                                        TextInput::make('meta_title')
                                            ->maxLength(255),
                                        Textarea::make('meta_description')
                                            ->rows(4)
                                            ->columnSpanFull(),
                                        TextInput::make('canonical_url')
                                            ->url()
                                            ->maxLength(2048)
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(2),
                            ]),
                        Tab::make('Social')
                            ->schema([
                                Section::make('Open Graph metadata')
                                    ->schema([
                                        TextInput::make('og_title')
                                            ->label('Open Graph title')
                                            ->maxLength(255),
                                        Textarea::make('og_description')
                                            ->label('Open Graph description')
                                            ->rows(4)
                                            ->columnSpanFull(),
                                        FileUpload::make('og_image')
                                            ->label('Open Graph image')
                                            ->disk('public')
                                            ->directory('seo-pages')
                                            ->image()
                                            ->imageEditor()
                                            ->maxSize(4096)
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(2),
                            ]),
                        Tab::make('Robots')
                            ->schema([
                                Section::make('Crawler access')
                                    ->schema([
                                        Toggle::make('robots_index')
                                            ->label('Allow indexing')
                                            ->default(true),
                                        Toggle::make('robots_follow')
                                            ->label('Allow following links')
                                            ->default(true),
                                    ])
                                    ->columns(2),
                            ]),
                        Tab::make('Schema')
                            ->schema([
                                Section::make('Structured data')
                                    ->schema([
                                        CodeEditor::make('schema_json')
                                            ->label('JSON-LD schema')
                                            ->language(Language::Json)
                                            ->formatStateUsing(fn (mixed $state): ?string => blank($state)
                                                ? null
                                                : json_encode($state, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES))
                                            ->dehydrateStateUsing(fn (?string $state): ?array => blank($state)
                                                ? null
                                                : json_decode($state, true))
                                            ->rules(['nullable', 'json'])
                                            ->columnSpanFull(),
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
