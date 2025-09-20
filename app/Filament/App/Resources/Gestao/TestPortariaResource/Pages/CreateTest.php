<?php

namespace App\Filament\App\Resources\Gestao\TestPortariaResource\Pages;

use App\Filament\App\Resources\Gestao\TestPortariaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTest extends CreateRecord
{
    protected static string $resource = TestPortariaResource::class;

    protected function mutateFormDataBeforeCreate(array $state): array {
        $state['type'] = 'portaria';

        return $state;
    }
}
