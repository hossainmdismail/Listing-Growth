<?php

namespace App\Filament\Pages;

use App\Models\GlobalSetting;
use Filament\Actions\Action;
use Filament\Forms;
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

class GlobalSettings extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationLabel = 'Global Settings';

    protected static ?string $title = 'Global Settings';

    protected static string|\UnitEnum|null $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 2;

    protected string $view = 'filament.pages.global-settings';

    /** @var array<string, mixed>|null */
    public ?array $data = [];

    public ?GlobalSetting $record = null;

    public function mount(): void
    {
        $this->record = GlobalSetting::query()->firstOrCreate(
            ['id' => 1],
            [
                'site_name' => config('app.name', 'ListingGrowth'),
                'default_robots_meta' => 'index,follow',
            ],
        );

        $this->form->fill($this->record->toArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Tabs::make('Global Settings')
                    ->tabs([
                        Tab::make('General')
                            ->schema([
                                Section::make('Brand information')
                                    ->schema([
                                        Forms\Components\TextInput::make('site_name')
                                            ->required()
                                            ->maxLength(150),
                                        Forms\Components\TextInput::make('site_tagline')
                                            ->maxLength(255),
                                        Forms\Components\Textarea::make('company_description')
                                            ->rows(4)
                                            ->columnSpanFull(),
                                        Forms\Components\FileUpload::make('logo_path')
                                            ->label('Logo')
                                            ->disk('public')
                                            ->directory('settings')
                                            ->image()
                                            ->imageEditor()
                                            ->maxSize(4096),
                                        Forms\Components\FileUpload::make('favicon_path')
                                            ->label('Favicon')
                                            ->disk('public')
                                            ->directory('settings')
                                            ->image()
                                            ->maxSize(2048),
                                    ])
                                    ->columns(2),
                            ]),
                        Tab::make('Contact')
                            ->schema([
                                Section::make('Contact information')
                                    ->schema([
                                        Forms\Components\TextInput::make('contact_email')
                                            ->email()
                                            ->maxLength(150),
                                        Forms\Components\TextInput::make('contact_phone')
                                            ->tel()
                                            ->maxLength(50),
                                        Forms\Components\TextInput::make('whatsapp_number')
                                            ->tel()
                                            ->maxLength(50),
                                        Forms\Components\Textarea::make('address')
                                            ->rows(3)
                                            ->columnSpanFull(),
                                        Forms\Components\TextInput::make('map_url')
                                            ->label('Map URL')
                                            ->url()
                                            ->maxLength(2048)
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(2),
                            ]),
                        Tab::make('Social links')
                            ->schema([
                                Section::make('Social profiles')
                                    ->schema([
                                        Forms\Components\TextInput::make('facebook_url')->url()->maxLength(255),
                                        Forms\Components\TextInput::make('instagram_url')->url()->maxLength(255),
                                        Forms\Components\TextInput::make('linkedin_url')->url()->maxLength(255),
                                        Forms\Components\TextInput::make('twitter_url')->label('X / Twitter URL')->url()->maxLength(255),
                                        Forms\Components\TextInput::make('youtube_url')->url()->maxLength(255),
                                    ])
                                    ->columns(2),
                            ]),
                        Tab::make('Footer')
                            ->schema([
                                Section::make('Footer content')
                                    ->schema([
                                        Forms\Components\Textarea::make('footer_text')
                                            ->rows(4)
                                            ->columnSpanFull(),
                                        Forms\Components\TextInput::make('copyright_text')
                                            ->maxLength(255)
                                            ->columnSpanFull(),
                                    ]),
                            ]),
                        Tab::make('Default SEO')
                            ->schema([
                                Section::make('Global SEO fallbacks')
                                    ->description('Used only when a page-specific or view-specific value is unavailable.')
                                    ->schema([
                                        Forms\Components\TextInput::make('default_meta_title')
                                            ->maxLength(255),
                                        Forms\Components\Textarea::make('default_meta_description')
                                            ->rows(4)
                                            ->columnSpanFull(),
                                        Forms\Components\TextInput::make('default_og_title')
                                            ->label('Default Open Graph title')
                                            ->maxLength(255),
                                        Forms\Components\Textarea::make('default_og_description')
                                            ->label('Default Open Graph description')
                                            ->rows(4)
                                            ->columnSpanFull(),
                                        Forms\Components\FileUpload::make('default_og_image_path')
                                            ->label('Default Open Graph image')
                                            ->disk('public')
                                            ->directory('settings')
                                            ->image()
                                            ->imageEditor()
                                            ->maxSize(4096),
                                        Forms\Components\TextInput::make('canonical_base_url')
                                            ->url()
                                            ->maxLength(255)
                                            ->placeholder('https://example.com'),
                                        Forms\Components\Select::make('default_robots_meta')
                                            ->options([
                                                'index,follow' => 'Index and follow',
                                                'noindex,nofollow' => 'No index and no follow',
                                                'index,nofollow' => 'Index and no follow',
                                                'noindex,follow' => 'No index and follow',
                                            ])
                                            ->required()
                                            ->native(false),
                                    ])
                                    ->columns(2),
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
            ->title('Global settings saved.')
            ->success()
            ->send();
    }
}
