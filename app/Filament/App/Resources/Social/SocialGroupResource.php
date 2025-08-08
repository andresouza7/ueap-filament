<?php

namespace App\Filament\App\Resources\Social;

use App\Filament\App\Resources\Social\SocialGroupResource\Pages;
use App\Filament\App\Resources\Social\SocialGroupResource\RelationManagers\UsersRelationManager;
use App\Models\Group;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Group as ComponentsGroup;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Split as ComponentsSplit;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\TextEntry\TextEntrySize;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Split;
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
            ->heading('Consulta de Setores da UEAP')
            ->description('Lista dos setores da instituição e suas hierarquias. Use o filtro de busca para localizar informações específicas.')
            ->columns([
                Stack::make([
                    Split::make([
                        // ImageColumn::make('photo_url')
                        //     ->grow(false),
                        TextColumn::make('name')
                            ->formatStateUsing(fn($state) => strtoupper($state))
                            ->weight(FontWeight::Bold)
                            ->size(TextColumn\TextColumnSize::Large)
                            ->searchable(),
                    ])->extraAttributes(['class' => 'mb-4']),

                    TextColumn::make('description')->extraAttributes(['class' => 'mt-1'])
                        ->size(TextColumn\TextColumnSize::ExtraSmall)
                        ->color('gray')
                        ->weight(FontWeight::SemiBold)
                        ->searchable(),
                    Split::make([
                        TextColumn::make('parent.name')
                            ->color('primary')
                            ->formatStateUsing(fn($state) => strtoupper($state))
                            ->size(TextColumn\TextColumnSize::ExtraSmall)
                            ->weight(FontWeight::SemiBold),
                        TextColumn::make('users_count')->counts('users')
                            ->icon('heroicon-o-users')
                            ->weight(FontWeight::SemiBold)
                            ->alignEnd()
                    ]),
                ])
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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Informações funcionais')
                    ->columns(1)
                    ->schema([
                        ComponentsSplit::make([
                            ImageEntry::make('photo_url')
                                ->size('48px')
                                ->grow(false)
                                ->hiddenLabel(),
                            TextEntry::make('name')
                                ->hiddenLabel()
                                ->formatStateUsing(fn($state) => "<div style='font-size: 30px; font-weight: bold;'>" . strtoupper(e($state)) . "/UEAP</div>")
                                ->html(),
                        ])->verticallyAlignCenter()->extraAttributes(['class' => 'my-4']),

                        ComponentsGroup::make([
                            TextEntry::make('description')
                                ->label('Nome')
                                ->color('gray')
                                ->formatStateUsing(fn($state) => strtoupper($state))
                                ->weight(FontWeight::SemiBold),
                            TextEntry::make('parent.description')
                                ->visible(fn($state) => $state)
                                ->label('Vinculado a')
                                ->formatStateUsing(fn($state) => strtoupper($state))
                                ->weight(FontWeight::SemiBold)
                                ->color('gray'),
                        ]),
                    ])
            ]);
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
            'index' => Pages\ListSocialGroups::route('/'),
            // 'create' => Pages\CreateSocialGroup::route('/create'),
            // 'edit' => Pages\EditSocialGroup::route('/{record}/edit'),
            'view' => Pages\ViewSocialGroup::route('/{record}'),
        ];
    }
}
