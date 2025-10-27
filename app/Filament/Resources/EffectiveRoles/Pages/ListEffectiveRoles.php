<?php

namespace App\Filament\Resources\EffectiveRoles\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\EffectiveRoles\EffectiveRoleResource;
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
