<?php

namespace App\Filament\App\Resources\Gestao\Tickets\Tables;

use App\Services\FolhaPontoService;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

class TicketsTable
{
    public static function configure(Table $table): Table
    {
        return $table->heading('Pontos encaminhados')
            ->description('Gerencie aqui as solicitações encaminhadas.')
            ->defaultSort('created_at', 'desc')
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
                TextColumn::make('evaluator.person.name')
                    ->label('Avaliador'),
                TextColumn::make('evaluated_at')
                    ->label('Avaliado em')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pendente'   => 'Pendente',
                        'aprovado'   => 'Aprovado',
                        'rejeitado'  => 'Rejeitado',
                    ])
                    ->default('pendente'),
            ])
            ->recordActions([
                // Action de avaliação
                Action::make('avaliar')
                    ->schema([
                        Radio::make('status')
                            ->options([
                                'aprovado' => 'Aprovado',
                                'rejeitado' => 'Rejeitado',
                            ])
                            ->live()
                            ->required(),
                        Textarea::make('evaluator_notes')
                            ->label('Justificativa')
                            ->required(fn(callable $get) => $get('status') === 'rejeitado'),
                    ])
                    ->action(function (array $data, $record, FolhaPontoService $service) {
                        try {

                            $service->evaluateTicket($record, $data['status'], $data['evaluator_notes']);

                            Notification::make()
                                ->title('Folha de ponto avaliada!')
                                ->success()
                                ->send();

                            Notification::make()
                                ->title('Folha de ponto avaliada')
                                ->body("Seu ponto de {$record->month}/{$record->year} foi avaliado!")
                                ->success()
                                ->sendToDatabase($record->user);
                        } catch (\Throwable $th) {
                            Notification::make()
                                ->title('Erro ao avaliar')
                                ->body($th->getMessage())
                                ->danger()
                                ->send();
                        }
                    })
                    ->visible(fn($record) => $record->status === 'pendente'),

                // Action de download/anexo
                Action::make('anexo')
                    ->url(fn($record) => $record->file_path)
                    ->openUrlInNewTab()
                    ->visible(fn($record) => $record->file_path),
            ]);
    }
}
