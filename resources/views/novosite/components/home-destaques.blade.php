{{-- HERO SECTION: INSTITUCIONAL E IMPONENTE --}}
<div class="relative bg-ueap-primary">
    {{-- Background Pattern --}}
    <div class="absolute inset-0 opacity-10 pointer-events-none"
         style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 32px 32px;"></div>

    <div class="max-w-ueap mx-auto px-4 lg:px-8 py-12 lg:py-20 relative z-10">

        <div class="grid grid-cols-12 gap-8 lg:gap-16 items-start">

            {{-- DESTAQUE PRINCIPAL (Esquerda - Maior) --}}
            @if (isset($featured[0]))
                <div class="col-span-12 lg:col-span-8">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="h-px w-12 bg-ueap-secondary"></span>
                        <span class="text-ueap-secondary text-xs font-bold uppercase tracking-[0.2em]">Destaque Institucional</span>
                    </div>

                    <a href="{{ route('site.post.show', $featured[0]->slug) }}" class="group block relative rounded-2xl overflow-hidden shadow-2xl">
                        <div class="aspect-[16/9] lg:aspect-[16/10] w-full relative">
                            <img src="{{ $featured[0]->image_url }}" alt="{{ $featured[0]->title }}"
                                 class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105">

                            {{-- Gradient Overlay --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent opacity-90"></div>

                            <div class="absolute bottom-0 left-0 p-8 lg:p-12 w-full">
                                <span class="inline-block bg-ueap-secondary text-ueap-primary text-[10px] font-black uppercase px-3 py-1 mb-4 rounded-sm tracking-widest">
                                    {{ $featured[0]->category->name }}
                                </span>
                                <h2 class="text-3xl lg:text-5xl font-serif font-bold text-white leading-[1.1] mb-4 group-hover:text-ueap-secondary transition-colors">
                                    {{ $featured[0]->title }}
                                </h2>
                                <p class="text-white/80 text-sm lg:text-lg max-w-2xl line-clamp-2 font-sans font-light">
                                    {{ $featured[0]->resume }}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

            {{-- MENU DE ACESSO RÁPIDO (Direita) --}}
            <aside class="col-span-12 lg:col-span-4 flex flex-col h-full pt-12 lg:pt-0">
                <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-8 shadow-xl">
                    <h3 class="text-white font-serif font-bold text-2xl mb-2">Serviços Digitais</h3>
                    <p class="text-white/50 text-xs uppercase tracking-widest mb-8 font-sans">Acesso Rápido</p>

                    <nav class="space-y-1">
                        @php
                            $links = [
                                ['icon' => 'fa-calendar-days', 'label' => 'Calendário Acadêmico', 'url' => '/documentos/calendar'],
                                ['icon' => 'fa-file-lines', 'label' => 'Atos e Legislação', 'url' => '#'],
                                ['icon' => 'fa-gavel', 'label' => 'Conselho Superior', 'url' => '/consu/resolucoes'],
                                ['icon' => 'fa-handshake', 'label' => 'Licitações', 'url' => '#'],
                                ['icon' => 'fa-users', 'label' => 'Processos Seletivos', 'url' => 'https://processoseletivo.ueap.edu.br'],
                                ['icon' => 'fa-graduation-cap', 'label' => 'Portal do Aluno', 'url' => 'https://sigaa.ueap.edu.br'],
                            ];
                        @endphp

                        @foreach ($links as $link)
                            <a href="{{ $link['url'] }}" class="group flex items-center justify-between p-4 rounded-xl hover:bg-white transition-all duration-300">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-ueap-secondary group-hover:bg-ueap-primary group-hover:text-white transition-colors">
                                        <i class="fa-solid {{ $link['icon'] }}"></i>
                                    </div>
                                    <span class="text-white font-bold text-sm group-hover:text-ueap-primary transition-colors font-sans">{{ $link['label'] }}</span>
                                </div>
                                <i class="fa-solid fa-arrow-right text-white/20 group-hover:text-ueap-primary transition-colors"></i>
                            </a>
                        @endforeach
                    </nav>
                </div>
            </aside>

        </div>
    </div>

    {{-- Decorative Bottom Wave/Border --}}
    <div class="h-4 bg-ueap-secondary w-full relative z-20"></div>
</div>
