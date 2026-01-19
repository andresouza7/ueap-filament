<?php

namespace App\Filament\App\Resources\Gestao\Users\Pages;

use Filament\Actions\EditAction;
use App\Filament\App\Resources\Gestao\Users\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;

    public function mount(int | string $record): void
    {
        parent::mount($record);

        if ($this->record->id === auth()->id()) {
            \App\Events\ServiceAccessed::dispatch(auth()->user(), 'dados_pessoais', 'read', "User:{$this->record->id}");
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
