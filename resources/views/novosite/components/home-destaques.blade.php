{{-- DESTAQUE PRINCIPAL + ACESSO RÁPIDO --}}
<div class="w-full relative overflow-hidden bg-white border-b border-gray-100">

    <section class="w-full relative z-10 py-12 lg:py-16" aria-label="Destaques">
        <div class="max-w-ueap mx-auto px-4 lg:px-8">

            <div class="grid grid-cols-12 gap-8 lg:gap-12 items-start">

                {{-- COLUNA DA ESQUERDA: DESTAQUE PRINCIPAL --}}
                @if (isset($featured[0]))
                    <article class="col-span-12 lg:col-span-8 flex">
                        <a href="{{ route('site.post.show', $featured[0]->slug) }}" class="relative group w-full block rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow">

                            {{-- Imagem --}}
                            <div class="relative w-full aspect-[16/9] overflow-hidden">
                                <img src="{{ $featured[0]->image_url }}" alt="{{ $featured[0]->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>

                                <div class="absolute top-4 left-4">
                                    <span class="bg-ueap-secondary text-ueap-primary text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">
                                        {{ $featured[0]->category->name ?? 'Destaque' }}
                                    </span>
                                </div>

                                <div class="absolute bottom-0 left-0 w-full p-6 lg:p-8">
                                    <h2 class="text-white text-3xl lg:text-4xl font-bold leading-tight mb-2 group-hover:text-ueap-secondary transition-colors">
                                        {{ $featured[0]->title }}
                                    </h2>
                                    <p class="text-white/80 line-clamp-2 text-sm lg:text-base font-medium">
                                        {{ $featured[0]->resume }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </article>
                @endif

                {{-- COLUNA DA DIREITA: ACESSO RÁPIDO --}}
                <aside class="col-span-12 lg:col-span-4 flex flex-col h-full">
                    <div class="bg-gray-50 rounded-xl border border-gray-100 p-6 flex-1 flex flex-col">

                        <div class="flex items-center gap-2 mb-6 border-b border-gray-200 pb-4">
                            <span class="w-1.5 h-6 bg-ueap-primary rounded-sm"></span>
                            <h3 class="text-ueap-primary text-lg font-bold uppercase tracking-tight">Serviços Digitais</h3>
                        </div>

                        <nav class="flex flex-col gap-2 flex-1">
                            @php
                                $links = [
                                    ['icon' => 'fa-calendar-days', 'label' => 'Calendário Acadêmico', 'desc' => 'Datas e prazos'],
                                    ['icon' => 'fa-scale-balanced', 'label' => 'Legislação e Atos', 'desc' => 'Base jurídica'],
                                    ['icon' => 'fa-file-lines', 'label' => 'Instruções Normativas', 'desc' => 'Regramentos'],
                                    ['icon' => 'fa-gavel', 'label' => 'Conselho Superior', 'desc' => 'Resoluções CONSU'],
                                    ['icon' => 'fa-handshake', 'label' => 'Licitações e Contratos', 'desc' => 'Transparência'],
                                    ['icon' => 'fa-user-tie', 'label' => 'Processos Seletivos', 'desc' => 'Concursos'],
                                ];
                            @endphp

                            @foreach ($links as $link)
                                <a href="#" class="group flex items-center p-3 rounded-lg hover:bg-white hover:shadow-sm transition-all border border-transparent hover:border-gray-100">
                                    <div class="w-10 h-10 flex-shrink-0 flex items-center justify-center rounded-lg bg-white border border-gray-200 text-ueap-primary group-hover:bg-ueap-primary group-hover:text-white transition-colors">
                                        <i class="fa-solid {{ $link['icon'] }}"></i>
                                    </div>
                                    <div class="ml-4">
                                        <span class="block text-sm font-bold text-slate-700 group-hover:text-ueap-primary transition-colors">{{ $link['label'] }}</span>
                                        <span class="block text-xs text-slate-500">{{ $link['desc'] }}</span>
                                    </div>
                                    <i class="fa-solid fa-chevron-right text-xs text-gray-300 ml-auto group-hover:text-ueap-secondary transition-colors"></i>
                                </a>
                            @endforeach
                        </nav>
                    </div>
                </aside>

            </div>
        </div>
    </section>
</div>
