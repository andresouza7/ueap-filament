<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsletter UEAP</title>
    @vite(['resources/css/novosite.css'])
</head>

<body class="bg-gray-100 font-sans m-0 p-0 text-gray-800 antialiased">
    <div class="w-full bg-gray-100 py-10 flex justify-center px-4">
        <div class="bg-white w-full max-w-[600px] shadow-lg overflow-hidden flex flex-col">

            <!-- Header -->
            <header class="bg-[#0052CC] py-10 px-8 flex flex-col items-center border-b-4 border-[#A3E635] text-center">
                <h1 class="text-white text-[28px] font-black uppercase tracking-tighter m-0 leading-none italic">
                    UEAP<span class="text-[#A3E635]">NOTÍCIAS</span>
                </h1>
                <span class="text-[#A3E635] text-[10px] font-bold uppercase tracking-[3px] mt-2">
                    Resumo Semanal
                </span>
            </header>

            <!-- Intro -->
            <div class="pt-8 px-8 pb-4 text-center text-gray-500 text-sm">
                <p class="m-0">Confira os últimos destaques e atualizações oficiais da Universidade.</p>
            </div>

            <!-- Content -->
            <main class="px-8 pb-10 flex flex-col gap-6 mt-4">
                @foreach ($content as $post)
                    <div class="flex flex-col sm:flex-row gap-5 pb-5 last:pb-0">
                        @if (!empty($post->image_url))
                            <div class="shrink-0">
                                <a href="{{ $post->url }}" class="block">
                                    <img src="{{ $post->image_url }}" alt="{{ $post->title }}"
                                        class="w-full sm:w-[120px] h-auto sm:h-[90px] object-cover rounded shadow-sm bg-gray-200 block">
                                </a>
                            </div>
                        @endif
                        <div class="flex flex-col justify-start">
                            <span
                                class="text-[#0052CC] text-[10px] font-bold uppercase tracking-widest mb-1 leading-tight">
                                {{ $post->publishedAt }}
                            </span>
                            <h2 class="text-[#111827] text-[15px] font-bold leading-tight mb-2 uppercase m-0">
                                <a href="{{ $post->url }}" class="no-underline text-[#111827] hover:text-[#0052CC]">
                                    {{ $post->title }}
                                </a>
                            </h2>
                            <a href="{{ $post->url }}"
                                class="inline-block self-start text-[#0052CC] font-extrabold no-underline uppercase text-[10px] tracking-wider border-b-2 border-[#A3E635] pb-0.5 mt-1 transition-all hover:opacity-80">
                                LER MATÉRIA COMPLETA &rarr;
                            </a>
                        </div>
                    </div>
                @endforeach
            </main>

            <!-- Footer -->
            <footer class="bg-[#003D99] p-8 flex flex-col items-center text-center">
                <div class="text-blue-200 text-[11px] leading-relaxed m-0 flex flex-col items-center">
                    <strong class="text-white uppercase mb-1">Universidade do Estado do Amapá</strong>
                    <p class="m-0">Assessoria de Comunicação</p>
                    <div class="mt-4 pt-4 border-t border-white/10 w-full max-w-[200px]"></div>
                    <p class="mt-4 mb-0 opacity-80">Você está recebendo este e-mail porque se inscreveu em nossa
                        newsletter.</p>
                    <a href="{{ route('newsletter.unsubscribe', $subscriber->unsubscribe_token ?? '') }}"
                        class="mt-4 text-white font-bold underline decoration-[#A3E635] underline-offset-4 hover:text-[#A3E635] transition-colors">
                        Cancelar inscrição aqui
                    </a>
                </div>
            </footer>
        </div>
    </div>
</body>

</html>
