<?php

namespace App\Filament\App\Resources\Gestao\MapaFerias;

use Filament\Schemas\Schema;
use App\Filament\App\Resources\Gestao\MapaFerias\Pages\ListFerias;
use App\Filament\App\Resources\Gestao\MapaFerias\Pages\CreateFerias;
use App\Filament\App\Resources\Gestao\MapaFerias\Pages\EditFerias;
use App\Filament\App\Resources\Gestao\MapaFerias\Schemas\MapaFeriasForm;
use App\Filament\App\Resources\Gestao\MapaFerias\Tables\MapaFeriasTable;
use App\Models\CalendarOccurrence;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;

class MapaFeriasResource extends Resource
{
    protected static ?string $model = CalendarOccurrence::class;

    protected static ?string $modelLabel = 'Mapa de Férias';

    protected static string | \UnitEnum | null $navigationGroup = 'Gestão';

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-table-cells';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return MapaFeriasForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MapaFeriasTable::configure($table);
           
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
            'index' => ListFerias::route('/'),
            'create' => CreateFerias::route('/create'),
            'edit' => EditFerias::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('type', 2)->whereYear('start_date', '>=', Carbon::now()->year);
    }
}
