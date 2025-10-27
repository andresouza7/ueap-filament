<?php

namespace App\Filament\Resources\EffectiveRoleResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use App\Filament\Resources\EffectiveRoleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEffectiveRole extends EditRecord
{
    protected static string $resource = EffectiveRoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
