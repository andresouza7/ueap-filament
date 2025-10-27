<?php

namespace App\Filament\App\Resources\Social\ProtocolProcesses;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\ViewAction;
use Filament\Actions\BulkActionGroup;
use App\Filament\App\Resources\Social\ProtocolProcesses\Pages\ListProtocolProcesses;
use App\Filament\App\Resources\Social\ProtocolProcesses\Pages\ViewProtocolProcess;
use App\Filament\App\Resources\Social\ProtocolProcessResource\Pages;
use App\Filament\App\Resources\Social\ProtocolProcessResource\RelationManagers;
use App\Filament\App\Resources\Social\ProtocolProcesses\RelationManagers\HistoriesRelationManager;
use App\Models\ProtocolProcess;
use Filament\Forms;
use Filament\Infolists\Components\TextEntry;
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
    protected static string | \UnitEnum | null $navigationGroup = 'Protocolo Digital';
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([
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
                    // TextEntry::make('person.cpf_cnpj')
                    //     ->label('CPF')
                ]),

        ]);
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('id', 'desc')
            ->columns([
                TextColumn::make('number')
                    ->label('Processo')
                    ->searchable(isIndividual: true),
                TextColumn::make('subject.description')
                    ->label('Serviço')
                    ->extraAttributes([
                        'class' => 'whitespace-normal max-w-xs break-words',
                    ])
                    ->searchable(isIndividual: true),
                TextColumn::make('description')
                    ->label('Descrição')
                    ->extraAttributes([
                        'class' => 'whitespace-normal max-w-xs break-words',
                    ])
                    ->searchable(isIndividual: true),
                TextColumn::make('person.name')
                    ->label('Interessado')
                    ->extraAttributes([
                        'class' => 'whitespace-normal max-w-xs break-words',
                    ])
                    ->searchable(isIndividual: true),
                TextColumn::make('group_received.description')
                    ->label('Último Trâmite')
                    ->extraAttributes([
                        'class' => 'whitespace-normal max-w-xs break-words',
                    ])
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->searchable(),
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
                //
            ])
            ->recordActions([
                ViewAction::make(),
                // Tables\Actions\EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
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
            'index' => ListProtocolProcesses::route('/'),
            // 'create' => Pages\CreateProtocolProcess::route('/create'),
            'view' => ViewProtocolProcess::route('/{record}'),
            // 'edit' => Pages\EditProtocolProcess::route('/{record}/edit'),
        ];
    }
}
