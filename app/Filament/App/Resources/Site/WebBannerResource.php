<?php

namespace App\Filament\App\Resources\Site;

use App\Filament\App\Resources\Site\WebBannerResource\Pages;
use App\Filament\App\Resources\Site\WebBannerResource\RelationManagers;
use App\Models\WebBanner;
use App\Models\WebBannerPlace;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WebBannerResource extends Resource
{
    protected static ?string $model = WebBanner::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Site';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Forms\Components\Select::make('web_banner_place_id')
                    ->label('Local do Banner')
                    ->options(fn() => WebBannerPlace::all()->pluck('name', 'id'))
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->label('Nome')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('url')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('status')
                    ->required()
                    ->default('published')
                    ->options([
                        'published' => 'Publicado',
                        'unpublished' => 'Despublicado',
                    ]),
                SpatieMediaLibraryFileUpload::make('file')
                    ->label('Arquivo (.jpg)')
                    ->previewable(false)
                    ->image(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('id', 'desc')
            ->columns([
                SpatieMediaLibraryImageColumn::make('file')
                    ->label('#')
                    ->extraAttributes(['class' => 'w-8']),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome')
                    ->limit()
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('user_created.login')
                    ->label('Autor')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
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
            'index' => Pages\ListWebBanners::route('/'),
            'create' => Pages\CreateWebBanner::route('/create'),
            'edit' => Pages\EditWebBanner::route('/{record}/edit'),
        ];
    }
}
