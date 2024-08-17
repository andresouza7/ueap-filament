<?php

namespace App\Filament\Pages;

use App\Models\Person;
use Filament\Forms;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Exceptions\Halt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;

class Profile extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-pencil';
    // protected static bool $shouldRegisterNavigation = false;
    protected static string $view = 'filament.pages.profile';
    protected static ?string $title = 'Alterar Perfil';
    protected static ?string $navigationGroup = 'Minha Área';
    protected static ?int $navigationSort = 4;

    // Form Data
    public ?array $data = [];
    public ?Person $record = null;

    public function mount(): void
    {
        // There is a User Observer to make sure there always is a record in Pessoas for a User
        $this->record = Auth::user()->person;

        //  control acess

        $this->fillForm();
    }

    public function fillForm(): void
    {
        $data = $this->record->attributesToArray();

        $data = $this->mutateFormDataBeforeFill($data);

        $this->form->fill($data);
    }

    public function mutateFormDataBeforeFill(array $data): array
    {
        return $data;
    }

    public function mutateFormDataBeforeSave(array $data): array
    {
        return $data;
    }

    public function save()
    {
        try {
            $data = $this->form->getState();

            $data = $this->mutateFormDataBeforeSave($data);

            $this->handleRecordUpdate($this->record, $data);
        } catch (Halt $exception) {
            return;
        }

        // emit notification
        $this->getSavedNotification()?->send();

        // redirect to url
        if ($redirectUrl = $this->getRedirectUrl()) {
            $this->redirect($redirectUrl);
        }
    }

    public function handleRecordUpdate(Person $record, array $data): void
    {
        $record->update($data);
    }

    protected function getSavedNotification(): ?Notification
    {
        $title = 'Dados atualizados com sucesso!';

        if (blank($title)) {
            return null;
        }

        return Notification::make()
            ->title($title)
            ->success();
    }

    protected function getRedirectUrl(): ?string
    {
        return null;
    }


    public function form(Form $form): Form
    {
        return $form->schema([
            // $this->getPersonalDataSection(),
            // $this->getAcademicDataSection()

            Wizard::make([
                Wizard\Step::make('Dados Pessoais')
                    ->description('Atualize seus dados pessoais.')
                    ->schema([
                        $this->getPersonalDataSection()
                    ]),
                Wizard\Step::make('Currículo')
                    ->description('Informe seu perfil acadêmico.')
                    ->schema([
                        $this->getAcademicDataSection()
                    ]),
            ])
                ->skippable()
                ->submitAction(new HtmlString(Blade::render(<<<BLADE
                    <x-filament::button
                        type="submit"
                    >
                        Salvar
                    </x-filament::button>
                BLADE)))
        ])
            ->model($this->record)
            ->statePath('data')
            ->operation('edit');
    }

    public function getPersonalDataSection(): Component
    {
        return Group::make()
            ->columns(2)
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nome')
                    ->required(),
                Forms\Components\TextInput::make('cpf_cnpj')
                    ->label('CPF')
                    ->disabled(fn() => Auth::user()->person !== null)
                    ->required(),
                Forms\Components\TextInput::make('enrollment')
                    ->label('Matrícula'),
                Forms\Components\TextInput::make('email'),
            ]);
    }

    public function getAcademicDataSection(): Component
    {
        return Group::make()
            ->columns(1)
            ->schema([
                TextInput::make('lattes'),
                Textarea::make('resume')
                    ->label('Resumo')
                    ->rows(5),
            ]);
    }
}
