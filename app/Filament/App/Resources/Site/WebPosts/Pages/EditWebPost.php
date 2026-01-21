<?php

namespace App\Filament\App\Resources\Site\WebPosts\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\App\Resources\Site\WebPosts\WebPostResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditWebPost extends EditRecord
{
    protected static string $resource = WebPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['user_updated_id'] = Auth::id();

        return $data;
    }

    protected function afterSave(): void
    {
        \App\Events\ServiceAccessed::dispatch(auth()->user(), 'publicacao_site', 'update', class_basename($this->record) . ":{$this->record->id}");
    }
}
