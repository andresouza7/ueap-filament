<?php

namespace App\Filament\App\Resources\Transparencia\Orcamentos\Pages;

use App\Filament\App\Resources\Transparencia\Orcamentos\OrcamentoResource;
use Filament\Resources\Pages\CreateRecord;

class CreateOrcamento extends CreateRecord
{
    protected static string $resource = OrcamentoResource::class;

    protected function afterCreate(): void
    {
        \App\Events\ServiceAccessed::dispatch(auth()->user(), 'publicacao_transparencia', 'create', class_basename($this->record) . ":{$this->record->id}");
    }
}
