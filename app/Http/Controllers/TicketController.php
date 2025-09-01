<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Services\GoogleDriveService;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    protected GoogleDriveService $drive;

    public function __construct(GoogleDriveService $drive)
    {
        $this->drive = $drive;
    }

    // Lista todos os tickets
    public function index()
    {
        $tickets = Ticket::with(['user.person', 'evaluador.person'])
                         ->orderBy('created_at', 'desc')
                         ->get();

        return view('tickets.index', compact('tickets'));
    }

    // Mostra detalhes de um ticket específico
    public function show(Ticket $ticket)
    {
        $ticket->load(['user.person', 'evaluador.person']);
        return view('tickets.show', compact('ticket'));
    }

    // Avaliar um ticket
    public function avaliar(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => 'required|in:aprovado,rejeitado',
        ]);

        $ticket->status = $request->status;
        $ticket->evaluador_id = auth()->id();
        $ticket->save();

        // Se aprovado, envia para o Drive
        if ($request->status === 'aprovado') {
            $file = new \Illuminate\Http\File(storage_path("app/public/documents/tickets/{$ticket->id}.pdf"));
            
            $uploaded = $this->drive->uploadAttendanceFile(
                $file,
                $ticket->year, // ou usar ano do ticket se tiver
                $ticket->month,
                $ticket->user
            );

            $ticket->file_path = $uploaded->webViewLink; // opcional: salvar link
            $ticket->save();
        }

        return redirect()->route('tickets.index')->with('success', 'Ticket avaliado com sucesso!');
    }
}
