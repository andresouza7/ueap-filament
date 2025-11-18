<?php

namespace App\Filament\App\Pages;

use App\Models\Ticket;
use App\Services\FolhaPontoService;
use BackedEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Pagination\LengthAwarePaginator;
use UnitEnum;

class ControlePonto extends Page implements HasForms, HasSchemas
{
    use InteractsWithForms;

    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-document-text';

    protected string $view = 'filament.app.pages.controle-ponto';
    protected static ?string $title = 'Controle de Frequência';
    protected static UnitEnum|string|null $navigationGroup = 'Gestão';
    protected static ?int $navigationSort = 9;

    public $year;
    public $search;
    public $category;
    public $month;
    public $status;

    public function mount(): void
    {
        $this->form->fill([
            'year' => now()->year,
            'search' => '',
            'category' => null,
            'month' => null,
            'status' => null,
        ]);
    }

    public function form(Schema $form): Schema
    {
        return $form
            ->schema([
                Grid::make(3)->schema([
                    Select::make('year')
                        ->label('Ano')
                        ->options(
                            collect(range(now()->year, now()->year - 5))->mapWithKeys(fn($y) => [$y => $y])
                        )
                        ->default(now()->year)
                        ->reactive(),

                    TextInput::make('search')
                        ->label('Servidor')
                        ->placeholder('Pesquisar pelo nome...')
                        ->reactive(),

                    Select::make('category')
                        ->label('Categoria')
                        ->options([
                            'técnico' => 'Técnico',
                            'docente' => 'Docente',
                            'cedido'  => 'Cedido',
                        ])
                        ->placeholder('Todos')
                        ->reactive(),

                    // Select::make('month')
                    //     ->label('Mês')
                    //     ->options([
                    //         1 => 'Janeiro',
                    //         2 => 'Fevereiro',
                    //         3 => 'Março',
                    //         4 => 'Abril',
                    //         5 => 'Maio',
                    //         6 => 'Junho',
                    //         7 => 'Julho',
                    //         8 => 'Agosto',
                    //         9 => 'Setembro',
                    //         10 => 'Outubro',
                    //         11 => 'Novembro',
                    //         12 => 'Dezembro',
                    //     ])
                    //     ->placeholder('Todos')
                    //     ->reactive(),

                    // Select::make('status')
                    //     ->label('Status da folha')
                    //     ->options([
                    //         'aprovado' => 'Aprovado',
                    //         'pendente' => 'Pendente',
                    //         'rejeitado' => 'Rejeitado',
                    //     ])
                    //     ->placeholder('Todos')
                    //     ->reactive(),
                ]),
            ])
            ->statePath('');
    }

    // public function getServidoresProperty()
    // {
    //     $query = Ticket::query()
    //         ->with(['user.person'])
    //         ->where('year', $this->year);

    //     if ($this->search) {
    //         $query->whereHas('user.person', function ($q) {
    //             $q->where('name', 'ilike', '%' . $this->search . '%');
    //         });
    //     }

    //     $result = $query->get()
    //         ->groupBy(fn($folha) => $folha->user->person->name)
    //         ->sortKeys();

    //     return $result;
    // }

    public function getServidoresProperty(FolhaPontoService $service)
    {
        $perPage = 15;

        // pega a query pronta do serviço
        $query = $service->getUsersWithTickets($this->year, $this->search, $this->category);

        // paginação
        $users = $query->paginate($perPage);

        // agrupa tickets por usuário
        $result = $users->getCollection()->mapWithKeys(function ($user) {
            $name = $user->person->name ?? 'Sem Nome';
            return [$name => $user->tickets];
        });

        return new \Illuminate\Pagination\LengthAwarePaginator(
            $result,
            $users->total(),
            $users->perPage(),
            $users->currentPage(),
            ['path' => request()->url(), 'query' => request()->query()]
        );
    }
}