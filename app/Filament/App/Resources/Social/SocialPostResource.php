<?php

namespace App\Filament\App\Resources\Social;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;
use Filament\Support\Enums\TextSize;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use App\Filament\App\Resources\Social\SocialPostResource\Pages\ListSocialPosts;
use App\Filament\App\Resources\Social\SocialPostResource\Pages\CreateSocialPost;
use App\Filament\App\Resources\Social\SocialPostResource\Pages\EditSocialPost;
use App\Filament\App\Resources\Social\SocialPostResource\Pages;
use App\Models\SocialPost;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Filament\Support\Colors\Color;

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
        return $schema
            ->components([
                Grid::make()
                    ->columns(1)
                    ->schema([
                        RichEditor::make('text')
                            ->label('Texto')
                            ->required()
                            ->disableToolbarButtons(['attachFiles'])
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
                    Split::make([
                        ImageColumn::make('user.profile_photo_url')
                            ->grow(false)
                            ->size('60px')
                            ->circular(),
                        Stack::make([
                            Split::make([
                                TextColumn::make('user.login')
                                    ->url(fn($record) => SocialUserResource::getUrl('view', ['record' => $record->user->id]))
                                    ->weight(FontWeight::Bold)
                                    ->grow(false),

                                TextColumn::make('user.group.name')
                                    ->url(fn($record) => SocialGroupResource::getUrl('view', ['record' => optional($record->user->group)->id]))
                                    ->formatStateUsing(fn($state) => strtoupper($state))
                                    ->weight(FontWeight::Bold)
                                    ->color(Color::Teal)
                            ]),

                            TextColumn::make('updated_at')
                                ->size(TextSize::ExtraSmall)
                                // ->extraAttributes(['class' => 'italic'])
                                ->color('gray')
                                ->dateTime('d M Y, H:i'),
                        ]),
                    ]),

                    TextColumn::make('text')
                        ->html()
                        ->searchable()
                ])->space(3)->extraAttributes(['class' => 'gap-2 p-2'])
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                // Tables\Actions\ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
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
