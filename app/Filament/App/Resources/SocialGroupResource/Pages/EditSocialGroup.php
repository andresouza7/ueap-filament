<?php

namespace App\Filament\App\Resources\SocialGroupResource\Pages;

use App\Filament\App\Resources\SocialGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSocialGroup extends EditRecord
{
    protected static string $resource = SocialGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
