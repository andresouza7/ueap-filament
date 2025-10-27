<?php

namespace App\Filament\Resources\EffectiveRoleResource\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\EffectiveRoleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEffectiveRoles extends ListRecords
{
    protected static string $resource = EffectiveRoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
