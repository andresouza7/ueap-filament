<?php

namespace App\Filament\Resources\SocialCommissionedResource\Pages;

use App\Filament\Resources\SocialCommissionedResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSocialCommissioneds extends ListRecords
{
    protected static string $resource = SocialCommissionedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
