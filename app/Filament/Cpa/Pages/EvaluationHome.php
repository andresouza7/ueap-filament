<?php

namespace App\Filament\Cpa\Pages;

use App\Models\Category;
use App\Models\Course;
use App\Models\Evaluation;
use App\Models\Respondent;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;

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
                Wizard::make([
                    Wizard\Step::make('Identificação')
                        ->description('Informe seu CPF para começar.')
                        ->schema([
                            // ...
                            TextInput::make('cpf')
                                ->helperText('Seus dados não serão compartilhados com a comissão avaliadora.')
                                ->live(onBlur: true)
                                ->label('CPF')
                                ->afterStateUpdated(function (?string $state, Set $set) {
                                    // ...
                                    $respondent = Respondent::where('cpf', $state)->first();
                                    if ($respondent) {
                                        $set('category_id', $respondent->category_id);
                                        $set('name', $respondent->name);
                                    }
                                })
                                ->required(),
                            TextInput::make('name')
                                ->live(onBlur: true)
                                ->visible(fn(Get $get) => $get('cpf'))
                                ->required()
                                ->label('Nome')
                                ->afterStateUpdated(function (?string $state, Get $get, Set $set) {
                                    // ...
                                    $respondent = Respondent::where('cpf', $get('cpf'))->first();

                                    if (!$respondent) {
                                        $respondent = Respondent::create([
                                            'cpf' => $get('cpf'),
                                            'name' => $state,
                                            'category_id' => 4
                                        ]);
                                    }

                                    $set('category_id', optional($respondent)->category_id);
                                }),
                        ]),
                    Wizard\Step::make('Confirme seus dados.')
                        ->schema([
                            // ...
                            Select::make('category_id')
                                ->options(fn() => Category::all()->pluck('name', 'id'))
                                ->label('Categoria')
                                ->required(),
                            TextInput::make('name')
                                ->required()
                                ->label('Nome'),
                            Select::make('course')
                                ->label('Curso')
                                ->visible(fn(Get $get) => in_array($get('category_id'), [2, 3]))
                                ->required()
                                ->options(fn() => Course::all()->pluck('name', 'id')),
                        ]),
                ])->submitAction(new HtmlString(Blade::render(<<<BLADE
                <x-filament::button
                    type="submit"
                    size="sm"
                >
                    Iniciar Avaliação
                </x-filament::button>
            BLADE))),
            ])
            ->statePath('data');
    }

    public function create(): void
    {
        dd($this->form->getState());
    }

    public function onStartEvaluation()
    {
        $respondent = Respondent::firstOrCreate([
            'cpf' => $this->data['cpf'],
            'name' => $this->data['name']
        ]);

        if (!$respondent->category_id) {
            $respondent->update(['category_id' => 4]);
        }

        $evaluationData = [
            'respondent_id' => $respondent->id,
            'category_id' => $respondent->category_id,
        ];

        if (!empty($this->data['course_id'])) {
            $evaluationData['course_id'] = $this->data['course_id'];
        }

        $evaluation = Evaluation::firstOrCreate($evaluationData);

        return redirect()->route('filament.cpa.pages.evaluation-question', ['id' => $evaluation->id]);
    }
}
