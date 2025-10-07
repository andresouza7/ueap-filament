<?php

namespace App\Filament\Resources\CommissionedRoleResource\Pages;

use App\Filament\Resources\CommissionedRoleResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateCommissionedRole extends CreateRecord
{
    protected static string $resource = CommissionedRoleResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['uuid'] = Str::uuid();

        return $data;
    }
}
