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
                    ->columns(1)
                    ->schema([
                        Flex::make([
                            ImageEntry::make('photo_url')
                                ->size('48px')
                                ->grow(false)
                                ->hiddenLabel(),
                            TextEntry::make('name')
                                ->hiddenLabel()
                                ->formatStateUsing(fn($state) => "<div style='font-size: 30px; font-weight: bold;'>" . strtoupper(e($state)) . "/UEAP</div>")
                                ->html(),
                        ])->verticallyAlignCenter()->extraAttributes(['class' => 'my-4']),

                        Group::make([
                            TextEntry::make('description')
                                ->label('Nome')
                                ->color('secondary')
                                ->formatStateUsing(fn($state) => strtoupper($state))
                                ->weight(FontWeight::SemiBold),
                            TextEntry::make('parent.description')
                                ->visible(fn($state) => $state)
                                ->label('Vinculado a')
                                ->formatStateUsing(fn($state) => strtoupper($state))
                                ->weight(FontWeight::SemiBold)
                                ->color('secondary'),
                        ]),
                    ])
            ]);
    }
}
