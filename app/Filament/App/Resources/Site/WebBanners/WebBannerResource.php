<?php

namespace App\Filament\App\Resources\Site\WebBanners;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use App\Filament\App\Resources\Site\WebBanners\Pages\ListWebBanners;
use App\Filament\App\Resources\Site\WebBanners\Pages\CreateWebBanner;
use App\Filament\App\Resources\Site\WebBanners\Pages\EditWebBanner;
use App\Filament\App\Resources\Site\WebBannerResource\Pages;
use App\Filament\App\Resources\Site\WebBannerResource\RelationManagers;
use App\Models\WebBanner;
use App\Models\WebBannerPlace;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WebBannerResource extends Resource
{
    protected static ?string $model = WebBanner::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string | \UnitEnum | null $navigationGroup = 'Site';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make([
                    Select::make('web_banner_place_id')
                        ->label('Local do Banner')
                        ->options(fn() => WebBannerPlace::all()->pluck('name', 'id'))
                        ->required(),
                    TextInput::make('name')
                        ->label('Nome')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('url')
                        ->required()
                        ->maxLength(255),
                    Select::make('status')
                        ->required()
                        ->default('published')
                        ->options([
                            'published' => 'Publicado',
                            'unpublished' => 'Despublicado',
                        ]),

                    FileUpload::make('file')
                        ->label('Arquivo JPG')
                        ->directory('web/banners')
                        ->acceptedFileTypes(['image/jpeg'])
                        ->previewable(false)
                        ->maxFiles(1)
                        ->getUploadedFileNameForStorageUsing(fn($record) => $record?->id . '.jpg')

                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('id', 'desc')
            ->columns([
                ImageColumn::make('image_url')
                    ->label('#'),
                TextColumn::make('name')
                    ->label('Nome')
                    ->limit(50)
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->searchable(),
                TextColumn::make('user_created.login')
                    ->label('Autor')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
                ForceDeleteAction::make(),
                RestoreAction::make(),
                Action::make('download')
                    ->url(fn($record) => $record->image_url)
                    ->openUrlInNewTab()
                    ->visible(fn($record) => $record->image_url)
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => ListWebBanners::route('/'),
            'create' => CreateWebBanner::route('/create'),
            'edit' => EditWebBanner::route('/{record}/edit'),
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
