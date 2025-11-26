<!doctype html>
<html lang='pt-br'>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Portal da Universidade do Estado do Amapá" />
    <meta name="keywords" content="Amapá, Universidade, Notícias, ueap" />
    <meta name="author" content="Universidade do Estado do Amapá" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('site_antigo/img/ico.ico') }}">
    <title>Ueap - @yield('title')</title>

    <base href="http:/ueap.edu.br" />
    <meta property="og:url" content="http://ueap.edu.br" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Universidade do Estado do Amapá" />
    <meta property="og:description" content="Universidade do Estado do Amapá" />
    <meta property="og:image" content="http://ueap.edu.br" />
    <meta property="og:image:width" content="600">
    <meta property="og:image:height" content="315">

    @vite(['resources/css/site.css'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet" />

</head>

<body>
    @include('novosite.components.header')

    <main>
        @yield('content')
    </main>

    @include('novosite.components.address')
    @include('novosite.components.footer')
</body>

</html>