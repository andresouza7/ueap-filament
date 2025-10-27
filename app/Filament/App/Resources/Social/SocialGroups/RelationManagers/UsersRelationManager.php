<?php

namespace App\Filament\App\Resources\Social\SocialGroups\RelationManagers;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Support\Enums\TextSize;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\App\Resources\Social\SocialUsers\SocialUserResource;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UsersRelationManager extends RelationManager
{
    protected static string $relationship = 'users';
    protected static ?string $title = 'Servidores';
    protected static bool $shouldSkipAuthorization = true;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('login')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('login')
            ->recordUrl(fn($record) => $record->id ? SocialUserResource::getUrl('view', ['record' => $record->id]) : null)
            ->columns([
                Split::make([
                    ImageColumn::make('profile_photo_url')
                        ->grow(false)
                        ->imageSize('70px')
                        ->circular(),
                    Stack::make([
                        TextColumn::make('login')
                            ->size('100px')
                            ->weight(FontWeight::SemiBold)
                            ->formatStateUsing(fn($state) => collect(explode('.', $state))
                                ->map(fn($part) => ucfirst(trim($part)))
                                ->implode(' '))
                            ->searchable(),

                        TextColumn::make('effective_role.description')
                            ->size(TextSize::ExtraSmall)
                            ->color('gray')
                            ->weight(FontWeight::SemiBold)
                            ->columnSpanFull()
                            ->formatStateUsing(fn($state) => strtoupper($state)),
                    ])->space(2)

                ]),

                // Stack::make([
                //     Split::make([
                //         ImageColumn::make('profile_photo_url')
                //             ->grow(false)
                //             ->size('50px')
                //             ->circular(),
                //         TextColumn::make('login')
                //             ->size('100px')
                //             ->weight(FontWeight::Bold)
                //             ->label('Nome')
                //             ->searchable()
                //             ->url(fn($record) => $record->id ? SocialUserResource::getUrl('view', ['record' => $record->id]) : null)
                //     ])
                //     ->extraAttributes(['class' => 'mb-5'])

                //     ,
                //     Stack::make([
                //         TextColumn::make('effective_role.description')
                //             ->tooltip(fn($state) => $state)
                //             ->size(TextColumn\TextColumnSize::ExtraSmall)
                //             ->weight(FontWeight::SemiBold)
                //             ->words(5)
                //             ->icon('heroicon-o-briefcase')
                //             ->formatStateUsing(fn($state) => strtoupper($state))
                //             ->label('Lotação'),

                //     ])->space(2)

                // ])->space(2)
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // CreateAction::make(),
            ])
            ->recordActions([
                // EditAction::make(),
                // DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // DeleteBulkAction::make(),
                ]),
            ]);
    }
}
