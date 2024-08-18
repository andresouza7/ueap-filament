<?php

namespace App\Filament\Resources\CommissionedRoleResource\Pages;

use App\Filament\Resources\CommissionedRoleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCommissionedRole extends EditRecord
{
    protected static string $resource = CommissionedRoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
