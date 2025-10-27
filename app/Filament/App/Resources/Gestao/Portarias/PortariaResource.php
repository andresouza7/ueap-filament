<?php

namespace App\Filament\App\Resources\Gestao\Portarias;

use Filament\Schemas\Schema;
use App\Filament\App\Resources\Gestao\Portarias\Pages\ListPortarias;
use App\Filament\App\Resources\Gestao\Portarias\Pages\CreatePortaria;
use App\Filament\App\Resources\Gestao\Portarias\Pages\EditPortaria;
use App\Filament\Resources\Gestao\Portarias\Schemas\PortariaForm;
use App\Filament\Resources\Gestao\Portarias\Tables\PortariasTable;
use App\Models\Portaria;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PortariaResource extends Resource
{
    protected static ?string $model = Portaria::class;
    protected static ?string $modelLabel = 'Portaria';
    protected static ?string $pluralModelLabel = 'Portarias';
    protected static string | \UnitEnum | null $navigationGroup = 'Gestão';
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-document-text';
    protected static ?int $navigationSort = 5;

    public static function form(Schema $schema): Schema
    {
        return PortariaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return self::getPortariaTable($table);
    }

    public static function getPortariaTable(Table $table)
    {
        return PortariasTable::configure($table);
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
            'index' => ListPortarias::route('/'),
            'create' => CreatePortaria::route('/create'),
            // 'view' => Pages\ViewDocumentOrdinance::route('/{record}'),
            'edit' => EditPortaria::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ])->whereNot('origin', 'CONSU');
    }
}
