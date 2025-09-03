<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Services\FolhaPontoService;
use Illuminate\Http\Request;

class TicketController extends Controller
{
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
    public function avaliar(Request $request, Ticket $ticket, FolhaPontoService $ponto)
    {
        $request->validate([
            'status' => 'required|in:aprovado,rejeitado',
        ]);

        $status = $request->status;

        $ponto->evaluateTicket($ticket, $status);

        return redirect()->route('tickets.index')->with('success', 'Ticket avaliado com sucesso!');
    }
}
