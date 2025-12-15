<?php

namespace App\Filament\App\Resources\Social\ProtocolProcesses;

use Filament\Schemas\Schema;
use App\Filament\App\Resources\Social\ProtocolProcesses\Pages\ListProtocolProcesses;
use App\Filament\App\Resources\Social\ProtocolProcesses\Pages\ViewProtocolProcess;
use App\Filament\App\Resources\Social\ProtocolProcesses\RelationManagers\HistoriesRelationManager;
use App\Filament\App\Resources\Social\ProtocolProcesses\Schemas\ProtocolProcessInfolist;
use App\Filament\App\Resources\Social\ProtocolProcesses\Tables\ProtocolProcessesTable;
use App\Models\ProtocolProcess;
use Filament\Resources\Resource;
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
        return ProtocolProcessInfolist::configure($schema);
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([]);
    }

    public static function table(Table $table): Table
    {
        return ProtocolProcessesTable::configure($table);
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
