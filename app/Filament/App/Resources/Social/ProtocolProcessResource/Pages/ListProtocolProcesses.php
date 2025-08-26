<?php

namespace App\Filament\App\Resources\Social\ProtocolProcessResource\Pages;

use App\Filament\App\Resources\Social\ProtocolProcessResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProtocolProcesses extends ListRecords
{
    protected static string $resource = ProtocolProcessResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
