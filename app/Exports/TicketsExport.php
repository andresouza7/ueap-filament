<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TicketsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected int $year;
    protected ?string $search;
    protected ?string $category;

    public function __construct(int $year, ?string $search = null, ?string $category = null)
    {
        $this->year = $year;
        $this->search = $search;
        $this->category = $category;
    }

    /**
     * Return collection of users (each user will be mapped to a row in map()).
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::query()
            ->with([
                'person',
                // eager load only tickets of the requested year
                'tickets' => fn($q) => $q->where('year', $this->year),
                'record',
            ])
            // ensure we only include users that have tickets that year
            ->whereHas('tickets', fn($q) => $q->where('year', $this->year))
            ->when($this->search, fn($q) =>
                $q->whereHas('person', fn($p) =>
                    $p->where('name', 'ilike', "%{$this->search}%")
                )
            )
            ->when($this->category, fn($q) =>
                $q->whereHas('record', fn($p) =>
                    $p->where('category', $this->category)
                )
            )
            ->orderBy('login')
            ->get();
    }

    /**
     * Map a single User model to a single row (array).
     *
     * Row format:
     * [ 'Nome', 'jan', 'fev', 'mar', ..., 'dez' ]
     *
     * For each month we return the ticket status (pendente|aprovado|rejeitado) or null if none.
     *
     * @param  \App\Models\User  $user
     * @return array
     */
    public function map($user): array
    {
        // prefer human name if available
        $name = $user->person->name ?? $user->name ?? $user->login ?? "Usuário {$user->id}";

        $tickets = $user->tickets; // collection already filtered to the year

        $row = [$name];

        for ($m = 1; $m <= 12; $m++) {
            $mesFolhas = $tickets->where('month', $m);

            // same priority used in your Blade: pendente -> aprovado -> any
            $folha = $mesFolhas->firstWhere('status', 'pendente')
                ?? $mesFolhas->firstWhere('status', 'aprovado')
                ?? $mesFolhas->first();

            $row[] = $folha ? $folha->status : null;
        }

        return $row;
    }

    /**
     * Headings for the spreadsheet.
     *
     * @return array
     */
    public function headings(): array
    {
        return array_merge(
            ['Nome'],
            ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez']
        );
    }
}
