<?php

namespace App\Filament\App\Resources\Site\WebPages\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\App\Resources\Site\WebPages\WebPageResource;
use App\Models\WebMenuItem;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class EditWebPage extends EditRecord
{
    protected static string $resource = WebPageResource::class;

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

    protected function handleRecordUpdate(Model $record, array $data): Model
    {

        // se tiver um menu na pagina, atualiza ou cria um item de menu com a url para esta pagina
        if ($data['web_menu_id']) {
            $lastMenuItem = WebMenuItem::latest('id')->first();
            $menuItem = WebMenuItem::firstOrCreate([
                'url' => 'pagina/' . $record->slug,
            ], [
                'uuid' => Str::uuid(),
                'web_menu_id' => $data['web_menu_id'],
                'name' => $record->title,
                'description' => null,
                'position' => $lastMenuItem ? $lastMenuItem->id + 1 : 1,
                'status' => 'published'
            ]);
        }
        $record->update($data);

        return $record;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('edit', ['record' => $this->record->id]);
    }

    protected function afterSave(): void
    {
        \App\Events\ServiceAccessed::dispatch(auth()->user(), 'publicacao_site', 'update', class_basename($this->record) . ":{$this->record->id}");
    }
}
