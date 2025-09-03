<?php

namespace App\Livewire;

use App\Models\User;
use App\Services\FolhaPontoService;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\File;
use Livewire\Component;

class FrequencySubmit extends Component implements HasForms
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

    public function submit(FolhaPontoService $ponto)
    {
        $formData = $this->form->getState()['data'];

        $filePath = storage_path('app/public/' . $formData['anexo']);
        $file = new File($filePath);

        try {
            $ponto->submitSheet(
                Auth::user(),
                $formData['year'],
                $formData['month'],
                $file
            );

            Notification::make()
                ->title('Folha de ponto encaminhada.')
                ->body('Um servidor da URH irá atender a sua solicitação.')
                ->success()
                ->send();

            return redirect()->route('filament.app.pages.print-frequency');
        } catch (\Exception $e) {
            // $this->notify('danger', $e->getMessage());
        }
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Section::make()
                ->heading('Envio de Folha de Ponto')
                ->description('Preencha os dados, selecione o arquivo e envie. Após o envio, o RH irá avaliar a sua folha.')
                ->statePath('data')
                ->schema([
                    Select::make('user_id')
                        ->label('Usuário')
                        ->options(fn() => User::orderBy('login')->pluck('login', 'id')->toArray())
                        ->searchable(),
                    Select::make('month')
                        ->required()
                        ->native(false)
                        ->label('Mês')
                        ->options([
                            'janeiro' => 'Janeiro',
                            'fevereiro' => 'Fevereiro',
                            'março' => 'Março',
                            'abril' => 'Abril',
                            'maio' => 'Maio',
                            'junho' => 'Junho',
                            'julho' => 'Julho',
                            'agosto' => 'Agosto',
                            'setembro' => 'Setembro',
                            'outubro' => 'Outubro',
                            'novembro' => 'Novembro',
                            'dezembro' => 'Dezembro',
                        ]),
                    // ->options([
                    //     1 => 'Janeiro',
                    //     2 => 'Fevereiro',
                    //     3 => 'Março',
                    //     4 => 'Abril',
                    //     5 => 'Maio',
                    //     6 => 'Junho',
                    //     7 => 'Julho',
                    //     8 => 'Agosto',
                    //     9 => 'Setembro',
                    //     10 => 'Outubro',
                    //     11 => 'Novembro',
                    //     12 => 'Dezembro',
                    // ]),
                    TextInput::make('year')
                        ->required()
                        ->label('Ano'),
                    FileUpload::make('anexo'),
                    Actions::make([
                        Action::make('Enviar')
                            ->action('submit')
                    ])
                ])
        ]);
    }

    public function render()
    {
        return view('livewire.frequency-submit');
    }
}
