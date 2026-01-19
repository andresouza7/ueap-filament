<?php

namespace App\Filament\App\Resources\Social\SocialGroups\Pages;

use App\Filament\App\Resources\Social\SocialGroups\SocialGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSocialGroup extends ViewRecord
{
    protected static string $resource = SocialGroupResource::class;

    public function mount(int | string $record): void
    {
        parent::mount($record);

        \App\Events\ServiceAccessed::dispatch(auth()->user(), 'consulta_setores', 'read', "Group:{$this->record->name}");
    }

    protected ?string $heading = 'Setor';
    // protected ?string $subheading = 'Encontre informações sobre este setor e consulte os servidores nele lotados.';

    // public function hasCombinedRelationManagerTabsWithContent(): bool
    // {
    //     return true;
    // }

    public function getContentTabIcon(): ?string
    {
        return 'heroicon-o-building-office-2';
    }

    public function getContentTabLabel(): ?string
    {
        return 'Setor';
    }
}
