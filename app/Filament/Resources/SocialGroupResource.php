<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SocialGroupResource\Pages;
use App\Filament\Resources\SocialGroupResource\RelationManagers;
use App\Models\Group;
use App\Models\SocialGroup;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SocialGroupResource extends Resource
{
    protected static ?string $model = Group::class;
    protected static ?string $modelLabel = 'Setor';
    protected static ?string $pluralModelLabel = 'Setores';

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $slug = 'setores';

    protected static ?string $navigationGroup = 'Social';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Stack::make([
                    TextColumn::make('name')
                        ->formatStateUsing(fn($state) => strtoupper($state))
                        ->weight(FontWeight::Bold)
                        ->icon('heroicon-o-building-office-2')
                        ->label('Nome')
                        ->searchable(),
                    TextColumn::make('description')
                        ->label('Lotação')
                        ->searchable()
                ])->space(3)
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListSocialGroups::route('/'),
            'create' => Pages\CreateSocialGroup::route('/create'),
            // 'edit' => Pages\EditSocialGroup::route('/{record}/edit'),
            'view' => Pages\ViewSocialGroup::route('/{record}'),
        ];
    }
}
