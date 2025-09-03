<?php

namespace App\Services;

use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

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
        $expectedMonths = array_slice($this->months, 0, $currentMonth - 1, true);

        // Meses já entregues e aprovados
        $deliveredMonths = Ticket::where('user_id', $user->id)
            ->where('year', $currentYear)
            ->where('status', 'aprovado')
            ->pluck('month')
            ->map(fn($m) => mb_strtolower($m))
            ->toArray();

        // Filtra os que faltam
        $pendingMonths = [];
        foreach ($expectedMonths as $num => $monthName) {
            if (!in_array($monthName, $deliveredMonths)) {
                $pendingMonths[] = $monthName;
            }
        }

        return $pendingMonths;
    }

    /**
     * Retorna true se um mês específico está pendente.
     */
    public function isMonthPending(User $user, string $monthName): bool
    {
        $currentYear = Carbon::now()->year;

        return !Ticket::where('user_id', $user->id)
            ->where('year', $currentYear)
            ->where('month', mb_strtolower($monthName))
            ->where('status', 'aprovado')
            ->exists();
    }

    public function submitSheet(User $user, int $year, string $month, $file): Ticket
    {
        // Verifica se já existe ticket aprovado
        $exists = Ticket::where('user_id', $user->id)
            ->where('year', $year)
            ->where('month', $month)
            ->where('status', 'aprovado')
            ->exists();

        if ($exists) {
            throw new \Exception("Ticket para {$month}/{$year} já foi aprovado e não pode ser reenviado.");
        }

        // Faz o upload do arquivo temporário pro drive
        $tempFolder = $this->drive->getOrCreateFolder('temp', env('GOOGLE_DRIVE_FOLDER_ID'));

        $uploadedFile = $this->drive->upload($file, $tempFolder);

        // Cria ticket com status pendente
        $ticket = Ticket::create([
            'user_id' => $user->id,
            'year' => $year,
            'month' => $month,
            'file_id' => $uploadedFile->id,
            'file_path' => $uploadedFile->webViewLink,
            'status' => 'pendente',
            'evaluador_id' => null,
        ]);

        return $ticket;
    }

    public function evaluateTicket(Ticket $ticket, string $status): Ticket
    {
        // Atualiza status e avaliador
        $ticket->status = $status;
        $ticket->evaluador_id = Auth::id();
        $ticket->evaluated_at = Date::now();
        $ticket->save();

        // Se aprovado, move o arquivo no Google Drive para a pasta correta
        if ($status === 'aprovado') {
            // Pega o link do arquivo 
            $fileId = $ticket->file_id;
            $fileWebViewLink = $ticket->file_path;

            if (!$fileWebViewLink) {
                throw new \Exception("Arquivo do ticket não encontrado no Drive.");
            }

            // 1️⃣ Cria ou obtém a pasta do ano
            $yearFolderId = $this->drive->getOrCreateFolder($ticket->year, env('GOOGLE_DRIVE_FOLDER_ID'));

            // 2️⃣ Cria ou obtém a pasta do usuário dentro do ano
            $userFolderId = $this->drive->getOrCreateFolder($ticket->user->person->name, $yearFolderId);

            $this->drive->moveFileById($fileId, $userFolderId, $ticket->month);
        }

        return $ticket;
    }
}
