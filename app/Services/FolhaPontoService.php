<?php

namespace App\Services;

use App\Models\Ticket;
use App\Models\User;
use App\Notifications\TicketEvaluatedNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class FolhaPontoService
{
    public function __construct(
        protected GoogleDriveService $drive
    ) {}

    protected array $months = [
        1 => 'janeiro',
        2 => 'fevereiro',
        3 => 'março',
        4 => 'abril',
        5 => 'maio',
        6 => 'junho',
        7 => 'julho',
        8 => 'agosto',
        9 => 'setembro',
        10 => 'outubro',
        11 => 'novembro',
        12 => 'dezembro',
    ];

    # ============================================================================
    #  HELPERS
    # ============================================================================

    protected function getApprovedMonths(User $user, int $year): array
    {
        return Ticket::where('user_id', $user->id)
            ->where('year', $year)
            ->where('status', 'aprovado')
            ->pluck('month')
            ->map(fn($m) => (int) $m)
            ->toArray();
    }

    protected function ensureMonthNotApproved(User $user, int $year, int $month): void
    {
        $exists = Ticket::where('user_id', $user->id)
            ->where('year', $year)
            ->where('month', $month)
            ->whereIn('status', ['aprovado', 'pendente'])
            ->exists();

        if ($exists) {
            throw new \Exception(
                "Ponto de {$this->months[$month]}/{$year} já encaminhado e não pode ser reenviado no momento."
            );
        }
    }

    protected function moveTicketFileToFinalFolder(Ticket $ticket): void
    {
        $yearFolder = $this->drive->getOrCreateFolder($ticket->year, env('GOOGLE_DRIVE_FOLDER_ID'));

        $folderName = $ticket->user->person->name;

        if ($ticket->user->person->users()->count() > 1) {
            $folderName .= ' - ' . explode(' ', trim($ticket->user->effective_role->description))[0];
        }

        $userFolder = $this->drive->getOrCreateFolder($folderName, $yearFolder);

        $this->drive->moveFileById(
            fileId: $ticket->file_id,
            destinationFolderId: $userFolder,
            name: $ticket->user->login . ' - ' . $this->months[$ticket->month]
        );
    }

    protected function moveTicketFileToRejectedFolder(Ticket $ticket): void
    {
        $rejeitadosFolder = $this->drive->getOrCreateFolder('rejeitados', env('GOOGLE_DRIVE_FOLDER_ID'));

        $this->drive->moveFileById(
            fileId: $ticket->file_id,
            destinationFolderId: $rejeitadosFolder,
            name: $ticket->user->login . ' - ' . $this->months[$ticket->month]
        );
    }

    protected function updateTicketEvaluation(Ticket $ticket, string $status, $notes): Ticket
    {
        $ticket->update([
            'status'          => $status,
            'evaluator_notes' => $notes,
            'evaluator_id'    => Auth::id(),
            'evaluated_at'    => Date::now(),
        ]);

        return $ticket;
    }

    # ============================================================================
    #  CONSULTAS
    # ============================================================================

    public function getUsersWithTickets(int $year, ?string $search = null, ?string $category = null)
    {
        return User::query()
            ->with([
                'person',
                'tickets' => fn($q) => $q->where('year', $year),
                'record'
            ])
            ->when(
                $search,
                fn($q) =>
                $q->whereHas(
                    'person',
                    fn($p) =>
                    $p->where('name', 'ilike', "%{$search}%")
                )
            )
            ->when(
                $category,
                fn($q) =>
                $q->whereHas(
                    'record',
                    fn($p) =>
                    $p->where('category', $category)
                )
            )
            ->orderBy('login');
    }

    public function hasPendingSheets(User $user): bool
    {
        return !empty($this->getPendingSheets($user));
    }

    public function getPendingSheets(User $user): array
    {
        $now = Carbon::now();
        $year = $now->year;

        $approved = $this->getApprovedMonths($user, $year);

        $expected = array_slice($this->months, 0, $now->month - 1, true);

        return array_values(array_diff($expected, array_intersect_key($this->months, array_flip($approved))));
    }

    public function isMonthPending(User $user, int $month): bool
    {
        return !$this->getApprovedMonths($user, Carbon::now()->year,) ? null :
            !in_array($month, $this->getApprovedMonths($user, Carbon::now()->year));
    }

    # ============================================================================
    #  SUBMIT + APPROVE
    # ============================================================================

    public function submitSheet(User $user, int $year, int $month, $notes, $file): Ticket
    {
        $this->ensureMonthNotApproved($user, $year, $month);

        // Upload provisional
        $tempFolder = $this->drive->getOrCreateFolder('novos', env('GOOGLE_DRIVE_FOLDER_ID'));
        $uploaded = $this->drive->upload($file, $tempFolder);

        if ($uploaded) {
            // Compartilha arquivo com o próprio usuário que enviou
            $this->drive->shareFileWithEmail($uploaded, Auth::user()->email);
        }

        return Ticket::create([
            'user_id'      => $user->id,
            'year'         => $year,
            'month'        => $month,
            'file_id'      => $uploaded->id,
            'file_path'    => $uploaded->webViewLink,
            'status'       => 'pendente',
            'user_notes'   => $notes,
        ]);
    }

    public function manualInsertSheet(User $user, int $year, int $month, $notes, $file)
    {
        $ticket = $this->submitSheet($user, $year, $month, $notes, $file);

        $this->moveTicketFileToFinalFolder($ticket);
        $this->updateTicketEvaluation($ticket, 'aprovado', $notes);
    }

    public function evaluateTicket(Ticket $ticket, string $status, $notes): Ticket
    {
        if ($status === 'aprovado') {
            $this->moveTicketFileToFinalFolder($ticket);
        } elseif ($status === 'rejeitado') {
            $this->moveTicketFileToRejectedFolder($ticket);
        }

        $ticket = $this->updateTicketEvaluation($ticket, $status, $notes);

        try {
            $ticket->user->notify(new TicketEvaluatedNotification($ticket));
        } catch (\Throwable) {
        }

        return $ticket;
    }
}
