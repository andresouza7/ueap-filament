<?php

namespace App\Filament\App\Resources\Gestao\MapaFerias\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

class MapaFeriasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->description('Pesquise por palavra-chave ou filtre por período.')
            ->defaultSort('id', 'desc')
            ->columns([
                TextColumn::make('description')
                    ->label('Descrição')
                    ->limit(80)
                    ->searchable(isIndividual: true),
                TextColumn::make('user.login')
                    ->label('Usuário')
                    ->searchable(isIndividual: true),
                TextColumn::make('start_date')
                    ->label('Data Início')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('end_date')
                    ->label('Data Fim')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Filter::make('date_range')
                    ->schema([
                        DatePicker::make('from')->label('Data início'),
                        DatePicker::make('until')->label('Data fim'),
                    ])
                    ->query(function ($query, array $data): void {
                        $query
                            ->when(
                                $data['from'],
                                fn($q, $date) => $q->whereDate('start_date', '>=', $date)
                            )
                            ->when(
                                $data['until'],
                                fn($q, $date) => $q->whereDate('end_date', '<=', $date)
                            );
                    }),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
