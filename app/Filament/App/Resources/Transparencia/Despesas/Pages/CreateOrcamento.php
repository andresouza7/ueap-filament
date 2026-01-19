<?php

namespace App\Filament\App\Resources\Transparencia\Despesas\Pages;

use App\Filament\App\Resources\Transparencia\Despesas\DespesaResource;
use Filament\Resources\Pages\CreateRecord;

class CreateOrcamento extends CreateRecord
{
    protected static string $resource = DespesaResource::class;

    protected function afterCreate(): void
    {
        \App\Events\ServiceAccessed::dispatch(auth()->user(), 'publicacao_transparencia', 'create', class_basename($this->record) . ":{$this->record->id}");
    }
}
