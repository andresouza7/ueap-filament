<?php

namespace App\Filament\App\Resources\Social\SocialPostResource\Pages;

use App\Filament\App\Resources\Social\SocialPostResource;
use App\Models\SocialPost;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CreateSocialPost extends CreateRecord
{
    protected static string $resource = SocialPostResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $new_id = SocialPost::latest('id')->first()->id + 1;

        $data['id'] = $new_id;
        $data['uuid'] = Str::uuid();
        $data['user_id'] = Auth::id();
        $data['group_id'] = Auth::user()->group?->id;

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
