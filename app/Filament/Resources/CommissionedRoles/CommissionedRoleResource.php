<?php

namespace App\Filament\Resources\CommissionedRoles;

use Filament\Schemas\Schema;
use App\Filament\Resources\CommissionedRoles\Pages\ListCommissionedRoles;
use App\Filament\Resources\CommissionedRoles\Pages\CreateCommissionedRole;
use App\Filament\Resources\CommissionedRoles\Pages\EditCommissionedRole;
use App\Filament\Resources\CommissionedRoleResource\Pages;
use App\Filament\Resources\CommissionedRoleResource\RelationManagers;
use App\Filament\Resources\CommissionedRoles\Schemas\CommissionedRoleForm;
use App\Filament\Resources\CommissionedRoles\Tables\CommissionedRoleTable;
use App\Models\CommissionedRole;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CommissionedRoleResource extends Resource
{
    protected static ?string $model = CommissionedRole::class;
    protected static ?string $modelLabel = 'Cargo Comissionado';
    protected static ?string $pluralModelLabel = 'Cargos Comissionados';
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $slug = 'cargo-comissionado';
    protected static string | \UnitEnum | null $navigationGroup = 'Gerência';
    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return CommissionedRoleForm::configure($schema);
    }

     public static function table(Table $table): Table
    {
        return CommissionedRoleTable::configure($table);
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
            'index' => ListCommissionedRoles::route('/'),
            'create' => CreateCommissionedRole::route('/create'),
            'edit' => EditCommissionedRole::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
