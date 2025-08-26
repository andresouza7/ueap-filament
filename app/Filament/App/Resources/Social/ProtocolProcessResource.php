<?php

namespace App\Filament\App\Resources\Social;

use App\Filament\App\Resources\Social\ProtocolProcessResource\Pages;
use App\Filament\App\Resources\Social\ProtocolProcessResource\RelationManagers;
use App\Filament\App\Resources\Social\ProtocolProcessResource\RelationManagers\HistoriesRelationManager;
use App\Models\ProtocolProcess;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProtocolProcessResource extends Resource
{
    protected static ?string $model = ProtocolProcess::class;
    protected static ?string $modelLabel = 'Consultar Processo';
    protected static ?string $pluralModelLabel = 'Consultar Processos';
    protected static ?string $navigationGroup = 'Protocolo Digital';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Section::make('Dados do Processo')
                ->columns(3)
                ->schema([
                    TextEntry::make('number')
                        ->label('Nro Processo'),
                    TextEntry::make('external_number')
                        ->label('Código E-DOC'),
                    TextEntry::make('subject.description')
                        ->label('Serviço Solicitado'),
                    TextEntry::make('description')
                        ->label('Descrição'),
                    TextEntry::make('created_at')
                        ->label('Data de Abertura')
                        ->dateTime('d M Y, H:i'),
                    TextEntry::make('group_received.description')
                        ->label('Último Trâmite para'),
                    TextEntry::make('status')
                        ->badge(),
                ]),

            Section::make('Dados do Interessado')
                ->columns(3)
                ->schema([
                    TextEntry::make('person.name')
                        ->label('Nome'),
                    TextEntry::make('person.cpf_cnpj')
                        ->label('CPF')
                ]),

        ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('id', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('number')
                    ->label('Processo')
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('subject.description')
                    ->label('Serviço')
                    ->extraAttributes([
                        'class' => 'whitespace-normal max-w-xs break-words',
                    ])
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('description')
                    ->label('Descrição')
                    ->extraAttributes([
                        'class' => 'whitespace-normal max-w-xs break-words',
                    ])
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('person.name')
                    ->label('Interessado')
                    ->extraAttributes([
                        'class' => 'whitespace-normal max-w-xs break-words',
                    ])
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('group_received.description')
                    ->label('Último Trâmite')
                    ->extraAttributes([
                        'class' => 'whitespace-normal max-w-xs break-words',
                    ])
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
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
            HistoriesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProtocolProcesses::route('/'),
            // 'create' => Pages\CreateProtocolProcess::route('/create'),
            'view' => Pages\ViewProtocolProcess::route('/{record}'),
            // 'edit' => Pages\EditProtocolProcess::route('/{record}/edit'),
        ];
    }
}
