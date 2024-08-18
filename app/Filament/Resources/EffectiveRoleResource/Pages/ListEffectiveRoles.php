<?php

namespace App\Filament\Resources\EffectiveRoleResource\Pages;

use App\Filament\Resources\EffectiveRoleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEffectiveRoles extends ListRecords
{
    protected static string $resource = EffectiveRoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
