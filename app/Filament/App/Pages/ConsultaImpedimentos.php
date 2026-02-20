<?php

namespace App\Filament\App\Pages;

use App\Models\User;
use App\Models\Portaria;
use Filament\Actions\Action;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ConsultaImpedimentos extends Page implements HasForms, HasTable
{
    use InteractsWithForms, InteractsWithTable;

    protected string $view = 'filament.app.pages.consulta-impedimentos';
    protected static string | \UnitEnum | null $navigationGroup = 'Gestão';
    protected static string | \BackedEnum | null $navigationIcon = Heroicon::OutlinedNoSymbol;
    protected static ?int $navigationSort = 10;

    public static function canAccess(): bool
    {
        return Auth::user()->hasAnyRole(['dinfo', 'urh', 'gab', 'auditoria']);
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading('Impedimentos cadastrados')
            ->description('Visualize e pesquise por todos os impedimentos registrados em portarias. Filtre pela portaria ou nome do servidor.')
            ->query(
                Portaria::query()
                    ->selectRaw("
                        document_ordinances.id,
                        document_ordinances.number,
                        document_ordinances.year,
                        document_ordinances.description as portaria_description,
                        elem->>'type'        AS type,
                        elem->>'start_date'  AS start_date,
                        elem->>'end_date'    AS end_date,
                        elem->>'description' AS description,
                        elem->'user_id'      AS user_ids
                    ")
                    ->fromRaw("
                        document_ordinances,
                        jsonb_array_elements(document_ordinances.impediments) AS elem
                    ")
                    ->whereNotNull('document_ordinances.description')
                    ->whereRaw("jsonb_array_length(document_ordinances.impediments) > 0")
            )
            ->defaultSort('year', 'desc')
            ->columns([
                TextColumn::make('number')
                    ->label('Portaria')
                    ->formatStateUsing(fn($record) => "{$record->number}/{$record->year}")
                    ->description(fn($record) => $record->portaria_description)
                    ->sortable()
                    ->searchable(['number', 'year', 'description']),

                TextColumn::make('type')
                    ->label('Tipo')
                    ->badge()
                    ->formatStateUsing(fn($state) => ucfirst($state))
                    ->color('info'),

                TextColumn::make('start_date')
                    ->label('Início')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('end_date')
                    ->label('Fim')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('description')
                    ->label('Descrição')
                    ->wrap(),

                TextColumn::make('user_ids')
                    ->label('Usuários')
                    ->html()
                    ->extraAttributes(['class' => 'text-xs text-gray-500'])
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->whereExists(function ($subquery) use ($search) {
                            $subquery->select(DB::raw(1))
                                ->from('users')
                                ->join('persons', 'users.person_id', '=', 'persons.id')
                                ->whereRaw("elem->'user_id' @> jsonb_build_array(users.id)")
                                ->where('persons.name', 'ilike', "%{$search}%");
                        });
                    })
                    ->formatStateUsing(function ($record) {
                        $rawUserIds = $record->user_ids;
                        if (!$rawUserIds) return '-';

                        $userIds = is_string($rawUserIds) ? json_decode($rawUserIds, true) : $rawUserIds;
                        if (empty($userIds)) return '-';

                        return User::query()
                            ->whereIn('id', (array) $userIds)
                            ->with('person')
                            ->get()
                            ->map(fn($u) => $u->person?->name ?? $u->login)
                            ->join('<br>');
                    })
            ])
            ->filters([
                SelectFilter::make('user_id')
                    ->label('Filtrar por Usuário')
                    ->searchable()
                    ->preload()
                    ->options(
                        User::query()
                            ->with('person')
                            ->orderBy('login')
                            ->get()
                            ->mapWithKeys(fn($user) => [
                                $user->id => ($user->person?->name ?? $user->login)
                            ])
                    )
                    ->query(function (Builder $query, array $data) {
                        if ($data['value']) {
                            $query->whereRaw("elem->'user_id' @> ?", [json_encode([(int) $data['value']])]);
                        }
                    })
            ])
            ->recordActions([
                Action::make('open_pdf')
                    ->label('Ver Portaria')
                    ->icon('heroicon-o-document-magnifying-glass')
                    ->url(fn($record) => Storage::url("documents/ordinances/{$record->id}.pdf"))
                    ->openUrlInNewTab(),
            ])
            ->emptyStateHeading('Nenhum impedimento encontrado')
            ->emptyStateDescription('Não há impedimentos registrados que correspondam aos critérios.');
    }
}
