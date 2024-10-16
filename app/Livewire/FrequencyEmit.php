<?php

namespace App\Livewire;

use App\Models\CalendarOccurrence;
use Filament\Forms\Components\Group;
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

        return redirect()->route('frequency.print', array_merge(
            $formData,
            [
                'user' => $user,
                'occurrences' => $occurrences,
                'occurrences_user' => $occurrences_user,
            ]
        ));
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Split::make([
                Group::make([
                    Select::make('type')
                        ->label('Ponto')
                        ->options([
                            'Efetivo',
                            'Comissionado',
                            'Sem Preenchimento'
                        ]),
                    Select::make('month')
                        ->label('Mês')
                        ->options([
                            'Janeiro',
                            'Fevereiro',
                            'Março',
                            'Abril',
                            'Maio',
                            'Junho',
                            'Julho',
                            'Agosto',
                            'Setembro',
                            'Outubro',
                            'Novembro',
                            'Dezembro',
                        ]),
                    TextInput::make('year')
                        ->label('Ano'),
                    Toggle::make('usar_assinatura'),
                ]),
                Group::make([
                    Split::make([
                        TextInput::make('manha_start')
                            ->label('Entrada Manhã'),
                        TextInput::make('manha_end')
                            ->label('Saída Manhã'),
                    ]),
                    Split::make([
                        TextInput::make('tarde_start')
                            ->label('Entrada Tarde'),
                        TextInput::make('tarde_end')
                            ->label('Saída Tarde'),
                    ]),
                    Split::make([
                        TextInput::make('noite_start')
                            ->label('Entrada Noite'),
                        TextInput::make('noite_end')
                            ->label('Saída Noite'),
                    ]),
                    Toggle::make('preencher_horario'),
                ]),
            ])->from('md')
        ])
            ->statePath('data');
    }

    public function render()
    {
        return view('livewire.frequency-emit');
    }
}
