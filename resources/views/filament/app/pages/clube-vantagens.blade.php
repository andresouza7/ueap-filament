<x-filament-panels::page>
    <div class="p-5 bg-cover bg-fixed bg-center relative rounded-md"
        style="background-image: url('{{ asset('img/banner-clube.png') }}'); background-position: center 120px;">

        {{-- Cabeçalho --}}
        <div class="flex flex-wrap items-center gap-3 mb-4">
            <img src="{{ asset('img/logo-white.png') }}" alt="UEAP Logo" class="h-12">
            <h2 class="text-white text-3xl font-bold mb-0">Clube de Vantagens</h2>
        </div>

        {{-- Bloco principal --}}
        <div
            class="p-3 rounded-sm shadow-lg bg-black/60 backdrop-blur-md max-w-full xl:max-w-[42%] border border-white/10">

            {{-- Texto informativo --}}
            <div class="text-white space-y-4 text-sm leading-relaxed">
                <h2 class="text-lg font-semibold text-white tracking-wide">👋 Olá, servidores!</h2>

                <p>
                    Neste espaço, você pode conhecer os nossos <span
                        class="font-semibold text-yellow-300">parceiros</span> e os benefícios exclusivos oferecidos por
                    cada um deles.
                </p>

                <div class="bg-yellow-100/10 border-l-4 border-yellow-400 pl-4 py-2">
                    <p class="font-bold text-yellow-300">Atenção:</p>
                    <p>
                        Para usufruir das vantagens, baixe sua <span class="underline">carteira funcional</span> no
                        Portal do Servidor ou apresente seu contracheque atualizado.
                    </p>
                </div>

                <p>
                    Você também pode <span class="font-medium text-green-300">contribuir com novas parcerias</span>!
                    Basta compartilhar o edital disponível no final desta página.
                </p>

                <p>
                    Em caso de dúvidas ou sugestões, entre em contato conosco pelo e-mail:
                    <a href="mailto:urh@ueap.edu.br" class="text-yellow-400 underline hover:text-yellow-300 transition">
                        urh@ueap.edu.br
                    </a>.
                </p>
            </div>

            {{-- Divisor visual --}}
            <div class="my-4 h-px bg-gradient-to-r from-white/20 to-transparent"></div>

            {{-- Grid de parceiros --}}
            <div class="overflow-x-hidden max-h-[600px]">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                    @php
                        $documents = \App\Models\Document::whereHas('category', function ($query) {
                            $query->where('slug', 'clube-vantagens');
                        })->get();
                    @endphp
                    @forelse ($documents as $document)
                        <div>
                            <a href="{{ $document->getFirstMediaUrl() }}" target="_blank" class="block">
                                <div
                                    class="relative rounded overflow-hidden shadow-md aspect-square w-full hover:scale-[1.01] transition">
                                    {{-- <img src="{{ $document->getFirstMediaUrl('thumbnail') }}"
                                        alt="Logo {{ $document->title }}" class="w-full h-full object-cover"> --}}
                                    <img src="https://picsum.photos/seed/{{ $document->id }}/300"
                                        alt="Logo {{ $document->title }}" class="w-full h-full object-cover">

                                    <div class="absolute bottom-0 w-full bg-yellow-500/90 text-white text-center text-xs truncate py-1"
                                        title="{{ $document->title }}">
                                        {{ $document->title }}
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-span-full">
                            <div class="bg-blue-100 text-blue-900 p-4 rounded text-center shadow">
                                Nenhum parceiro encontrado no momento. Volte mais tarde!
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Chamada Pública --}}
        <div class="bg-white/95 text-black p-4 shadow-md mt-6 rounded">
            <p class="font-bold mb-1">
                <i class="fa fa-bullhorn mr-2 text-blue-600"></i>
                Chamada Pública nº 025/2025 - PROPLAD/UEAP
            </p>
            <p class="text-sm">
                <a href="{{ asset('storage/documents/general/1431.pdf') }}" target="_blank"
                    class="font-semibold text-blue-600 underline">
                    Compartilhe o edital e ajude a alcançar novas parcerias!
                </a>
            </p>
        </div>

    </div>
</x-filament-panels::page>
