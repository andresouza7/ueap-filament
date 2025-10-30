<?php

namespace App\Filament\App\Resources\Site\PortariaConsus;

use Filament\Schemas\Schema;
use App\Filament\App\Resources\Site\PortariaConsus\Pages\ListPortarias;
use App\Filament\App\Resources\Site\PortariaConsus\Pages\CreatePortaria;
use App\Filament\App\Resources\Site\PortariaConsus\Pages\EditPortaria;
use App\Filament\App\Resources\Gestao\Portarias\PortariaResource;
use App\Filament\Resources\Gestao\Portarias\Schemas\PortariaForm;
use App\Filament\Resources\Gestao\Portarias\Tables\PortariasTable;
use App\Models\Portaria;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PortariaConsuResource extends Resource
{
    protected static ?string $model = Portaria::class;

    protected static ?string $modelLabel = 'Portaria Consu';

    protected static ?string $pluralModelLabel = 'Portarias Consu';

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string | \UnitEnum | null $navigationGroup = 'Site';

    // protected static ?int $navigationSort = 0;

    public static function canAccess(): bool
    {
        return auth()->user()->hasAnyRole('ascom|dinfo');
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('origin', 'CONSU');
    }

    public static function form(Schema $schema): Schema
    {
        return PortariaForm::configure($schema);
    }

    public static function table(Table $table): Table
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
            'edit' => EditPortaria::route('/{record}/edit'),
        ];
    }
}
