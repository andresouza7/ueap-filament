<?php

namespace App\Filament\Resources\CommissionedRoleResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use App\Filament\Resources\CommissionedRoleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCommissionedRole extends EditRecord
{
    protected static string $resource = CommissionedRoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
