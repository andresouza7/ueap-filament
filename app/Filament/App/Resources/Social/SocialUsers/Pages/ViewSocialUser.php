<?php

namespace App\Filament\App\Resources\Social\SocialUsers\Pages;

use App\Filament\App\Resources\Social\SocialUsers\SocialUserResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSocialUser extends ViewRecord
{
    protected static string $resource = SocialUserResource::class;

    public function mount(int | string $record): void
    {
        parent::mount($record);

        if (auth()->check()) {
            $service = $this->record->id !== auth()->id() ? 'consulta_servidores' : 'dados_pessoais';

            \App\Events\ServiceAccessed::dispatch(auth()->user(), $service, 'read', "User:{$this->record->login}");
        }
    }
    protected ?string $heading = 'Perfil do Usuário';
    // protected ?string $subheading = 'Informações funcionais e documentos deste usuário.';

    public function hasCombinedRelationManagerTabsWithContent(): bool
    {
        return true;
    }

    public function getContentTabIcon(): ?string
    {
        return 'heroicon-o-user';
    }

    public function getContentTabLabel(): ?string
    {
        return 'Usuário';
    }
}
