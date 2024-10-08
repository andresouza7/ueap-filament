<?php

namespace App\Filament\App\Resources\SocialPostResource\Pages;

use App\Filament\App\Resources\SocialPostResource;
use Closure;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSocialPosts extends ListRecords
{
    protected static string $resource = SocialPostResource::class;

    protected static ?string $title = 'Minhas Postagens';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
