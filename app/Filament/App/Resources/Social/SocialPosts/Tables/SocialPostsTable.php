<?php

namespace App\Filament\Resources\Social\SocialPosts\Tables;

use App\Filament\App\Resources\Social\SocialGroups\SocialGroupResource;
use App\Filament\App\Resources\Social\SocialUsers\SocialUserResource;
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
use Filament\Support\Colors\Color;
use Illuminate\Database\Eloquent\Builder;

class SocialPostsTable
{
    public static function configure(Table $table): Table
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
}
