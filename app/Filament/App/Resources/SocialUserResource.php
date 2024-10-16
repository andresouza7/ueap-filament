<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\SocialUserResource\Pages;
use App\Filament\App\Resources\SocialUserResource\RelationManagers\CalendarOccurrencesRelationManager;
use App\Filament\App\Resources\SocialUserResource\RelationManagers\OrdinancesRelationManager;
use App\Filament\App\Resources\SocialUserResource\RelationManagers\PostsRelationManager;
use App\Models\User;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
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
            ->heading('Consulta de servidores da UEAP')
            ->description('Esta tabela apresenta os servidores da Universidade, incluindo seus cargos, departamentos e status de atividade. Utilize os filtros e opções de busca para localizar informações específicas.')
            ->columns([
                //
                Stack::make([
                    Split::make([
                        ImageColumn::make('profile_photo_url')
                            ->grow(false)
                            ->size('50px')
                            ->circular(),
                        TextColumn::make('login')
                            ->size('100px')
                            ->weight(FontWeight::Bold)
                            // ->icon('heroicon-o-user')
                            ->label('Nome')
                            ->searchable(),
                    ])->extraAttributes(['class' => 'mb-5']),
                    Stack::make([
                        TextColumn::make('effective_role.description')
                            ->tooltip(fn($state) => $state)
                            ->size(TextColumn\TextColumnSize::ExtraSmall)
                            ->weight(FontWeight::SemiBold)
                            ->words(5)
                            ->icon('heroicon-o-briefcase')
                            ->formatStateUsing(fn($state) => strtoupper($state))
                            ->label('Lotação'),
                        TextColumn::make('group.name')
                            ->badge()
                            ->icon('heroicon-o-building-office-2')
                            ->formatStateUsing(fn($state) => strtoupper($state))
                            ->label('Lotação'),

                    ])->space(2)

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
                // Tables\Actions\ViewAction::make(),
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
                    ->columns(3)
                    ->schema([
                        Group::make([
                            ImageEntry::make('profile_photo_url')
                                ->grow(false)
                                ->hiddenLabel()
                                ->circular()
                                ->alignCenter()
                                ->columnSpan(1)
                                ->size(200),
                            TextEntry::make('login')
                                ->size(TextEntry\TextEntrySize::Large)
                                ->weight(FontWeight::Bold)
                                ->alignCenter()
                                ->hiddenLabel(),
                            TextEntry::make('enrollment')
                                ->formatStateUsing(fn($state) => "Mat.: " . $state)
                                ->hiddenLabel()
                                ->alignCenter()
                                ->copyable()
                                ->badge()
                                ->color('success'),
                        ]),

                        Group::make([
                            \Filament\Infolists\Components\Split::make([
                                TextEntry::make('person.name')
                                    ->label('Nome')
                            ]),

                            TextEntry::make('email')
                                ->label('Email')
                                ->icon('heroicon-m-envelope'),
                            TextEntry::make('group.description')
                            ->url(fn($record) => $record->group ? SocialGroupResource::getUrl('view', ['record' => $record->group->id]) : null) 
                                ->label('Lotação')
                                ->icon('heroicon-o-building-office-2'),
                            TextEntry::make('effective_role.description')
                                ->label('Cargo Efetivo')
                                ->icon('heroicon-o-briefcase'),
                            TextEntry::make('commissioned_role.description')
                                ->label('Cargo Comissionado')
                                ->icon('heroicon-o-briefcase')
                                ->columnSpanFull(),
                        ])->columnStart([
                            'sm' => 2,
                        ])
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
            'view' => Pages\ViewSocialUser::route('/{record}'),
        ];
    }
}
