<?php

namespace App\Filament\App\Resources\Social\SocialUsers;

use App\Filament\App\Resources\Social\SocialGroups\SocialGroupResource;
use Filament\Schemas\Schema;
use Filament\Support\Enums\TextSize;
use Filament\Actions\BulkActionGroup;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Actions;
use Filament\Actions\Action;
use Filament\Schemas\Components\Flex;
use App\Filament\App\Resources\Social\SocialUsers\Pages\ListSocialUser;
use App\Filament\App\Resources\Social\SocialUsers\Pages\ViewSocialUser;
use App\Filament\App\Resources\Social\SocialUserResource\Pages;
use App\Filament\App\Resources\Social\SocialUsers\RelationManagers\CalendarOccurrencesRelationManager;
use App\Filament\App\Resources\Social\SocialUsers\RelationManagers\OrdinancesRelationManager;
use App\Filament\App\Resources\Social\SocialUsers\RelationManagers\PostsRelationManager;
use App\Filament\Resources\Social\SocialUsers\Schemas\SocialUserInfolist;
use App\Filament\Resources\Social\SocialUsers\Tables\SocialUsersTable;
use App\Models\User;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\IconPosition;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

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
