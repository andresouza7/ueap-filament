<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SocialUserResource\Pages;
use App\Filament\Resources\SocialUserResource\RelationManagers\CalendarOccurrencesRelationManager;
use App\Filament\Resources\SocialUserResource\RelationManagers\OrdinancesRelationManager;
use App\Filament\Resources\SocialUserResource\RelationManagers\PostsRelationManager;
use App\Models\Person;
use App\Models\User;
use App\Models\SocialUser;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SocialUserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $modelLabel = 'Servidor';
    protected static ?string $pluralModelLabel = 'Servidores';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $slug = 'servidor';

    protected static ?string $navigationGroup = 'Social';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('name')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Stack::make([
                    ImageColumn::make('profile_photo_url')
                        ->circular(),
                    TextColumn::make('person.name')
                        ->icon('heroicon-o-user')
                        ->label('Nome')
                        ->searchable(),
                    TextColumn::make('group.name')
                        ->icon('heroicon-o-building-office-2')
                        ->weight(FontWeight::Bold)
                        ->formatStateUsing(fn($state) => strtoupper($state))
                        ->label('Lotação')
                ])->space(2)
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Dados Funcionais')
                    ->columns(2)
                    ->schema([
                        ImageEntry::make('profile_photo_url')
                            ->columnSpanFull()
                            ->hiddenLabel()
                            // ->circular()
                            ->width(100),
                        TextEntry::make('person.name')->label('Nome'),
                        TextEntry::make('enrollment')->label('Matrícula'),
                        TextEntry::make('email')->label('Email'),
                        TextEntry::make('group.description')->label('Lotação'),
                        TextEntry::make('effective_role.description')->label('Cargo Efetivo'),
                        TextEntry::make('commissioned_role.description')->label('Cargo Comissionado')
                            ->columnSpanFull(),
                    ])
            ]);
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
            'index' => Pages\ListSocialUser::route('/'),
            'create' => Pages\CreateSocialUser::route('/create'),
            'view' => Pages\ViewSocialUser::route('/{record}'),
            // 'edit' => Pages\EditSocialUser::route('/{record}/edit'),
        ];
    }
}
