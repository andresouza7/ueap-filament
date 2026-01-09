<?php

namespace App\Livewire;

use App\Models\Ticket;
use App\Models\User;
use App\Services\FolhaPontoService;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FrequencySubmit extends Component implements HasForms, HasTable, HasSchemas
{
    use InteractsWithForms, InteractsWithTable, InteractsWithActions;

    public ?array $data = [];
    public ?User $user = null;
    public bool $isManualInsertion = false;

    protected array $months = [
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
    ];

    public function mount(?int $userId = null): void
    {
        // Verifica se é o próprio usuário ou a urh que está cadastrando
        $this->isManualInsertion = filled($userId);
        $this->user = $userId ? User::find($userId) : Auth::user();

        $this->form->fill([
            'month' => now()->month - 1,
            'year'  => now()->year,
        ]);
    }

    // ----------------------------------------
    // Helpers
    // ----------------------------------------

    private function getFileObject(string $filePath): File
    {
        return new File(storage_path('app/public/' . $filePath));
    }

    private function deleteTempFile(string $path): void
    {
        if (file_exists($path)) {
            unlink($path);
        }
    }

    private function notifySuccess(): void
    {
        Notification::make()
            ->title('Folha de ponto encaminhada.')
            ->body('A URH irá atender a sua solicitação.')
            ->success()
            ->send();
    }

    private function notifyError(string $message): void
    {
        Notification::make()
            ->title('Erro ao enviar folha')
            ->body($message)
            ->danger()
            ->send();
    }

    private function handleRedirect(): mixed
    {
        if (!$this->isManualInsertion) {
            return redirect()->route('filament.app.pages.print-frequency');
        }
        return null;
    }

    // ----------------------------------------
    // Submit
    // ----------------------------------------

    public function submit(FolhaPontoService $ponto)
    {
        $form = $this->form->getState()['data'];

        $tempFilePath = storage_path('app/public/' . $form['anexo']);
        $file = $this->getFileObject($form['anexo']);

        try {
            $ticket = $this->isManualInsertion
                ? $ponto->manualInsertSheet($this->user, $form['year'], $form['month'], $form['user_notes'], $file)
                : $ponto->submitSheet($this->user, $form['year'], $form['month'], $form['user_notes'], $file);

            $this->deleteTempFile($tempFilePath);
            $this->notifySuccess();

            $this->form->fill([]);

            return $this->handleRedirect();
        } catch (\Throwable $e) {
            $this->notifyError($e->getMessage());
        }
    }

    // ----------------------------------------
    // Form Schema
    // ----------------------------------------

    public function form(Schema $form): Schema
    {
        return $form->schema([
            Section::make()
                ->heading('Envio de Folha de Ponto')
                ->description('Preencha os dados, selecione o arquivo e envie.')
                ->statePath('data')
                ->schema([
                    Select::make('month')
                        ->required()
                        ->native(false)
                        ->label('Mês')
                        ->options($this->months),

                    TextInput::make('year')
                        ->required()
                        ->mask('9999')
                        ->numeric()
                        ->minValue(2010)
                        ->maxValue(fn() => now()->year)
                        ->label('Ano'),

                    FileUpload::make('anexo')
                        ->required()
                        ->label('Arquivo PDF'),

                    Textarea::make('user_notes')
                        ->label('Observações')
                        ->rows(3),

                    Actions::make([
                        Action::make('Enviar')
                            ->action('submit')
                            ->color('primary'),
                    ]),
                ])
        ]);
    }

    // ----------------------------------------
    // Table
    // ----------------------------------------

    public function table(Table $table): Table
    {
        return $table
            ->heading('Histórico de envios')
            ->description('Folhas encaminhadas e sua situação junto ao RH.')
            ->query(
                fn() => Ticket::query()
                    ->latest('id')
                    ->where('user_id', $this->user->id)
            )
            ->columns([
                TextColumn::make('month')->label('Mês'),
                TextColumn::make('year')->label('Ano'),
                TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'warning' => 'pendente',
                        'success' => 'aprovado',
                        'danger'  => 'rejeitado',
                    ])
                    ->label('Status'),
                TextColumn::make('created_at')->label('Enviado em')->date('d/m/Y')->sortable(),
                TextColumn::make('evaluator.login')->label('Avaliador'),
                TextColumn::make('evaluated_at')->label('Avaliado em')->date('d/m/Y')->sortable(),
                TextColumn::make('evaluator_notes')->label('Motivo Rejeição'),
            ])
            ->recordActions([
                Action::make('anexo')
                    ->url(fn($record) => $record->file_path)
                    ->openUrlInNewTab()
                    ->visible(fn($record) => filled($record->file_path)),
            ]);
    }

    public function render()
    {
        return view('livewire.frequency-submit');
    }
}
