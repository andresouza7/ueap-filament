<?php

namespace App\Filament\Resources\SocialCommissionedResource\Pages;

use App\Filament\Resources\SocialCommissionedResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSocialCommissioned extends EditRecord
{
    protected static string $resource = SocialCommissionedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
