<?php

namespace App\Filament\App\Resources\Social\SocialPostResource\Pages;

use Filament\Actions\CreateAction;
use App\Filament\App\Resources\Social\SocialPostResource;
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
            CreateAction::make(),
        ];
    }
}
