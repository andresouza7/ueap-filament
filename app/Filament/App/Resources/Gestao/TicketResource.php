<?php

namespace App\Filament\App\Resources\Gestao;

use App\Filament\App\Resources\Gestao\TicketResource\Pages;
use App\Filament\App\Resources\Gestao\TicketResource\RelationManagers;
use App\Models\Ticket;
use App\Services\FolhaPontoService;
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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;
    protected static ?string $modelLabel = 'Pontos Enviados';
    protected static ?string $navigationGroup = 'Gestão';
    protected static ?int $navigationSort = 8;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('user.person.name'),
                TextEntry::make('month'),
                TextEntry::make('year'),
                TextEntry::make('user_notes'),
            ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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
                    ->maxLength(255)
                    ->default('pendente'),
                Forms\Components\TextInput::make('evaluador_id')
                    ->numeric(),
                Forms\Components\DatePicker::make('evaluated_at'),
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
                    ->default('pendente') // exibe por padrão apenas os pendentes
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('avaliar')
                    ->form([
                        Radio::make('status')
                            ->options([
                                'aprovado' => 'Aprovado',
                                'rejeitado' => 'Rejeitado',
                            ])
                            ->live()
                            ->required(),
                        Textarea::make('evaluator_notes')
                            ->label('Justificativa')
                            ->required(fn(Get $get) => $get('status') === 'rejeitado')
                    ])
                    ->action(function (array $data, $record, FolhaPontoService $ponto) {
                        try {
                            $ponto->evaluateTicket($record, $data['status'], $data['evaluator_notes']);
                            Notification::make()
                                ->title('Folha de ponto aprovada')
                                ->body("Seu ponto de {$record->month}/{$record->year} está ok!")
                                ->sendToDatabase($record->user);
                        } catch (\Throwable $th) {
                            Notification::make()
                                ->title('Erro ao avaliar')
                                // ->body('Arquivo do Google Drive não encontrado.')
                                ->body($th->getMessage())
                                ->danger()
                                ->send();
                        }
                    })
                    ->visible(fn($record) => $record->status == 'pendente'),
                // Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('anexo')
                    ->url(fn($record) => $record->file_path)
                    ->openUrlInNewTab()
                    ->visible(fn($record) => $record->file_path)
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
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
