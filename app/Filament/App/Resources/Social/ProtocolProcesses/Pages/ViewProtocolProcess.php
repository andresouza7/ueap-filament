<?php

namespace App\Filament\App\Resources\Social\ProtocolProcesses\Pages;

use App\Filament\App\Resources\Social\ProtocolProcesses\ProtocolProcessResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewProtocolProcess extends ViewRecord
{
    protected static string $resource = ProtocolProcessResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\EditAction::make(),
        ];
    }

    public function mount(int | string $record): void
    {
        parent::mount($record);
        \App\Events\ServiceAccessed::dispatch(auth()->user(), 'consulta_protocolo', 'read', "ProtocolProcess:{$this->record->id}");
    }
}
