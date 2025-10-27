<?php

namespace App\Filament\App\Resources\Social\SocialUsers;

use Filament\Schemas\Schema;
use App\Filament\App\Resources\Social\SocialUsers\Pages\ListSocialUser;
use App\Filament\App\Resources\Social\SocialUsers\Pages\ViewSocialUser;
use App\Filament\App\Resources\Social\SocialUsers\RelationManagers\CalendarOccurrencesRelationManager;
use App\Filament\App\Resources\Social\SocialUsers\RelationManagers\OrdinancesRelationManager;
use App\Filament\App\Resources\Social\SocialUsers\RelationManagers\PostsRelationManager;
use App\Filament\Resources\Social\SocialUsers\Schemas\SocialUserInfolist;
use App\Filament\Resources\Social\SocialUsers\Tables\SocialUsersTable;
use App\Models\User;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SocialUserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $modelLabel = 'Servidor';
    protected static ?string $pluralModelLabel = 'Servidores';
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-users';
    protected static ?string $slug = 'servidor';
    protected static string | \UnitEnum | null $navigationGroup = 'Social';
    protected static ?int $navigationSort = 2;
    protected static bool $shouldSkipAuthorization = true;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                TextInput::make('name')
            ]);
    }

    public static function table(Table $table): Table
    {
        return SocialUsersTable::configure($table);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SocialUserInfolist::configure($schema);
    }

    public static function getRelations(): array
    {
        return [
            //
            PostsRelationManager::class,
            OrdinancesRelationManager::class,
            CalendarOccurrencesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSocialUser::route('/'),
            'view' => ViewSocialUser::route('/{record}'),
        ];
    }
}
