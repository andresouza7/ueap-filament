<?php

namespace App\Filament\App\Resources\Gestao\Users\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\EditAction;
use Filament\Support\Enums\IconSize;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

use function PHPUnit\Framework\isEmpty;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('login')
            ->columns([
                TextColumn::make('person.name')
                    ->label('Nome')
                    ->searchable(),
                TextColumn::make('group.name')
                    ->label('Lotação')
                    ->sortable(),
                TextColumn::make('effective_role.description')
                    ->label('Cargo Efetivo')
                    ->limit(30)
                    ->sortable(),
                TextColumn::make('commissioned_role.description')
                    ->label('Cargo Comissionado')
                    ->badge()
                    ->sortable(),
                TextColumn::make('login')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn($record) => $record->isActive() ? 'Ativo' : 'Inativo')
                    ->color(fn($record) => $record->isActive() ? 'success' : 'danger'),
                TextColumn::make('impediments')
                    ->label('Impedimento')
                    ->badge()
                    ->getStateUsing(fn($record) => count($record->impediments) ? 'Sim' : 'Não')
                    ->color(fn($record) => count($record->impediments) ? 'danger' : 'gray')
                    ->extraAttributes([
                        'class' => 'cursor-help',
                    ])
                    ->action(
                        Action::make('verImpedimentos')
                            ->label('Ver impedimentos')
                            ->modalHeading('Impedimentos do Servidor')
                            ->iconButton()
                            ->icon(Heroicon::RectangleStack)
                            ->iconSize(IconSize::Large)
                            ->modalWidth('4xl')
                            ->modalSubmitAction(false)
                            ->modalCancelActionLabel('Fechar')
                            ->modalContent(fn($record) => view('filament.app.partials.impedimentos-modal', [
                                'impediments' => $record->impediments
                            ])),
                    ),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Tables\Filters\TrashedFilter::make(),
                Filter::make('active')
                    ->label('Apenas Ativos')
                    ->query(fn(Builder $query): Builder => $query->active()),
            ])
            ->recordActions([
                // Tables\Actions\ViewAction::make(),
                Action::make('imprimirPonto')
                    ->label('Ponto')
                    ->icon('heroicon-o-document')
                    ->url(fn($record) => route('filament.app.pages.print-frequency', ['user' => $record->id]))
                    ->openUrlInNewTab(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                    // Tables\Actions\ForceDeleteBulkAction::make(),
                    // Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }
}
