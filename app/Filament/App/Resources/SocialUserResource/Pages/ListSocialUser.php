<?php

namespace App\Filament\App\Resources\SocialUserResource\Pages;

use App\Filament\App\Resources\SocialUserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSocialUser extends ListRecords
{
    protected static string $resource = SocialUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
