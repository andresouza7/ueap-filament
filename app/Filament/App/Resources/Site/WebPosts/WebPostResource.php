<?php

namespace App\Filament\App\Resources\Site\WebPosts;

use App\Models\WebPost;
use App\Filament\App\Resources\Site\WebPosts\Pages\ListWebPosts;
use App\Filament\App\Resources\Site\WebPosts\Pages\CreateWebPost;
use App\Filament\App\Resources\Site\WebPosts\Pages\EditWebPost;
use App\Filament\Resources\Social\WebPosts\Schemas\WebPostForm;
use App\Filament\Resources\Social\WebPosts\Tables\WebPostsTable;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WebPostResource extends Resource
{
    protected static ?string $model = WebPost::class;

    protected static ?string $modelLabel = 'Publicação';

    protected static ?string $pluralModelLabel = 'Publicações';

    protected static string | \BackedEnum | null $navigationIcon = Heroicon::OutlinedNewspaper;

    protected static string | \UnitEnum | null $navigationGroup = 'Site';

    public static function form(Schema $schema): Schema
    {
        return WebPostForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WebPostsTable::configure($table);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([SoftDeletingScope::class]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListWebPosts::route('/'),
            'create' => CreateWebPost::route('/create'),
            'edit' => EditWebPost::route('/{record}/edit'),
        ];
    }
}
