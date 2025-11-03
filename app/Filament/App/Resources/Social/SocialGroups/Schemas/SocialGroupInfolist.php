<?php

namespace App\Filament\Resources\Social\SocialGroups\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;

class SocialGroupInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Dados do setor')
                    ->columns(2)
                    ->schema([

                        // Left column: photo + main name
                        Flex::make([
                            ImageEntry::make('photo_url')
                                ->imageSize('56px')
                                ->grow(false)
                                ->hiddenLabel(),
                            TextEntry::make('name')
                                ->hiddenLabel()
                                ->formatStateUsing(fn($state) => "
                                    <div style='font-size: 28px; font-weight: bold; line-height: 1.2;'>
                                        " . strtoupper(e($state)) . " / UEAP
                                    </div>
                                ")
                                ->html(),
                        ])
                        ->columnSpan(2)
                        ->verticallyAlignCenter()
                        ->extraAttributes(['class' => 'py-4']),

                        // Column 1
                        Group::make([
                            TextEntry::make('description')
                                ->label('Nome')
                                ->color('secondary')
                                ->formatStateUsing(fn($state) => strtoupper($state))
                                ->weight(FontWeight::SemiBold),
                        ])
                        ->columnSpan(1),

                        // Column 2
                        Group::make([
                            TextEntry::make('parent.description')
                                ->visible(fn($state) => $state)
                                ->label('Vinculado a')
                                ->formatStateUsing(fn($state) => strtoupper($state))
                                ->weight(FontWeight::SemiBold)
                                ->color('secondary'),
                        ])
                        ->columnSpan(1),
                    ]),
            ]);
    }
}
