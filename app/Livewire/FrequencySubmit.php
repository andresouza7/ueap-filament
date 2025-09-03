<?php

namespace App\Livewire;

use App\Models\Ticket;
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
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action as TableAction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\File;
use Livewire\Component;

class FrequencySubmit extends Component implements HasForms, HasTable
{
    use InteractsWithForms, InteractsWithTable;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'month' => date('m') - 1,
            'year' => date('Y')
        ]);
    }

    public function submit(FolhaPontoService $ponto)
    {
        $formData = $this->form->getState()['data'];

        $filePath = storage_path('app/public/' . $formData['anexo']);
        $file = new File($filePath);

        $user = User::where('id', $formData['user_id'])->first();

        try {
            $ponto->submitSheet(
                $user,
                $formData['year'],
                $formData['month'],
                $file
            );

            // Delete the temporary local file
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            Notification::make()
                ->title('Folha de ponto encaminhada.')
                ->body('Um servidor da URH irá atender a sua solicitação.')
                ->success()
                ->send();

            return redirect()->route('filament.app.pages.print-frequency');
        } catch (\Exception $e) {
            Notification::make()
                ->title('Erro ao enviar folha')
                ->body($e->getMessage())
                ->danger()
                ->send();
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

    public function table(Table $table): Table
    {
        return $table
            ->heading('Minhas solicitações')
            ->description('Acompanhe aqui as suas folhas encaminhadas')
            ->query(Ticket::query()->latest('id')->where('user_id', auth()->id()))
            ->columns([
                TextColumn::make('user.person.name')
                    ->label('Servidor')
                    ->searchable(),
                TextColumn::make('month')
                    ->label('Mês')
                    ->searchable(),
                TextColumn::make('year')
                    ->label('Ano')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Enviado em')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('evaluador.person.name')
                    ->label('Avaliador'),
                TextColumn::make('evaluated_at')
                    ->label('Avaliado em')
                    ->date()
                    ->sortable(),
            ])
            ->actions([
                TableAction::make('anexo')
                    ->url(fn($record) => $record->file_path)
                    ->openUrlInNewTab()
                    ->visible(fn($record) => $record->file_path)
            ]);
    }

    public function render()
    {
        return view('livewire.frequency-submit');
    }
}
