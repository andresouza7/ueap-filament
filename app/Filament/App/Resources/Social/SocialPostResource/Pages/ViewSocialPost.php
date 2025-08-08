<?php

namespace App\Filament\App\Resources\Social\SocialPostResource\Pages;

use App\Filament\App\Resources\Social\SocialPostResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSocialPost extends ViewRecord
{
    protected static string $resource = SocialPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
