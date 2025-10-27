<?php

namespace App\Filament\App\Resources\Gestao\Users;

use Filament\Schemas\Schema;
use App\Filament\App\Resources\Gestao\Users\Pages\ListUsers;
use App\Filament\App\Resources\Gestao\Users\Pages\CreateUser;
use App\Filament\App\Resources\Gestao\Users\Pages\EditUser;
use App\Filament\Resources\Gestao\Users\Schemas\UserForm;
use App\Filament\Resources\Gestao\Users\Tables\UsersTable;
use App\Models\User;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $modelLabel = 'Servidor';
    protected static ?string $pluralModelLabel = 'Servidores';
    protected static string | \UnitEnum | null $navigationGroup = 'Gestão';
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-users';
    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return UserForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UsersTable::configure($table);
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
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            // 'view' => Pages\ViewUser::route('/{record}'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                // SoftDeletingScope::class,
            ]);
    }
}
