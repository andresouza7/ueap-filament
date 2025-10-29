<?php

namespace App\Filament\Resources\Social\SocialGroups\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\TextSize;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SocialGroupsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->heading('Consulta de Setores da UEAP')
            ->description('Use o campo de busca para localizar uma informação específica.')
            ->columns([
                Stack::make([
                    Split::make([
                        // ImageColumn::make('photo_url')
                        //     ->grow(false),
                        TextColumn::make('name')
                            ->formatStateUsing(fn($state) => strtoupper($state))
                            ->weight(FontWeight::Bold)
                            ->size(TextSize::Large)
                            ->searchable(),
                    ])->extraAttributes(['class' => 'mb-4']),

                    TextColumn::make('description')->extraAttributes(['class' => 'mt-1'])
                        ->size(TextSize::ExtraSmall)
                        ->color('secondary')
                        ->weight(FontWeight::SemiBold)
                        ->searchable(),
                    Split::make([
                        TextColumn::make('parent.name')
                            ->color('primary')
                            ->formatStateUsing(fn($state) => strtoupper($state))
                            ->size(TextSize::ExtraSmall)
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
            ->recordActions([
                // Tables\Actions\EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
