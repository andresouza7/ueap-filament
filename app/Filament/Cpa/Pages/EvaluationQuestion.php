<?php

namespace App\Filament\Cpa\Pages;

use App\Models\Question;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;

class EvaluationQuestion extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $title = 'Responder Avaliação';

    protected static string $view = 'filament.cpa.pages.evaluation-question';

    public ?array $data = [];

    public function mount(): void
    {
        $question = Question::all()->random();
        $this->form->fill($question->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Radio::make('score')
                    ->required()
                    ->label('Nota')
                    ->inline()
                    ->inlineLabel(false)
                    ->options([
                        1 => '1',
                        2 => '2',
                        3 => '3',
                        4 => '4',
                        5 => '5',
                    ])
                // ...
            ])
            ->statePath('data');
    }

    public function create(): void
    {
        dd($this->form->getState());
    }
}
