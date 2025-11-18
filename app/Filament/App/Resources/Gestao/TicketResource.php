<?php

namespace App\Filament\App\Resources\Gestao;

use App\Filament\App\Resources\Gestao\TicketResource\Pages;
use App\Models\Ticket;
use App\Services\FolhaPontoService;
use Filament\Actions\Action;
use LvjuniorUeap\GoogleDriveUploader\GoogleDrive;
use Filament\Forms;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Utilities\Get as UtilitiesGet;
use Filament\Schemas\Schema;


class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;
    protected static ?int $navigationSort = 8;

    public static function getModelLabel(): string
    {
        return 'Ponto Enviado';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Pontos Enviados';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Gestão';
    }

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-rectangle-stack';
    }

    public static function infolist(Schema $schema): Schema
    {
        return $infolist
            ->schema([
                TextEntry::make('user.person.name'),
                TextEntry::make('month'),
                TextEntry::make('year'),
                TextEntry::make('user_notes'),
            ]);
    }



    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Group::make()->schema([
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->numeric(),

                Forms\Components\TextInput::make('file_id')
                    ->maxLength(255),

                Forms\Components\TextInput::make('file_path')
                    ->maxLength(255),

                Forms\Components\TextInput::make('month')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('year')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('status')
                    ->required()
                    ->default('pendente'),

                Forms\Components\TextInput::make('evaluador_id')
                    ->numeric(),

                Forms\Components\DatePicker::make('evaluated_at'),
            ])
        ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->heading('Pontos encaminhados')
            ->description('Gerencie aqui as solicitações encaminhadas.')
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('user.person.name')
                    ->label('Servidor')
                    ->searchable(),
                Tables\Columns\TextColumn::make('month')
                    ->label('Mês')
                    ->searchable(),
                Tables\Columns\TextColumn::make('year')
                    ->label('Ano')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Enviado em')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('evaluador.person.name')
                    ->label('Avaliador'),
                Tables\Columns\TextColumn::make('evaluated_at')
                    ->label('Avaliado em')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
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
                            ->required(fn(UtilitiesGet $get) => $get('status') === 'rejeitado'),
                    ])
                    ->action(function (array $data, $record, FolhaPontoService $service) {
                        try {
                            // $record->update([
                            //     'status' => $data['status'],
                            //     'evaluator_notes' => $data['evaluator_notes'] ?? null,
                            //     'evaluador_id' => auth()->id(),
                            //     'evaluated_at' => now(),
                            // ]);

                            $service->evaluateTicket($record, $data['status'], $data['evaluator_notes']);

                            Notification::make()
                                ->title('Folha de ponto avaliada!')
                                ->success();

                            Notification::make()
                                ->title('Folha de ponto avaliada')
                                ->body("O ponto de {$record->month}/{$record->year} foi atualizado!")
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

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'view' => Pages\ViewTicket::route('/{record}'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
        ];
    }
}
