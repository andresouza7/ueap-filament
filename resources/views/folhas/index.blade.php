<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h2>Arquivos no Google Drive</h2>

    @if (session('success'))
        <div style="background: #d1fae5; color: #065f46; padding: 10px; margin-bottom: 10px; border-radius: 5px;">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div style="background: #fee2e2; color: #991b1b; padding: 10px; margin-bottom: 10px; border-radius: 5px;">
            {{ session('error') }}
        </div>
    @endif


    <ul>
        @forelse ($folhas as $file)
            <li>
                {{ $file->name }}
                - {{$file->id}}
                - <a href="{{ $file->webViewLink }}" target="_blank">Abrir</a>
                - <a href="{{ $file->webContentLink }}">Baixar</a>

                <form action="{{ route('folhas.destroy', $file->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Tem certeza que deseja excluir este arquivo?')">
                        Excluir
                    </button>
                </form>
            </li>
        @empty
            <li>Nenhum arquivo encontrado.</li>
        @endforelse
    </ul>

</body>

</html>
