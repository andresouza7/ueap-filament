<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <meta name="description" content="Portal da Universidade do Estado do Amapá" />
    <meta name="keywords" content="Amapá, Universidade, Notícias, ueap" />
    <meta name="author" content="Universidade do Estado do Amapá" />

    <link rel="icon" type="image/x-icon" href="{{ asset('site_antigo/img/ico.ico') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">
    @routes
    @viteReactRefresh
    @vite(['resources/js/app.jsx', 'resources/css/novosite.css'])
    @inertiaHead
</head>

<body>
    @inertia

    <div vw class="enabled">
        <div vw-access-button class="active mt-[70px] lg:mt-0"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>

    {{-- <script src="https://app.embed.im/accessibility.js" defer></script> --}}

    <script src="https://cdn.jsdelivr.net/npm/sienna-accessibility@latest/dist/sienna-accessibility.umd.js" defer></script>
</body>

</html>
