<?php

namespace App\Filament\Pages;

use App\Models\FaqSection;
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

class FaqSectionSettings extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-question-mark-circle';

    protected static ?string $navigationLabel = 'FAQ Section Settings';

    protected static ?string $title = 'FAQ Section';

    protected static string|\UnitEnum|null $navigationGroup = 'Home Page';

    protected static ?int $navigationSort = 10;

    protected string $view = 'filament.pages.faq-section-settings';

    /** @var array<string, mixed>|null */
    public ?array $data = [];

    public ?FaqSection $record = null;

    public function mount(): void
    {
        $this->record = FaqSection::singleton();

        $this->form->fill($this->record->toArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Tabs::make('FAQ')
                    ->tabs([
                        Tab::make('Section Content')
                            ->schema([
                                Section::make('Section content')
                                    ->description('This is the only FAQ section. Another section cannot be created.')
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
                                            ->label('Section Description (Optional)')
                                            ->rows(3)
                                            ->maxLength(2000)
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(2),
                            ]),
                        Tab::make('FAQ Items')
                            ->schema([
                                Repeater::make('items')
                                    ->relationship()
                                    ->orderColumn('sort_order')
                                    ->schema([
                                        Forms\Components\TextInput::make('question')
                                            ->required()
                                            ->maxLength(500)
                                            ->columnSpanFull(),
                                        Forms\Components\Textarea::make('answer')
                                            ->required()
                                            ->rows(5)
                                            ->maxLength(5000)
                                            ->columnSpanFull(),
                                        Forms\Components\Toggle::make('is_active')
                                            ->label('Active')
                                            ->default(true),
                                        Forms\Components\Toggle::make('show_on_contact_page')
                                            ->label('Show on Contact Page')
                                            ->helperText('Enabled FAQs appear only on Contact. Disabled FAQs appear only on Home.')
                                            ->default(false),
                                    ])
                                    ->itemLabel(fn (array $state): ?string => $state['question'] ?? null)
                                    ->addActionLabel('Add FAQ')
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
            ->title('FAQ section saved.')
            ->success()
            ->send();
    }
}
