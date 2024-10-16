<?php

namespace App\Filament\App\Resources\SocialGroupResource\Pages;

use App\Filament\App\Resources\SocialGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSocialGroup extends ViewRecord
{
    protected static string $resource = SocialGroupResource::class;

    protected ?string $heading = 'Setor';
    protected ?string $subheading = 'Visualize os dados e documentos relacionados a este setor e consulte os servidores aqui lotados.';

    public function hasCombinedRelationManagerTabsWithContent(): bool
    {
        return true;
    }

    public function getContentTabIcon(): ?string
    {
        return 'heroicon-o-user';
    }
}
