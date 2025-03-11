<?php

namespace App\Livewire;

use App\Filament\App\Resources\PontoResource;
use App\Models\CalendarOccurrence;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FrequencyOccurrences extends Component implements HasForms, HasTable, HasActions
{
    use InteractsWithForms;
    use InteractsWithTable;
    use InteractsWithActions;

    public $occurrences;

    public function mount()
    {
        $this->occurrences = CalendarOccurrence::query()->where('user_id', Auth::id())->where('type', 2)->get();
    }

    public function editAction()
    {
        return EditAction::make()
            ->record(fn(array $arguments) => CalendarOccurrence::find($arguments['occurrence']))
            ->form([
                TextInput::make('description')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading('Minhas Ocorrências de Ponto')
            ->description('Gerencie as alterações de expediente na sua folha de ponto.')
            ->recordTitleAttribute('description')
            ->query(CalendarOccurrence::query()->where('user_id', Auth::id())->where('type', 3))
            ->defaultSort('start_date', 'desc')
            ->recordUrl(fn($record) => PontoResource::getUrl('edit', ['record' => $record->id]))
            ->columns([
                TextColumn::make('description')
                    ->searchable()
                    ->label('Descrição'),
                TextColumn::make('start_date')
                    ->sortable()
                    ->dateTime('d/m/Y')
                    ->label('Data Início'),
                TextColumn::make('end_date')
                    ->sortable()
                    ->dateTime('d/m/Y')
                    ->label('Data Fim'),
            ])
            ->contentGrid([
                'xl' => 1,
            ])
            ->headerActions([
                Action::make('Cadastrar Ocorrência')
                    ->url(PontoResource::getUrl('create'))
            ]);
    }

    private function getActionFormSchema()
    {
        return [
            Select::make('type')
                ->label('Tipo')
                ->options([
                    'FACULTADO',
                    'FALTA',
                    'ATESTADO'
                ]),
            DatePicker::make('start_date')
                ->label('Data Início')
                ->required(),
            DatePicker::make('end_date')
                ->label('Data Fim')
                ->required()
        ];
    }

    public function render()
    {
        return view('livewire.frequency-occurrences');
    }
}
