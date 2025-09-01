<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Folhas de Frequência</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f8f9fa;
            color: #333;
        }

        h1 {
            color: #2c3e50;
        }

        .info-box {
            background-color: #e0f7fa;
            border-left: 5px solid #00acc1;
            padding: 12px 16px;
            margin-bottom: 20px;
            color: #007c91;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .button {
            display: inline-block;
            margin-bottom: 20px;
            padding: 8px 12px;
            background-color: #007bff;
            color: #fff;
            border-radius: 4px;
        }

        .button:hover {
            background-color: #0056b3;
        }

        ul {
            list-style: none;
            padding-left: 0;
        }

        ul li {
            padding: 6px 0;
        }

        .folder {
            font-weight: bold;
        }

        .file {
            font-style: italic;
        }
    </style>
</head>

<body>
    <h1>📂 Folhas de Frequência</h1>

    <div class="info-box">
        Esta área é destinada ao **funcionário** responsável pelo setor de rh para consulta do acervo funcional.
    </div>

    <a href="{{ route('folhas.create') }}" class="button">+ Simular envio do ponto</a>

    <h4>Consultar Acervo Funcional:</h4>

    {{-- Botão para voltar um nível, se não estiver na raiz --}}
    @if($currentFolderId !== env('GOOGLE_DRIVE_FOLDER_ID'))
        <p><a href="{{ route('folhas.index') }}">⬅️ Voltar para Raiz</a></p>
    @endif

    <ul>
        @foreach($items as $item)
            @if($item->mimeType === 'application/vnd.google-apps.folder')
                {{-- É pasta (ano ou usuário) --}}
                <li class="folder">
                    📁 <a href="{{ route('folhas.index', ['folderId' => $item->id]) }}">
                        {{ $item->name }}
                    </a>
                </li>
            @else
                {{-- É arquivo (mês) --}}
                <li class="file">
                    📄 <a href="{{ $item->webViewLink }}" target="_blank">
                        {{ $item->name }}
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
</body>

</html>
