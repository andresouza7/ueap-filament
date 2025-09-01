<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Folhas no Drive</title>
</head>
<body>
    <h1>📂 Folhas de Frequência</h1>

    <a href="{{route('folhas.create')}}">+ Enviar folha de ponto</a>

    <h4>Folhas de ponto registradas:</h4>

    {{-- Botão para voltar um nível, se não estiver na raiz --}}
    @if($currentFolderId !== env('GOOGLE_DRIVE_FOLDER_ID'))
        <p><a href="{{ route('folhas.index') }}">⬅️ Voltar para Raiz</a></p>
    @endif

    <ul>
        @foreach($items as $item)
            @if($item->mimeType === 'application/vnd.google-apps.folder')
                {{-- É pasta (ano ou usuário) --}}
                <li>
                    📁 <a href="{{ route('folhas.index', ['folderId' => $item->id]) }}">
                        {{ $item->name }}
                    </a>
                </li>
            @else
                {{-- É arquivo (mês) --}}
                <li>
                    📄 <a href="{{ $item->webViewLink }}" target="_blank">
                        {{ $item->name }}
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
</body>
</html>
