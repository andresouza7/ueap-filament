<?php

namespace App\Livewire;

use App\Models\CalendarOccurrence;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
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

    public function isReadOnly(): bool
    {
        return false;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->heading('Minhas Ocorrências de Ponto')
            ->description('Gerencie as alterações de expediente na sua folha de ponto.')
            ->recordTitleAttribute('description')
            ->query(CalendarOccurrence::query()->where('user_id', Auth::id())->where('type', 2))
            ->defaultSort('start_date', 'desc')
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
                CreateAction::make()
                    ->recordTitle('Ocorrência de Ponto')
                    ->recordTitleAttribute('description')
                // ->form($this->getActionFormSchema()),
            ])
            ->actions([
                \Filament\Tables\Actions\EditAction::make(),
                Action::make('delete')
                    ->requiresConfirmation()
                    ->action(fn($record) => $record->delete()),
                // EditAction::make('dgdfg')->form($this->getActionFormSchema()),
                // DeleteAction::make()
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
