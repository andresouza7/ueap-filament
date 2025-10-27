<?php

namespace App\Filament\App\Resources\Social\SocialPosts\Pages;

use Filament\Actions\EditAction;
use App\Filament\App\Resources\Social\SocialPosts\SocialPostResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSocialPost extends ViewRecord
{
    protected static string $resource = SocialPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
