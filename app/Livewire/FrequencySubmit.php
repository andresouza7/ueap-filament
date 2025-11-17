<?php

namespace App\Livewire;

use App\Models\Ticket;
use App\Models\User;
use App\Services\FolhaPontoService;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use LvjuniorUeap\GoogleDriveUploader\GoogleDrive;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Section as ComponentsSection;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action as TableAction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\File;
use Livewire\Component;

class FrequencySubmit extends Component implements HasForms, HasTable, HasSchemas
{
    use InteractsWithForms, InteractsWithTable, InteractsWithActions;

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

        // $user = User::where('id', $formData['user_id'])->first();
        $user = Auth::user();

        try {
            $ponto->submitSheet(
                $user,
                $formData['year'],
                $formData['month'],
                $formData['user_notes'],
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

    public function form(Schema $form): Schema
    {
        return $form->schema([
            ComponentsSection::make()
                ->heading('Envio de Folha de Ponto')
                ->description('Preencha os dados, selecione o arquivo e envie. Após o envio, o RH irá avaliar a sua folha.')
                ->statePath('data')
                ->schema([
                    // Select::make('user_id')
                    //     ->label('Usuário')
                    //     ->options(fn() => User::orderBy('login')->pluck('login', 'id')->toArray())
                    //     ->searchable(),
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
                    FileUpload::make('anexo'),

                    Textarea::make('user_notes')
                        ->label('Observações (opcional)'),
                    Actions::make([
                        Action::make('Enviar')
                            ->action('submit')
                    ]),
                ])
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading('Minhas solicitações')
            ->description('Acompanhe aqui as suas folhas encaminhadas')
            ->query(Ticket::query()->latest('id')->where('user_id', Auth::id()))
            ->columns([
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
                TextColumn::make('evaluador.login')
                    ->label('Avaliador'),
                TextColumn::make('evaluated_at')
                    ->label('Avaliado em')
                    ->date()
                    ->sortable(),
                TextColumn::make('evaluator_notes')
                    ->label('Justificativa'),
            ])
            ->recordActions([
                Action::make('anexo')
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
