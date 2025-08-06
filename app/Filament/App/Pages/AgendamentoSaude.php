<?php

namespace App\Filament\App\Pages;

use App\Models\HealthAppointment;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Exceptions\Halt;

class AgendamentoSaude extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.app.pages.agendamento-saude';

    protected static bool $shouldRegisterNavigation = false;

    // Form Data
    public ?array $data = [];
    public $url;

    public function mount() {
         $urls = [
            'medicina' => 'https://calendar.app.google/Zei5k72M4L7L5MTn8',
            'fisioterapia' => 'https://calendar.app.google/VsNkFep5rKL4R3RJ8',
            'nutricao' => 'https://calendar.app.google/SyApG2aWiQKoR2Ca8',
            'enfermagem' => 'https://calendar.app.google/iX5HUm6Fkx7L4Z3e7',
        ];

        $category = request('category');
        $this->url = $urls[$category] ?? null;
    }

    public function mutateFormDataBeforeSave(array $data): array
    {
        $data['user_id'] = auth()->id();
        $data['status'] = 'confirmado';
        $data['agent_role'] = 'medicina';

        return $data;
    }

    public function save()
    {
        try {
            $data = $this->form->getState();

            $data = $this->mutateFormDataBeforeSave($data);

            $this->handleRecordCreation($data);
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

    public function handleRecordCreation(array $data): void
    {
        HealthAppointment::create($data);
    }

    protected function getSavedNotification(): ?Notification
    {
        $title = 'Agendamento realizado com sucesso!';

        if (blank($title)) {
            return null;
        }

        return Notification::make()
            ->title($title)
            ->success();
    }

    protected function getRedirectUrl(): ?string
    {
        return route('filament.app.pages.painel-saude');
    }


    public function form(Form $form): Form
    {
        return $form->schema([
            DatePicker::make('requested_date')
                ->label('Data do atendimento')
                ->required(),
            TextInput::make('patient_note')
                ->label('Descreva sua necessidade de atendimento'),
            Actions::make([
                Action::make('Confirmar')
                    ->action(fn() => $this->save())
            ])
        ])
            ->statePath('data')
            ->operation('edit');
    }
}
