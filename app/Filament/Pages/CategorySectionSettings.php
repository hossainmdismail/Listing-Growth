<?php

namespace App\Filament\Pages;

use App\Models\CategorySection;
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

class CategorySectionSettings extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-tag';

    protected static ?string $navigationLabel = 'Category Section Settings';

    protected static ?string $title = 'Category Section';

    protected static string|\UnitEnum|null $navigationGroup = 'Home Page';

    protected static ?int $navigationSort = 6;

    protected string $view = 'filament.pages.category-section-settings';

    /** @var array<string, mixed>|null */
    public ?array $data = [];

    public ?CategorySection $record = null;

    public function mount(): void
    {
        $this->record = CategorySection::singleton();

        $this->form->fill($this->record->toArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Tabs::make('Category Section')
                    ->tabs([
                        Tab::make('Section Content')
                            ->schema([
                                Section::make('Section content')
                                    ->description('This is the only Category section. Another section cannot be created.')
                                    ->schema([
                                        Forms\Components\TextInput::make('label')
                                            ->placeholder('Categories')
                                            ->required()
                                            ->maxLength(100),
                                        Forms\Components\TextInput::make('title')
                                            ->required()
                                            ->maxLength(255),
                                        Forms\Components\Textarea::make('description')
                                            ->required()
                                            ->rows(4)
                                            ->maxLength(2000)
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(2),
                            ]),
                        Tab::make('Categories')
                            ->schema([
                                Repeater::make('categories')
                                    ->relationship()
                                    ->orderColumn('sort_order')
                                    ->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->label('Category Name')
                                            ->placeholder('Home & Kitchen')
                                            ->required()
                                            ->maxLength(150),
                                        Forms\Components\Toggle::make('is_active')
                                            ->label('Active')
                                            ->default(true),
                                    ])
                                    ->columns(2)
                                    ->itemLabel(fn (array $state): ?string => $state['name'] ?? null)
                                    ->addActionLabel('Add category')
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
            ->title('Category section saved.')
            ->success()
            ->send();
    }
}
