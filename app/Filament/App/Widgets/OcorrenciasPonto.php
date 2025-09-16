<?php

namespace App\Filament\App\Widgets;

use App\Models\CalendarOccurrence;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class OcorrenciasPonto extends BaseWidget
{
    // protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        $today = now();

        return $table
            ->heading('Ocorrências de ponto')
            ->paginated(false)
            ->query(
                CalendarOccurrence::query()
                    ->where('type', 1)
                    ->whereMonth('start_date', date('m'))
                    ->whereYear('start_date', date('Y'))
            )
            ->columns([
                Split::make([

                    Tables\Columns\TextColumn::make('start_date')
                        ->label('Início')
                        ->weight('medium')
                        ->date('d/m'),

                    Tables\Columns\TextColumn::make('description')
                        ->label('Descrição')
                        ->limit(30),
                ])
            ])
            ->defaultSort('start_date', 'asc');
    }
}
