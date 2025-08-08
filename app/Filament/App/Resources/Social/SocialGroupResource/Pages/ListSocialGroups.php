<?php

namespace App\Filament\App\Resources\Social\SocialGroupResource\Pages;

use App\Filament\App\Resources\Social\SocialGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSocialGroups extends ListRecords
{
    protected static string $resource = SocialGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
