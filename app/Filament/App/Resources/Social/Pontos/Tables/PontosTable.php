<?php

namespace App\Filament\Resources\Social\Pontos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PontosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->heading('Minhas Ocorrências de Ponto')
            ->description('Gerencie as alterações de expediente na sua folha de ponto.')
            ->recordTitleAttribute('description')
            ->defaultSort('start_date', 'desc')
            ->modifyQueryUsing(fn(Builder $query) => $query->where('user_id', Auth::id())->where('type', 3))
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
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // DeleteBulkAction::make(),
                ]),
            ]);
    }
}
