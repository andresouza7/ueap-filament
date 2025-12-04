<?php

namespace App\Filament\Resources\ActivityLogs\Tables;

use App\Filament\Exports\ActivityLogExporter;
use App\Models\ActivityLog;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ActivityLogsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('id', 'desc')
            ->columns([
                TextColumn::make('id')
                    ->sortable()
                    ->label('#')
                    ->toggleable()
                    ->grow(false),

                TextColumn::make('event')
                    ->label('Tipo de Ação')
                    ->badge()
                    ->colors([
                        'success' => 'created',
                        'warning' => 'updated',
                        'danger'  => 'deleted',
                    ])
                    ->sortable(),

                TextColumn::make('subject_type')
                    ->label('Entidade Afetada')
                    ->formatStateUsing(fn($state, $record) => class_basename($state) . " (#{$record->subject_id})")
                    ->color('primary')
                    ->sortable(),

                TextColumn::make('causer_type')
                    ->label('Responsável')
                    ->formatStateUsing(fn($state, $record) => $record->causer
                        ? class_basename($state) . " (#{$record->causer->login})"
                        : 'Sistema')
                    ->color('secondary'),

                TextColumn::make('created_at')
                    ->label('Data')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('subject_type')
                    ->label('Entidade Afetada')
                    ->options(fn() => ActivityLog::distinct('subject_type')->pluck('subject_type', 'subject_type'))
                    ->searchable(),

                SelectFilter::make('causer_id')
                    ->label('Responsável')
                    ->options(function () {
                        return User::with('person')->orderBy('login')
                            ->get()
                            ->mapWithKeys(function ($user) {
                                return [
                                    $user->id => $user->person?->name ?? $user->login,
                                ];
                            })
                            ->toArray();
                    })
                    ->searchable(),

                SelectFilter::make('event')
                    ->label('Tipo de Ação')
                    ->options([
                        'created' => 'Criado',
                        'updated' => 'Atualizado',
                        'deleted' => 'Deletado',
                        'register' => 'Registro',
                        'login' => 'Login',
                        'logout' => 'Logout',
                    ]),

                Filter::make('periodo')
                    ->label('Período')
                    ->schema([
                        DateTimePicker::make('inicio')
                            ->label('Início'),

                        DateTimePicker::make('fim')
                            ->label('Fim'),
                    ])
                    ->query(function ($query, array $data) {

                        return $query
                            ->when(
                                $data['inicio'],
                                fn($q) =>
                                $q->whereTime('created_at', '>=', $data['inicio'])
                            )
                            ->when(
                                $data['fim'],
                                fn($q) =>
                                $q->whereTime('created_at', '<=', $data['fim'])
                            );
                    })
                    ->indicateUsing(function (array $data) {
                        $indicators = [];

                        if ($data['inicio'] ?? false) {
                            $indicators[] = 'De: ' . \Carbon\Carbon::parse($data['inicio'])->format('d/m/Y H:i');
                        }

                        if ($data['fim'] ?? false) {
                            $indicators[] = 'Até: ' . \Carbon\Carbon::parse($data['fim'])->format('d/m/Y H:i');
                        }

                        return $indicators;
                    })
            ])
            ->recordActions([
                ViewAction::make()->label('Visualizar'),
                // EditAction::make()->label('Editar'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // DeleteBulkAction::make()->label('Excluir'),
                ]),
            ])
            ->headerActions([
                ExportAction::make('export')
                    ->color('primary')
                    ->exporter(ActivityLogExporter::class)
            ])
            ->heading('Registros de Atividades')
            ->description('Central de auditoria. Consulte os principais eventos e ações realizados pelos usuários no sistema.');
    }
}
