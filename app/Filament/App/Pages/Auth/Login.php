<?php

namespace App\Filament\App\Pages\Auth;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Component;
use Filament\Auth\Http\Responses\Contracts\LoginResponse;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
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

    public function getPasswordFormComponent(): Component
    {
        return TextInput::make('password')
            ->label('Senha')
            ->password()
            ->revealable(filament()->arePasswordsRevealable())
            ->required()
            ->extraInputAttributes(['tabindex' => 2]);
    }

    public function authenticate(): ?LoginResponse
    {
        try {
            $this->rateLimit(5);
        } catch (TooManyRequestsException $exception) {
            $this->getRateLimitedNotification($exception)?->send();

            return null;
        }

        $data = $this->form->getState();

        // Ensure the user can access the current Filament panel
        if (!Auth::attempt(['login' => $data['login'], 'password' => $data['password']], $data['remember'] ?? false)) {
            $this->throwFailureValidationException();
        }

        // Regenerate session to prevent session fixation attacks
        session()->regenerate();

        return app(LoginResponse::class);
    }

    protected function throwFailureValidationException(): never
    {
        throw ValidationException::withMessages([
            'data.login' => __('filament-panels::pages/auth/login.messages.failed'),
        ]);
    }
}
