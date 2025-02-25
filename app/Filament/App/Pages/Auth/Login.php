<?php

namespace App\Filament\App\Pages\Auth;

use Filament\Forms\Components\TextInput;
use Filament\Pages\Auth\Login as BaseLogin;
use Illuminate\Support\Facades\Auth;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Illuminate\Validation\ValidationException;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Forms\Form;
use Illuminate\Contracts\Support\Htmlable;

class Login extends BaseLogin
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public function getHeading(): string | Htmlable
    {
        return 'Login Intranet';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('login')
                    ->label('Usuário')
                    ->extraInputAttributes(['tabindex' => 1])
                    ->required()
                    ->autofocus(),
                $this->getPasswordFormComponent(),
                $this->getRememberFormComponent()
            ]);
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
