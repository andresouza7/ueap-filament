<?php

namespace App\Filament\App\Pages\Auth;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Support\Htmlable;

class Login extends \Filament\Auth\Pages\Login
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public function getHeading(): string | Htmlable
    {
        return 'Login Intranet';
    }

     public function hasLogo(): bool
    {
        return false;
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('login')
                    ->label('Usuário')
                    ->extraInputAttributes(['tabindex' => 1])
                    ->required()
                    ->autofocus(),
                $this->getPasswordFormComponent(),
                $this->getRememberFormComponent()
            ]);
    }

    protected function getCredentialsFromFormData(array $data): array
    {
        return [
            'login' => $data['login'],
            'password' => $data['password'],
        ];
    }

    protected function throwFailureValidationException(): never
    {
        throw ValidationException::withMessages([
            'data.login' => 'Usuário não encontrado',
        ]);
    }
}
