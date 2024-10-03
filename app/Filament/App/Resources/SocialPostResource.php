<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\SocialPostResource\Pages;
use App\Models\SocialPost;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class SocialPostResource extends Resource
{
    protected static ?string $model = SocialPost::class;
    protected static ?string $modelLabel = 'Postagem';
    protected static ?string $pluralModelLabel = 'Postagens';

    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';

    protected static ?string $slug = 'postagens';

    protected static ?string $navigationGroup = 'Social';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
                    ->columns(1)
                    ->schema([
                        RichEditor::make('text')
                            ->label('Texto')
                            ->required()
                            ->extraInputAttributes(['style' => 'min-height: 20rem; max-height: 50vh; overflow-y: auto;'])
                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('updated_at', 'desc')
            ->recordUrl(fn() => null)
            ->columns([
                Stack::make([
                    TextColumn::make('user.login')
                        ->icon('heroicon-o-user'),
                    TextColumn::make('updated_at')
                        ->badge()
                        ->color('gray')
                        ->dateTime(),
                    TextColumn::make('text')
                        ->label('Lotação')
                        ->html()
                        ->searchable()
                ])->space(3)
            ])
            // ->contentGrid([
            //     'xl' => 1,
            // ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                    // Tables\Actions\ForceDeleteBulkAction::make(),
                    // Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListSocialPosts::route('/'),
            'create' => Pages\CreateSocialPost::route('/create'),
            // 'view' => Pages\ViewSocialPost::route('/{record}'),
            'edit' => Pages\EditSocialPost::route('/{record}/edit'),
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
