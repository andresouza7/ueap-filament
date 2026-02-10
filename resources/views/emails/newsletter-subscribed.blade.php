<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscrição Confirmada - UEAP</title>
    @vite(['resources/css/novosite.css'])
</head>

<body class="bg-gray-100 font-sans text-gray-800 antialiased m-0 p-0">
    <div class="max-w-[600px] mx-auto bg-white overflow-hidden">
        <!-- Header -->
        <div class="bg-[#0052CC] py-10 px-5 text-center">
            <h1 class="text-white text-2xl font-extrabold uppercase tracking-widest m-0">
                UEAP<span class="text-[#A3E635]">NOTÍCIAS</span>
            </h1>
        </div>

        <!-- Content -->
        <div class="py-10 px-8 text-center">
            <span class="text-[#A3E635] text-5xl mb-5 block">✓</span>
            <h1 class="text-[#0052CC] text-[22px] font-bold mb-4 uppercase">Inscrição Confirmada!</h1>
            <p class="text-base text-gray-600 mb-8">
                Obrigado por se inscrever na nossa newsletter.<br>
                Agora você receberá as principais publicações da Universidade do Estado do Amapá
                diretamente no seu e-mail.
            </p>
            <a href="{{ route('site.home') }}"
                class="inline-block bg-[#A3E635] text-[#0052CC] font-bold no-underline py-3 px-8 rounded text-sm uppercase tracking-wide">
                Voltar para o Site
            </a>
        </div>

        <!-- Footer -->
        <div class="bg-[#003D99] p-8 text-center text-xs text-blue-300">
            <p class="m-0 text-white/50 mb-4">
                &copy; {{ date('Y') }} Universidade do Estado do Amapá.<br>
                Todos os direitos reservados.
            </p>
            <p class="m-0">
                Caso não deseje mais receber,
                <a href="{{ route('newsletter.unsubscribe', $subscriber->unsubscribe_token ?? '') }}"
                    class="text-white font-bold underline decoration-[#A3E635] underline-offset-4">
                    remova sua inscrição aqui
                </a>
            </p>
        </div>
    </div>
</body>

</html>
