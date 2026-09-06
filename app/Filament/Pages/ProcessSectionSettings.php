<?php

namespace App\Filament\Pages;

use App\Models\ProcessSection;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
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

class ProcessSectionSettings extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-list-bullet';

    protected static ?string $navigationLabel = 'Process Section Settings';

    protected static ?string $title = 'Process Section';

    protected static string|\UnitEnum|null $navigationGroup = 'Home Page';

    protected static ?int $navigationSort = 9;

    protected string $view = 'filament.pages.process-section-settings';

    /** @var array<string, mixed>|null */
    public ?array $data = [];

    public ?ProcessSection $record = null;

    public function mount(): void
    {
        $this->record = ProcessSection::singleton();

        $this->form->fill($this->record->toArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Tabs::make('Process')
                    ->tabs([
                        Tab::make('Section Content')
                            ->schema([
                                Section::make('Section content')
                                    ->description('This is the only Process section. Another section cannot be created.')
                                    ->schema([
                                        Forms\Components\TextInput::make('label')
                                            ->label('Section Label')
                                            ->required()
                                            ->maxLength(100),
                                        Forms\Components\TextInput::make('title')
                                            ->label('Section Title')
                                            ->required()
                                            ->maxLength(255),
                                        Forms\Components\Textarea::make('description')
                                            ->label('Section Description')
                                            ->required()
                                            ->rows(4)
                                            ->maxLength(2000)
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(2),
                            ]),
                        Tab::make('Process Items')
                            ->schema([
                                Repeater::make('items')
                                    ->relationship()
                                    ->orderColumn('sort_order')
                                    ->schema([
                                        Forms\Components\TextInput::make('label_number')
                                            ->label('Label Number')
                                            ->placeholder('01')
                                            ->required()
                                            ->maxLength(20),
                                        Forms\Components\TextInput::make('title')
                                            ->required()
                                            ->maxLength(255),
                                        Forms\Components\Textarea::make('description')
                                            ->required()
                                            ->rows(4)
                                            ->maxLength(2000)
                                            ->columnSpanFull(),
                                        Forms\Components\Toggle::make('is_active')
                                            ->label('Active')
                                            ->default(true),
                                    ])
                                    ->columns(2)
                                    ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                                    ->addActionLabel('Add process item')
                                    ->collapsible()
                                    ->cloneable()
                                    ->columnSpanFull(),
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
                ->label('Save section')
                ->submit('save')
                ->keyBindings(['mod+s']),
        ];
    }

    public function save(): void
    {
        $this->record?->update($this->form->getState());

        Notification::make()
            ->title('Process section saved.')
            ->success()
            ->send();
    }
}
