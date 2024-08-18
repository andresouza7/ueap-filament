<?php

namespace App\Filament\Resources\CommissionedRoleResource\Pages;

use App\Filament\Resources\CommissionedRoleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCommissionedRoles extends ListRecords
{
    protected static string $resource = CommissionedRoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
