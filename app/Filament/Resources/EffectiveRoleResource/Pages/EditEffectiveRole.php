<?php

namespace App\Filament\Resources\EffectiveRoleResource\Pages;

use App\Filament\Resources\EffectiveRoleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEffectiveRole extends EditRecord
{
    protected static string $resource = EffectiveRoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
