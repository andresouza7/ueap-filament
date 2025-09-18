<?php

namespace App\Filament\App\Resources\Site;

use App\Filament\App\Resources\Gestao\PortariaResource;
use App\Filament\App\Resources\Site\PortariaConsuResource\Pages;
use App\Filament\App\Resources\Site\PortariaConsuResource\RelationManagers;
use App\Models\Portaria;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PortariaConsuResource extends Resource
{
    protected static ?string $model = Portaria::class;

    protected static ?string $modelLabel = 'Portaria Consu';

    protected static ?string $pluralModelLabel = 'Portarias Consu';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Site';

    // protected static ?int $navigationSort = 0;

    public static function canAccess(): bool
    {
        return auth()->user()->hasAnyRole('ascom|dinfo');
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('origin', 'CONSU');
    }

    public static function form(Form $form): Form
    {
        return $form->schema(PortariaResource::getPortariaForm());
    }

    public static function table(Table $table): Table
    {
        return PortariaResource::getPortariaTable($table);
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
            'index' => Pages\ListPortarias::route('/'),
            'create' => Pages\CreatePortaria::route('/create'),
            'edit' => Pages\EditPortaria::route('/{record}/edit'),
        ];
    }
}
