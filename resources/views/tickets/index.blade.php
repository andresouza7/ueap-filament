<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Tickets de Folha de Ponto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            color: #333;
        }

        .info-box {
            background-color: #f0f8ff;
            border-left: 4px solid #007bff;
            padding: 10px 15px;
            margin-bottom: 20px;
            color: #333;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        table th,
        table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #f5f5f5;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .success-message {
            color: green;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <h1>Tickets de Folha de Ponto</h1>

    <div class="info-box">
        Esta página é destinada ao **funcionário responsável pelo setor de RH** para o gerenciamento dos envios de folhas de ponto. 
        Aqui você pode visualizar todos os tickets pendentes, aprovados ou rejeitados, baixar os arquivos enviados pelos funcionários
        e realizar a avaliação de cada envio.
    </div>

    @if (session('success'))
        <p class="success-message">{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuário</th>
                <th>Mês</th>
                <th>Ano</th>
                <th>Status</th>
                <th>Enviado em</th>
                <th>Arquivo</th>
                <th>Avaliador</th>
                <th>Avaliado em</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->id }}</td>
                    <td>{{ $ticket->user->person->name }}</td>
                    <td>{{ ucfirst($ticket->month) }}</td>
                    <td>{{ $ticket->year }}</td>
                    <td>{{ ucfirst($ticket->status) }}</td>
                    <td>{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        @if ($ticket->status === 'aprovado' && str_contains($ticket->file_path, 'http'))
                            <a href="{{ $ticket->file_path }}" target="_blank">Abrir no Drive</a>
                        @else
                            <a href="{{ asset('storage/documents/tickets/' . $ticket->id . '.pdf') }}" target="_blank">Download</a>
                        @endif
                    </td>
                    <td>{{ $ticket->evaluador ? $ticket->evaluador->person->name : '-' }}</td>
                    <td>{{ $ticket->evaluated_at?->format('d/m/Y H:i') ?? '-' }}</td>
                    <td>
                        @if ($ticket->status === 'pendente')
                            <a href="{{ route('tickets.show', $ticket) }}">Avaliar</a>
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
