<?php

namespace App\Filament\Pages;

use App\Models\MarketingSetting;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\CodeEditor;
use Filament\Forms\Components\CodeEditor\Enums\Language;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class MarketingSettings extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-megaphone';

    protected static ?string $navigationLabel = 'Marketing Settings';

    protected static ?string $title = 'Marketing Settings';

    protected static string|\UnitEnum|null $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 3;

    protected string $view = 'filament.pages.marketing-settings';

    /** @var array<string, mixed>|null */
    public ?array $data = [];

    public ?MarketingSetting $record = null;

    public function mount(): void
    {
        $this->record = MarketingSetting::query()->firstOrCreate(
            ['id' => 1],
            [
                'gtm_enabled' => false,
                'ga4_enabled' => false,
                'meta_pixel_enabled' => false,
                'tiktok_pixel_enabled' => false,
            ],
        );

        $this->form->fill($this->record->toArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Tabs::make('Marketing Settings')
                    ->tabs([
                        Tab::make('Tracking')
                            ->schema([
                                Section::make('Google Tag Manager')
                                    ->schema([
                                        Forms\Components\Toggle::make('gtm_enabled')->label('Enable GTM'),
                                        Forms\Components\TextInput::make('gtm_container_id')
                                            ->label('Container ID')
                                            ->placeholder('GTM-XXXXXXX')
                                            ->maxLength(255),
                                    ])->columns(2),
                                Section::make('Google Analytics 4')
                                    ->schema([
                                        Forms\Components\Toggle::make('ga4_enabled')->label('Enable GA4'),
                                        Forms\Components\TextInput::make('ga4_measurement_id')
                                            ->label('Measurement ID')
                                            ->placeholder('G-XXXXXXXXXX')
                                            ->maxLength(255),
                                    ])->columns(2),
                                Section::make('Meta Pixel')
                                    ->schema([
                                        Forms\Components\Toggle::make('meta_pixel_enabled')->label('Enable Meta Pixel'),
                                        Forms\Components\TextInput::make('meta_pixel_id')
                                            ->label('Pixel ID')
                                            ->maxLength(255),
                                    ])->columns(2),
                                Section::make('TikTok Pixel')
                                    ->schema([
                                        Forms\Components\Toggle::make('tiktok_pixel_enabled')->label('Enable TikTok Pixel'),
                                        Forms\Components\TextInput::make('tiktok_pixel_id')
                                            ->label('Pixel ID')
                                            ->maxLength(255),
                                    ])->columns(2),
                            ]),
                        Tab::make('Verification')
                            ->schema([
                                Section::make('Ownership verification')
                                    ->schema([
                                        Forms\Components\TextInput::make('google_search_console_verification')
                                            ->label('Google Search Console code')
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('bing_webmaster_verification')
                                            ->label('Bing Webmaster code')
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('meta_domain_verification')
                                            ->label('Meta domain verification code')
                                            ->maxLength(255),
                                    ]),
                            ]),
                        Tab::make('Custom scripts')
                            ->schema([
                                Section::make('Trusted custom scripts')
                                    ->description('These values are rendered as raw HTML. Only trusted administrators should edit them.')
                                    ->schema([
                                        CodeEditor::make('custom_head_scripts')
                                            ->label('Head scripts')
                                            ->language(Language::Html)
                                            ->columnSpanFull(),
                                        CodeEditor::make('custom_body_start_scripts')
                                            ->label('Body start scripts')
                                            ->language(Language::Html)
                                            ->columnSpanFull(),
                                        CodeEditor::make('custom_body_end_scripts')
                                            ->label('Body end scripts')
                                            ->language(Language::Html)
                                            ->columnSpanFull(),
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull(),
            ])
            ->model($this->record)
            ->statePath('data');
    }

    public function content(Schema $schema): Schema
    {
        return $schema->components([$this->getFormContentComponent()]);
    }

    public function getFormContentComponent(): Component
    {
        return Form::make([EmbeddedSchema::make('form')])
            ->id('form')
            ->livewireSubmitHandler('save')
            ->footer([Actions::make($this->getFormActions())]);
    }

    /** @return array<Action> */
    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Save settings')
                ->submit('save')
                ->keyBindings(['mod+s']),
        ];
    }

    public function save(): void
    {
        $this->record?->update($this->form->getState());

        Notification::make()
            ->title('Marketing settings saved.')
            ->success()
            ->send();
    }
}
