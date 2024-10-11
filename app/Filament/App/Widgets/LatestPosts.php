<?php

namespace App\Filament\App\Widgets;

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
                            ->size('40px')
                            ->circular(),
                        TextColumn::make('user.login')
                            ->weight(FontWeight::Bold)
                            ->grow(false),
                        TextColumn::make('updated_at')
                            ->badge()
                            ->color('gray')
                            ->dateTime('d M Y, H:i'),
                    ]),

                    TextColumn::make('text')
                        ->label('Lotação')
                        ->html()
                        ->searchable()
                ])->space(3)
            ]);
    }
}
