<?php

namespace App\Filament\App\Resources\SocialGroupResource\RelationManagers;

use App\Filament\App\Resources\SocialUserResource;
use Filament\Forms;
use Filament\Forms\Form;
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

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('login')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('login')
            ->columns([
                Split::make([
                    ImageColumn::make('profile_photo_url')
                        ->grow(false)
                        ->size('70px')
                        ->circular(),
                    Stack::make([
                        TextColumn::make('login')
                            ->size('100px')
                            ->url(fn($record) => $record->id ? SocialUserResource::getUrl('view', ['record' => $record->id]) : null)
                            ->weight(FontWeight::SemiBold)
                            ->formatStateUsing(fn($state) => collect(explode('.', $state))
                                ->map(fn($part) => ucfirst(trim($part)))
                                ->implode(' '))
                            ->searchable(),

                        TextColumn::make('effective_role.description')
                            ->size(TextColumn\TextColumnSize::ExtraSmall)
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
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
