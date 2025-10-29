<?php

namespace App\Filament\App\Pages\Auth;

use Filament\Panel;
use Filament\Schemas\Schema;
use Filament\Support\Enums\MaxWidth;

class EditProfile extends \Filament\Auth\Pages\EditProfile
{

    public static function getSlug(?Panel $panel = null): string
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

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent()->visible(),
            ]);
    }
}
