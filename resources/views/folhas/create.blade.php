<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form action="{{ route('folhas.store') }}" method="post" enctype="multipart/form-data"
        style="display: flex; flex-direction:column; gap: 4px; max-width: 400px">
        @csrf

        <select name="user_id" id="user_id">
            @foreach ($users as $user)
                <option value="{{$user->id}}">{{$user->person->name}}</option>
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
        <input type="text" name="year" id="year">

        <label for="file"></label>
        <input type="file" name="file" id="file">
        <button type="submit">enviar</button>
    </form>

</body>

</html>
