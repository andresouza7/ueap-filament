<?php

namespace App\Filament\App\Pages;

use App\Exports\TicketsExport;
use App\Services\FolhaPontoService;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Pagination\LengthAwarePaginator;
use Maatwebsite\Excel\Facades\Excel;
use UnitEnum;

class ControlePonto extends Page implements HasForms, HasSchemas
{
    use InteractsWithForms;

    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-document-text';

    protected string $view = 'filament.app.pages.controle-ponto';
    protected static ?string $title = 'Planilha de Pontos';
    protected static UnitEnum|string|null $navigationGroup = 'Gestão';
    protected static ?int $navigationSort = 9;
    protected static bool $shouldRegisterNavigation = false;

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

    public function getHeaderActions(): array
    {
        return [
            Action::make('export')
                ->label('Exportar Planilha')
                ->action(fn() => Excel::download(new TicketsExport(2025), 'servidores-2025.xlsx'))
        ];
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
                        ->live(),

                    TextInput::make('search')
                        ->label('Servidor')
                        ->placeholder('Pesquisar pelo nome...')
                        ->live(),

                    Select::make('category')
                        ->label('Categoria')
                        ->options([
                            'técnico' => 'Técnico',
                            'docente' => 'Docente',
                            'cedido'  => 'Cedido',
                        ])
                        ->placeholder('Todos')
                        ->live(),
                ]),
            ])
            ->statePath('');
    }

    // injeta uma prop chamada servidores na pagina
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

        return new LengthAwarePaginator(
            $result,
            $users->total(),
            $users->perPage(),
            $users->currentPage(),
            ['path' => request()->url(), 'query' => request()->query()]
        );
    }
}
