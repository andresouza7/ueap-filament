<!-- resources/views/layout.blade.php -->
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Tailwind Blog Template')</title>
    <meta name="author" content="David Grzyb">
    <meta name="description" content="">

    <!-- Tailwind CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        /* @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap'); */
        /* @import url('https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,200..800;1,200..800&display=swap'); */

        .font-family-karla {
            font-family: Karla;
        }
    </style>

    <!-- Flowbite UI Plugin -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />

    @livewireStyles
</head>

<body class="bg-gray-100 font-family-karla">

    <!-- Page Container -->
    <div class="container mx-auto flex flex-wrap" style="max-width: 1230px">

        <!-- Header Section -->
        @include('partials.header')

        <!-- Main Content -->
        @yield('content')

        <!-- Footer Section -->
        @include('partials.footer')

    </div>

    <!-- AlpineJS and Font Awesome -->
    {{-- <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"
        integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    @livewireScripts

    <!-- Plugin Vlibras -->
    <div class="hidden xl:block">
        <div vw class="enabled">
            <div vw-access-button class="active"></div>
            <div vw-plugin-wrapper>
                <div class="vw-plugin-top-wrapper"></div>
            </div>
        </div>
    </div>
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>
</body>

</html>
