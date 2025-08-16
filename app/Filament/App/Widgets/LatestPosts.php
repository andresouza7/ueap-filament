<?php

namespace App\Filament\App\Widgets;

use App\Filament\App\Resources\Social\SocialGroupResource;
use App\Filament\App\Resources\Social\SocialUserResource;
use App\Models\SocialPost;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestPosts extends BaseWidget
{
    // protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->heading('Postagens')
            ->query(SocialPost::query())
            ->defaultSort('created_at', 'desc')
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
                                    ->formatStateUsing(fn($state) => collect(explode('.', $state))
                                        ->map(fn($part) => ucfirst(trim($part)))
                                        ->implode(' '))
                                    ->grow(false),

                                TextColumn::make('user.group.name')
                                    ->url(fn($record) => SocialGroupResource::getUrl('view', ['record' => optional($record->user->group)->id]))
                                    ->formatStateUsing(fn($state) => strtoupper($state))
                                    ->weight(FontWeight::Bold)
                                    ->color('primary')
                            ]),

                            TextColumn::make('updated_at')
                                ->size(TextColumn\TextColumnSize::ExtraSmall)
                                // ->extraAttributes(['class' => 'italic'])
                                ->color('gray')
                                ->dateTime('d M Y, H:i'),
                        ])->grow(false),
                    ]),

                    TextColumn::make('text')
                        ->html()
                        ->searchable()
                ])->space(3)->extraAttributes(['class' => 'gap-2 p-2'])
            ]);
    }
}
