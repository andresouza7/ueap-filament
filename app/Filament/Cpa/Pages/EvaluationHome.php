<?php

namespace App\Filament\Cpa\Pages;

use App\Models\Evaluation;
use App\Models\Respondent;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class EvaluationHome extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $title = 'Iniciar Avaliação';

    protected static string $view = 'filament.cpa.pages.evaluation-home';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('cpf')
                    ->label('CPF')
                    ->required()
                // ...
            ])
            ->statePath('data');
    }

    public function create(): void
    {
        dd($this->form->getState());
    }

    public function onStartEvaluation()
    {
        $respondent = Respondent::where('cpf', $this->data['cpf'])->first();

        // if null redirect to sociedade civil page
        if (!$respondent) {
            Notification::make()
                ->title('CPF não encontrado')
                ->danger()
                ->send();

            return false;
        }

        $evaluation = Evaluation::firstOrCreate([
            'respondent_id' => $respondent->id,
            'category_id' => $respondent->category_id,
        ]);

        return redirect()->route('filament.cpa.pages.evaluation-question', $evaluation->id);
    }

    private function createRespondentEvaluation() {}

    private function verifyCpf()
    {
        return Respondent::where('cpf', $this->data['cpf'])->exists();
    }
}
