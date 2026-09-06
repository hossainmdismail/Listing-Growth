<?php

namespace App\Filament\Pages;

use App\Models\TestimonialSection;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
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

class TestimonialSectionSettings extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationLabel = 'Testimonial Section Settings';

    protected static ?string $title = 'Testimonial Section';

    protected static string|\UnitEnum|null $navigationGroup = 'Home Page';

    protected static ?int $navigationSort = 7;

    protected string $view = 'filament.pages.testimonial-section-settings';

    /** @var array<string, mixed>|null */
    public ?array $data = [];

    public ?TestimonialSection $record = null;

    public function mount(): void
    {
        $this->record = TestimonialSection::singleton();

        $this->form->fill($this->record->toArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Tabs::make('Testimonial Section')
                    ->tabs([
                        Tab::make('Section Content')
                            ->schema([
                                Section::make('Section content')
                                    ->description('This is the only Testimonial section. Another section cannot be created.')
                                    ->schema([
                                        Forms\Components\TextInput::make('label')
                                            ->placeholder('Testimonials')
                                            ->required()
                                            ->maxLength(100),
                                        Forms\Components\TextInput::make('title')
                                            ->required()
                                            ->maxLength(255),
                                        Forms\Components\Textarea::make('description')
                                            ->rows(4)
                                            ->maxLength(2000)
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(2),
                            ]),
                        Tab::make('Testimonials')
                            ->schema([
                                Repeater::make('testimonials')
                                    ->relationship()
                                    ->orderColumn('sort_order')
                                    ->schema([
                                        Forms\Components\Textarea::make('feedback')
                                            ->required()
                                            ->rows(5)
                                            ->maxLength(3000)
                                            ->columnSpanFull(),
                                        Forms\Components\TextInput::make('name')
                                            ->required()
                                            ->maxLength(150),
                                        Forms\Components\TextInput::make('objective')
                                            ->label('Objective / Designation')
                                            ->required()
                                            ->maxLength(150),
                                        FileUpload::make('profile_path')
                                            ->label('Profile Image (Optional)')
                                            ->disk('public')
                                            ->directory('testimonials/profiles')
                                            ->image()
                                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                                            ->maxSize(2048)
                                            ->imageEditor()
                                            ->imageEditorAspectRatioOptions(['1:1'])
                                            ->columnSpanFull(),
                                        Forms\Components\Toggle::make('is_active')
                                            ->label('Active')
                                            ->default(true),
                                    ])
                                    ->columns(2)
                                    ->itemLabel(fn (array $state): ?string => $state['name'] ?? null)
                                    ->addActionLabel('Add testimonial')
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
            ->title('Testimonial section saved.')
            ->success()
            ->send();
    }
}
