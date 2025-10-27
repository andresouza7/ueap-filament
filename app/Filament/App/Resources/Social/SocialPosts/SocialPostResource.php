<?php

namespace App\Filament\App\Resources\Social\SocialPosts;

use Filament\Schemas\Schema;
use App\Filament\App\Resources\Social\SocialPosts\Pages\ListSocialPosts;
use App\Filament\App\Resources\Social\SocialPosts\Pages\CreateSocialPost;
use App\Filament\App\Resources\Social\SocialPosts\Pages\EditSocialPost;
use App\Filament\Resources\Social\SocialPosts\Schemas\SocialPostForm;
use App\Filament\Resources\Social\SocialPosts\Tables\SocialPostsTable;
use App\Models\SocialPost;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class SocialPostResource extends Resource
{
    protected static ?string $model = SocialPost::class;
    protected static ?string $modelLabel = 'Postagem';
    protected static ?string $pluralModelLabel = 'Postagens';
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-pencil-square';
    protected static ?string $slug = 'postagens';
    protected static string | \UnitEnum | null $navigationGroup = 'Social';
    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return SocialPostForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SocialPostsTable::configure($table);
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
            'index' => ListSocialPosts::route('/'),
            'create' => CreateSocialPost::route('/create'),
            // 'view' => Pages\ViewSocialPost::route('/{record}'),
            'edit' => EditSocialPost::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ])->where('user_id', Auth::id());
    }
}
