<?php

namespace App\Filament\Pages;

use App\Models\FinalCtaSection;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class FinalCtaSettings extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-megaphone';

    protected static ?string $navigationLabel = 'Final CTA Settings';

    protected static ?string $title = 'Final CTA Section';

    protected static string|\UnitEnum|null $navigationGroup = 'Home Page';

    protected static ?int $navigationSort = 11;

    protected string $view = 'filament.pages.final-cta-settings';

    /** @var array<string, mixed>|null */
    public ?array $data = [];

    public ?FinalCtaSection $record = null;

    public function mount(): void
    {
        $this->record = FinalCtaSection::singleton();

        $this->form->fill($this->record->toArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Section content')
                    ->description('This is the only Final CTA section. Another section cannot be created.')
                    ->schema([
                        Forms\Components\TextInput::make('label')
                            ->label('Section Label')
                            ->required()
                            ->maxLength(100),
                        Forms\Components\Textarea::make('title')
                            ->label('Section Title')
                            ->helperText('Use a new line to control where the title breaks.')
                            ->required()
                            ->rows(3)
                            ->maxLength(500),
                        Forms\Components\Textarea::make('description')
                            ->label('Section Description')
                            ->required()
                            ->rows(4)
                            ->maxLength(2000)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Section::make('Primary button')
                    ->schema([
                        Forms\Components\TextInput::make('primary_button_text')
                            ->label('Button Text')
                            ->required()
                            ->maxLength(100),
                        Forms\Components\TextInput::make('primary_button_url')
                            ->label('Button Link')
                            ->helperText('Supports relative links such as /contact and full HTTPS URLs.')
                            ->required()
                            ->maxLength(2048),
                    ])
                    ->columns(2),
                Section::make('Secondary button')
                    ->schema([
                        Forms\Components\TextInput::make('secondary_button_text')
                            ->label('Button Text')
                            ->required()
                            ->maxLength(100),
                        Forms\Components\TextInput::make('secondary_button_url')
                            ->label('Button Link')
                            ->helperText('Supports relative links such as /contact and full HTTPS URLs.')
                            ->required()
                            ->maxLength(2048),
                    ])
                    ->columns(2),
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
            ->title('Final CTA section saved.')
            ->success()
            ->send();
    }
}
