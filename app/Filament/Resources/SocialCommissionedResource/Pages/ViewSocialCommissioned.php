<?php

namespace App\Filament\Resources\SocialCommissionedResource\Pages;

use App\Filament\Resources\SocialCommissionedResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSocialCommissioned extends ViewRecord
{
    protected static string $resource = SocialCommissionedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
