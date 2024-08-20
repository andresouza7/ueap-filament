<?php

namespace App\Filament\App\Resources\SocialUserResource\Pages;

use App\Filament\App\Resources\SocialUserResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSocialUser extends ViewRecord
{
    protected static string $resource = SocialUserResource::class;

    public function hasCombinedRelationManagerTabsWithContent(): bool
    {
        return true;
    }

    public function getContentTabIcon(): ?string
    {
        return 'heroicon-m-eye';
    }
}
