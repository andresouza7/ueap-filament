<?php

namespace App\Filament\App\Resources\Social\SocialGroupResource\Pages;

use App\Filament\App\Resources\Social\SocialGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSocialGroup extends ViewRecord
{
    protected static string $resource = SocialGroupResource::class;

    protected ?string $heading = 'Setor';
    // protected ?string $subheading = 'Encontre informações sobre este setor e consulte os servidores nele lotados.';

    public function hasCombinedRelationManagerTabsWithContent(): bool
    {
        return true;
    }

    public function getContentTabIcon(): ?string
    {
        return 'heroicon-o-building-office-2';
    }

    public function getContentTabLabel(): ?string
    {
        return 'Setor';
    }
}
