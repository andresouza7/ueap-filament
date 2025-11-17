<?php

namespace App\Services;

use App\Models\Ticket;
use App\Models\User;
use App\Notifications\TicketEvaluatedNotification;
use Carbon\Carbon;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Log;

class FolhaPontoService
{
    protected GoogleDriveService $drive;

    public function __construct(GoogleDriveService $drive)
    {
        $this->drive = $drive;
    }

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

    public function getUsersWithTickets(int $year, ?string $search = null, ?string $category = null)
    {
        $query = User::query()
            ->with(['person', 'tickets' => fn($q) => $q->where('year', $year), 'record'])
            ->orderBy('login');

        if ($search) {
            $query->whereHas('person', fn($q) => $q->where('name', 'ilike', "%{$search}%"));
        }

        if ($category) {
            $query->whereHas('record', fn($q) => $q->where('category', $category));
        }

        return $query;
    }

    /**
     * Verifica se o usuário tem folhas pendentes no ano atual.
     */
    public function hasPendingSheets(User $user): bool
    {
        return count($this->getPendingSheets($user)) > 0;
    }

    /**
     * Retorna os meses que estão pendentes para o usuário no ano atual.
     */
    public function getPendingSheets(User $user): array
    {
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        // Meses que deveriam estar entregues (até o mês anterior ao atual)
        $expectedMonths = array_keys(array_slice($this->months, 0, $currentMonth - 1, true));

        // Meses já entregues e aprovados
        $deliveredMonths = Ticket::where('user_id', $user->id)
            ->where('year', $currentYear)
            ->where('status', 'aprovado')
            ->pluck('month')
            ->map(fn($m) => (int) $m)
            ->toArray();

        // Filtra os que faltam
        $pendingMonths = [];
        foreach ($expectedMonths as $num) {
            if (!in_array($num, $deliveredMonths)) {
                $pendingMonths[] = $this->months[$num];
            }
        }

        return $pendingMonths;
    }

    /**
     * Retorna true se um mês específico está pendente.
     */
    public function isMonthPending(User $user, int $month): bool
    {
        $currentYear = Carbon::now()->year;

        return !Ticket::where('user_id', $user->id)
            ->where('year', $currentYear)
            ->where('month', $month)
            ->where('status', 'aprovado')
            ->exists();
    }

    public function submitSheet(User $user, int $year, int $month, $notes, $file): Ticket
    {
        // Verifica se já existe ticket aprovado
        $exists = Ticket::where('user_id', $user->id)
            ->where('year', $year)
            ->where('month', $month)
            ->where('status', 'aprovado')
            ->exists();

        if ($exists) {
            throw new \Exception("Ticket para {$this->months[$month]}/{$year} já foi aprovado e não pode ser reenviado.");
        }

        // Faz o upload do arquivo temporário pro drive
        $tempFolder = $this->drive->getOrCreateFolder('temp', env('GOOGLE_DRIVE_FOLDER_ID'));
        $uploadedFile = $this->drive->upload($file, $tempFolder);

        // Cria ticket com status pendente
        $ticket = Ticket::create([
            'user_id'     => $user->id,
            'year'        => $year,
            'month'       => $month, // <-- agora número inteiro
            'file_id'     => $uploadedFile->id,
            'file_path'   => $uploadedFile->webViewLink,
            'status'      => 'pendente',
            'evaluador_id' => null,
            'user_notes' => $notes
        ]);

        return $ticket;
    }

    public function evaluateTicket(Ticket $ticket, string $status, $notes): Ticket
    {
        // Se aprovado, move o arquivo no Google Drive para a pasta correta
        if ($status === 'aprovado') {
            $fileId = $ticket->file_id;

            try {
                // 1️⃣ Cria ou obtém a pasta do ano
                $yearFolderId = $this->drive->getOrCreateFolder($ticket->year, env('GOOGLE_DRIVE_FOLDER_ID'));

                // 2️⃣ Cria ou obtém a pasta do usuário dentro do ano
                $userFolderId = $this->drive->getOrCreateFolder($ticket->user->person->name, $yearFolderId);

                // Usa número do mês, mas passa também nome amigável se quiser no Drive
                $this->drive->moveFileById($fileId, $userFolderId, $this->months[$ticket->month]);
            } catch (\Throwable $th) {
                throw $th;
            }
        }

        // Atualiza status e avaliador
        $ticket->status = $status;
        $ticket->evaluator_notes = $notes;
        $ticket->evaluador_id = Auth::id();
        $ticket->evaluated_at = Date::now();
        $ticket->save();

        try {
            $ticket->user->notify(new TicketEvaluatedNotification($ticket));
        } catch (\Throwable $th) {
            Log::warning("Falha ao notificar usuário {$ticket->user_id} sobre avaliação do ticket {$ticket->id}: " . $th->getMessage());
        }

        return $ticket;
    }
}