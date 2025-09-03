<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Avaliar Ticket #{{ $ticket->id }}</title>
</head>
<body>
    <h1>Avaliar Ticket #{{ $ticket->id }}</h1>

    <p><strong>Usuário:</strong> {{ $ticket->user->person->name }}</p>
    <p><strong>Status atual:</strong> {{ ucfirst($ticket->status) }}</p>
    <p><strong>Arquivo enviado:</strong>
        <a href="{{ $ticket->file_path }}" target="_blank">Download</a>
    </p>

    <form action="{{ route('tickets.avaliar', $ticket) }}" method="post">
        @csrf
        <label>
            <input type="radio" name="status" value="aprovado" required> Aprovar
        </label><br>
        <label>
            <input type="radio" name="status" value="rejeitado" required> Rejeitar
        </label><br><br>

        <button type="submit">Enviar Avaliação</button>
    </form>

    <p><a href="{{ route('tickets.index') }}">⬅ Voltar para tickets</a></p>
</body>
</html>
