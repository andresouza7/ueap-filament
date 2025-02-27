{{-- resources/views/layouts/main.blade.php --}}
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Universidade')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    @include('site.template.partials.navbar')

    <header class="bg-blue-600 text-white py-6 text-center">
        <h1 class="text-3xl font-bold">Universidade Exemplo</h1>
    </header>

    <main class="container mx-auto py-8 px-4">
        @yield('content')
    </main>

    @include('site.template.partials.footer')
</body>

</html>
