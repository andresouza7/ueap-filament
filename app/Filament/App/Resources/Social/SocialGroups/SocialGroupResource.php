<?php

namespace App\Filament\App\Resources\Social\SocialGroups;

use Filament\Schemas\Schema;
use App\Filament\App\Resources\Social\SocialGroups\Pages\ListSocialGroups;
use App\Filament\App\Resources\Social\SocialGroups\Pages\ViewSocialGroup;
use App\Filament\App\Resources\Social\SocialGroupResource\Pages;
use App\Filament\App\Resources\Social\SocialGroups\RelationManagers\UsersRelationManager;
use App\Filament\Resources\Social\SocialGroups\Schemas\SocialGroupInfolist;
use App\Filament\Resources\Social\SocialGroups\Tables\SocialGroupsTable;
use App\Models\Group;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SocialGroupResource extends Resource
{
    protected static ?string $model = Group::class;
    protected static ?string $modelLabel = 'Setor';
    protected static ?string $pluralModelLabel = 'Setores';
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-building-office-2';
    protected static ?string $slug = 'setores';
    protected static string | \UnitEnum | null $navigationGroup = 'Social';
    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return SocialGroupsTable::configure($table);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SocialGroupInfolist::configure($schema);
    }

    public static function getRelations(): array
    {
        return [
            UsersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSocialGroups::route('/'),
            // 'create' => Pages\CreateSocialGroup::route('/create'),
            // 'edit' => Pages\EditSocialGroup::route('/{record}/edit'),
            'view' => ViewSocialGroup::route('/{record}'),
        ];
    }
}
