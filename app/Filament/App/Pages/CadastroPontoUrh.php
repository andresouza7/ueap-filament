<?php

namespace App\Filament\App\Pages;

use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Schemas\Components\View;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;

class CadastroPontoUrh extends Page implements HasForms, HasSchemas
{
    use InteractsWithForms;

    protected string $view = 'filament.app.pages.cadastro-ponto-urh';

    public array $formData = [];

    public ?int $userId;

    public function mount(): void
    {
        $this->form->fill([]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('formData')
            ->schema([
                Select::make('user_id')
                    ->label('Selecione o Servidor')
                    ->live()
                    ->required()
                    ->options(
                        fn() => User::with('person')
                            ->get()
                            ->sortBy(fn($u) => $u->person->name ?? '')
                            ->mapWithKeys(fn($u) => [
                                $u->id => $u->person->name ?? '(sem nome)',
                            ])
                    )
                    ->searchable()
                    ->preload()
                    ->afterStateUpdated(function($state) {
                        $this->userId = $state;
                    }),

            ]);
    }
}
