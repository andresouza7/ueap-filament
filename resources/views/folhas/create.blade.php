<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Envio de Folha de Ponto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 20px;
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

        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 6px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            max-width: 450px;
        }

        form label {
            font-weight: bold;
            margin-top: 10px;
        }

        form input[type="text"],
        form select,
        form input[type="file"] {
            padding: 8px;
            margin-top: 4px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
            box-sizing: border-box;
        }

        form button {
            margin-top: 15px;
            padding: 10px 15px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <h1>📄 Envio de Folha de Ponto</h1>

    <div class="info-box">
        Esta área é destinada ao **usuário** para o envio da sua folha de ponto mensal. 
        Preencha os dados, selecione o arquivo e envie. Após o envio, o RH irá avaliar a sua folha.
    </div>

    <form action="{{ route('folhas.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <label for="user_id">Servidor</label>
        <select name="user_id" id="user_id">
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->person->name }}</option>
            @endforeach
        </select>

        <label for="month">Mês</label>
        <select name="month" id="month">
            <option value="janeiro">Janeiro</option>
            <option value="fevereiro">Fevereiro</option>
            <option value="março">Março</option>
            <option value="abril">Abril</option>
            <option value="maio">Maio</option>
            <option value="junho">Junho</option>
            <option value="julho">Julho</option>
            <option value="agosto">Agosto</option>
            <option value="setembro">Setembro</option>
            <option value="outubro">Outubro</option>
            <option value="novembro">Novembro</option>
            <option value="dezembro">Dezembro</option>
        </select>

        <label for="year">Ano</label>
        <input type="text" name="year" id="year" placeholder="Ex: 2025">

        <label for="file">Arquivo (PDF)</label>
        <input type="file" name="file" id="file" accept=".pdf">

        <button type="submit">Enviar</button>
    </form>
</body>

</html>
