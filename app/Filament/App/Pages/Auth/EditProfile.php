<?php

namespace App\Filament\App\Pages\Auth;

use Filament\Forms\Form;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;
use Filament\Support\Enums\MaxWidth;

class EditProfile extends BaseEditProfile
{

    public static function getSlug(): string
    {
        return 'password';
    }

    public static function getLabel(): string
    {
        return "Redefinir Senha";
    }

    public function getRedirectUrl(): ?string
    {
        return route('filament.app.pages.dashboard');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent()->visible(),
            ]);
    }
}
