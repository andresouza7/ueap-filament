<?php

namespace App\Filament\Resources\EffectiveRoleResource\Pages;

use App\Filament\Resources\EffectiveRoleResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateEffectiveRole extends CreateRecord
{
    protected static string $resource = EffectiveRoleResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['uuid'] = Str::uuid();

        return $data;
    }
}
