<?php

namespace App\Filament\App\Pages;

use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ConsultaImpedimentos extends Page implements HasForms
{
    use InteractsWithForms;

    protected string $view = 'filament.app.pages.consulta-impedimentos';
    protected static string | \UnitEnum | null $navigationGroup = 'Gestão';
    protected static string | \BackedEnum | null $navigationIcon = Heroicon::OutlinedNoSymbol;
    protected static ?int $navigationSort = 10;

    public static function canAccess(): bool
    {
        return Auth::user()->hasAnyRole(['dinfo', 'urh', 'gab', 'auditoria']);
    }

    /**
     * Estado do formulário
     */
    public ?array $data = [];

    /**
     * Usuário selecionado
     */
    public ?int $user_id = null;

    /**
     * Resultados da consulta
     */
    public array $rows = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make('Consulta de Impedimentos')
                ->description(
                    'Selecione um usuário para consultar impedimentos vinculados a portarias.
                     Você pode pesquisar pelo nome. Após selecionar, os resultados serão exibidos automaticamente.'
                )
                ->schema([
                    Select::make('user_id')
                        ->label('Usuário')
                        ->searchable()
                        ->preload()
                        ->options(
                            fn() =>
                            User::query()
                                ->with(['person', 'effective_role'])
                                ->orderBy('login')
                                ->get()
                                ->mapWithKeys(fn($user) => [
                                    $user->id => ($user->person?->name ?? $user->login) . ' => ' . $user->effective_role?->description,
                                ])
                        )
                        ->live()
                        ->afterStateUpdated(function ($state) {
                            $this->user_id = $state;

                            if (blank($state)) {
                                $this->rows = [];
                                return;
                            }

                            $this->loadImpediments($state);
                        }),
                ]),
        ];
    }

    /**
     * Consulta os impedimentos do usuário selecionado
     */
    protected function loadImpediments(int $userId): void
    {
        $this->rows = DB::table('document_ordinances')
            ->selectRaw("
                document_ordinances.id,
                document_ordinances.number,
                document_ordinances.year,
                elem->>'type'        AS type,
                elem->>'start_date'  AS start_date,
                elem->>'end_date'    AS end_date,
                elem->>'description' AS description
            ")
            ->fromRaw("
                document_ordinances,
                jsonb_array_elements(document_ordinances.impediments) AS elem
            ")
            ->whereRaw(
                "elem->'user_id' @> ?",
                [json_encode([$userId])]
            )
            ->orderBy('year', 'desc')
            ->orderBy('number', 'desc')
            ->get()
            ->toArray();
    }
}
