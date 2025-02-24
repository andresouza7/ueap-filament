<?php

namespace App\Livewire;

use App\Models\CalendarOccurrence;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FrequencyEmit extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'type' => 0,
            'month' => date('m') - 1,
            'year' => date('Y')
        ]);
    }

    public function create()
    {
        $formData = $this->form->getState();

        $user = Auth::user();

        $occurrences = CalendarOccurrence::where('type', 3)->where('user_id', $user->id)->orWhere('type', 1)->get();
        $occurrences_user = CalendarOccurrence::where('type', 2)->where('user_id', $user->id)->get();

        $data = array_merge(
            $formData,
            [
                'user' => $user,
                'occurrences' => $occurrences,
                'occurrences_user' => $occurrences_user,
            ]
        );
        // return redirect()->route('frequency.print', $data);

        // Generate the URL where the data should be submitted
        $url = route('frequency.print', $data); // Assuming the route exists

        // Dispatch a browser event to open a new tab
        return $this->dispatch('open-new-tab', $url);
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Section::make([
                Split::make([
                    Group::make([
                        Select::make('type')
                            ->required()
                            ->label('Ponto')
                            ->options([
                                'Efetivo',
                                'Comissionado',
                                'Sem Preenchimento'
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
                            ->label('Usar assinatura'),
                    ]),
                    Group::make([
                        Split::make([
                            DateTimePicker::make('manha_start')
                                ->date(false)
                                ->seconds(false)
                                ->label('Entrada Manhã'),
                            DateTimePicker::make('manha_end')
                                ->date(false)
                                ->seconds(false)
                                ->label('Saída Manhã'),
                        ]),
                        Split::make([
                            DateTimePicker::make('tarde_start')
                                ->date(false)
                                ->seconds(false)
                                ->label('Entrada Tarde'),
                            DateTimePicker::make('tarde_end')
                                ->date(false)
                                ->seconds(false)
                                ->label('Saída Tarde'),
                        ]),
                        Split::make([
                            DateTimePicker::make('noite_start')
                                ->date(false)
                                ->seconds(false)
                                ->label('Entrada Noite'),
                            DateTimePicker::make('noite_end')
                                ->date(false)
                                ->seconds(false)
                                ->label('Saída Noite'),
                        ]),
                        Toggle::make('preencher_horario'),
                    ]),
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
