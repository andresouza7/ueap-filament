<?php

namespace App\Filament\Widgets;

use App\Models\SocialPost;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestPosts extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(SocialPost::query())
            ->columns([
                Stack::make([
                    TextColumn::make('user.login')
                        ->icon('heroicon-o-user'),
                    TextColumn::make('updated_at')
                        ->badge()
                        ->color('gray')
                        ->dateTime(),
                    TextColumn::make('text')
                        ->label('Lotação')
                        ->html()
                        ->searchable()
                ])->space(3),
            ]);
        // ->contentGrid([
        //     'xl' => 1,
        // ]);
    }
}
