<?php

namespace App\Livewire;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Utilities\Get;
use App\Models\CalendarOccurrence;
use App\Models\User;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FrequencyEmit extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public ?User $record = null;
    public bool $canFillFields = false;

    public function mount(User $record, bool $canFillFields): void
    {
        $this->record = $record;
        $this->canFillFields = $canFillFields;

        $this->form->fill([
            'type' => 0,
            'month' => date('m') - 1 < 1 ? 12 : date('m') - 1,
            'year' => date('Y')
        ]);
    }

    public function create()
    {
        $formData = $this->form->getState();

        $user = $this->record;

        $data = array_merge(
            $formData,
            ['uuid' => $user->uuid]
        );

        // Generate the URL where the data should be submitted
        $url = route('frequency.print', $data); // Assuming the route exists

        // Dispatch a browser event to open a new tab
        \App\Events\ServiceAccessed::dispatch(Auth::user(), 'folha_ponto', 'create');

        return $this->dispatch('open-new-tab', $url);
    }

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make([
                Flex::make([
                    Group::make([
                        TextInput::make('person_name')
                            ->label('Nome')
                            ->disabled()
                            ->formatStateUsing(fn() => $this->record->person?->name ?? 'Sem nome')
                            ->hidden(fn() => $this->canFillFields),
                        Select::make('type')
                            ->label('Ponto')
                            ->required()
                            ->options([
                                'effective_role' => 'Efetivo',
                                'commissioned_role' => 'Comissionado',
                                'none' => 'Sem Preenchimento',
                            ]),
                        Select::make('month')
                            ->required()
                            ->native(false)
                            ->label('Mês')
                            ->options([
                                1 => 'Janeiro',
                                2 => 'Fevereiro',
                                3 => 'Março',
                                4 => 'Abril',
                                5 => 'Maio',
                                6 => 'Junho',
                                7 => 'Julho',
                                8 => 'Agosto',
                                9 => 'Setembro',
                                10 => 'Outubro',
                                11 => 'Novembro',
                                12 => 'Dezembro',
                            ]),
                        TextInput::make('year')
                            ->required()
                            ->label('Ano'),
                        Toggle::make('use_signature')
                            ->label('Usar assinatura')
                            ->visible($this->canFillFields),
                    ]),
                    Group::make([
                        Flex::make([
                            DateTimePicker::make('manha_start')
                                ->date(false)
                                ->seconds(false)
                                ->label('Entrada Manhã')
                                ->disabled(fn(Get $get) => !$get('preencher_horario')),
                            DateTimePicker::make('manha_end')
                                ->date(false)
                                ->seconds(false)
                                ->label('Saída Manhã')
                                ->disabled(fn(Get $get) => !$get('preencher_horario')),
                        ]),
                        Flex::make([
                            DateTimePicker::make('tarde_start')
                                ->date(false)
                                ->seconds(false)
                                ->label('Entrada Tarde')
                                ->disabled(fn(Get $get) => !$get('preencher_horario')),
                            DateTimePicker::make('tarde_end')
                                ->date(false)
                                ->seconds(false)
                                ->label('Saída Tarde')
                                ->disabled(fn(Get $get) => !$get('preencher_horario')),
                        ]),
                        Flex::make([
                            DateTimePicker::make('noite_start')
                                ->date(false)
                                ->seconds(false)
                                ->label('Entrada Noite')
                                ->disabled(fn(Get $get) => !$get('preencher_horario')),
                            DateTimePicker::make('noite_end')
                                ->date(false)
                                ->seconds(false)
                                ->label('Saída Noite')
                                ->disabled(fn(Get $get) => !$get('preencher_horario')),
                        ]),
                        Toggle::make('preencher_horario')->live(),
                    ])->visible($this->canFillFields),
                ])->from('md')
            ])->heading('Preencher folha de ponto')
                ->description('Selecione o tipo do ponto e o período desejado. Você também pode optar por utilizar sua assinatura cadastrada e preencher o horário do expediente.')
        ])->statePath('data');
    }

    public function render()
    {
        return view('livewire.frequency-emit');
    }
}
