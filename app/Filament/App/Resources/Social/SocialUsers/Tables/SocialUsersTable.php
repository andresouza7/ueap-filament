<?php

namespace App\Filament\Resources\Social\SocialUsers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\TextSize;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SocialUsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->heading('Consulta de Servidores da UEAP')
            ->description('Lista dos servidores da universidade, seus cargos e lotações. Use o filtro de busca para encontrar informações.')
            ->defaultSort('login')
            ->columns([
                Split::make([
                    ImageColumn::make('profile_photo_url')
                        ->grow(false)
                        ->size('70px')
                        ->circular(),
                    Stack::make([
                        TextColumn::make('login')
                            ->size('100px')
                            ->weight(FontWeight::SemiBold)
                            ->formatStateUsing(fn($state) => collect(explode('.', $state))
                                ->map(fn($part) => ucfirst(trim($part)))
                                ->implode(' '))
                            ->searchable(),

                        Stack::make([
                            TextColumn::make('effective_role.description')
                                ->tooltip(fn($state) => $state)
                                ->size(TextSize::ExtraSmall)
                                ->color('gray')
                                ->weight(FontWeight::SemiBold)
                                ->words(5)
                                ->columnSpanFull()
                                ->formatStateUsing(fn($state) => strtoupper($state)),

                            TextColumn::make('group.name')
                                ->color('primary')
                                ->formatStateUsing(fn($state) => strtoupper($state))
                                ->size(TextSize::ExtraSmall)
                                ->weight(FontWeight::SemiBold),
                        ])
                    ])->space(2)
                ]),
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->filters([
                //
            ])
            ->recordActions([
                // Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
