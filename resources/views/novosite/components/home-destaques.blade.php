{{-- HERO SECTION --}}
<section class="bg-gray-50 py-12 border-b border-gray-200">
    <div class="max-w-ueap mx-auto px-4 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">

            {{-- MAIN FEATURE (Left - 8 cols) --}}
            <div class="lg:col-span-8">
                @if (isset($featured[0]))
                    <a href="{{ route('site.post.show', $featured[0]->slug) }}" class="group block relative h-[400px] lg:h-[500px] rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300">
                        <img src="{{ $featured[0]->image_url }}" alt="{{ $featured[0]->title }}"
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">

                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>

                        <div class="absolute bottom-0 left-0 p-8 w-full">
                            <span class="inline-block bg-ueap-secondary text-ueap-primary text-xs font-bold px-3 py-1 rounded-full mb-3 uppercase tracking-wide">
                                {{ $featured[0]->category->name ?? 'Destaque' }}
                            </span>
                            <h2 class="text-3xl lg:text-4xl font-bold text-white leading-tight mb-2 group-hover:text-ueap-secondary transition-colors">
                                {{ $featured[0]->title }}
                            </h2>
                            <p class="text-white/80 line-clamp-2 max-w-2xl text-sm lg:text-base font-medium">
                                {{ $featured[0]->resume }}
                            </p>
                        </div>
                    </a>
                @endif
            </div>

            {{-- SIDEBAR / SECONDARY (Right - 4 cols) --}}
            <div class="lg:col-span-4 flex flex-col gap-6">

                {{-- Quick Access Box --}}
                <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm flex-1">
                    <h3 class="text-lg font-bold text-ueap-primary mb-6 flex items-center gap-2 border-b border-gray-100 pb-4">
                        <i class="fa-solid fa-bolt text-ueap-secondary"></i>
                        Acesso Rápido
                    </h3>

                    <nav class="space-y-2">
                        @php
                            $quickLinks = [
                                ['label' => 'Calendário Acadêmico', 'icon' => 'fa-calendar', 'url' => '/documentos/calendar'],
                                ['label' => 'Editais e Concursos', 'icon' => 'fa-file-contract', 'url' => '#'],
                                ['label' => 'Portal do Aluno', 'icon' => 'fa-user-graduate', 'url' => 'https://sigaa.ueap.edu.br'],
                                ['label' => 'Portal do Professor', 'icon' => 'fa-chalkboard-user', 'url' => '#'],
                                ['label' => 'Biblioteca Online', 'icon' => 'fa-book', 'url' => '#'],
                            ];
                        @endphp

                        @foreach ($quickLinks as $link)
                            <a href="{{ $link['url'] }}" class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 group border border-transparent hover:border-gray-100 transition-all">
                                <div class="flex items-center gap-3 text-slate-700 font-medium">
                                    <div class="w-8 h-8 rounded-full bg-ueap-primary/5 flex items-center justify-center text-ueap-primary text-xs group-hover:bg-ueap-primary group-hover:text-white transition-colors">
                                        <i class="fa-solid {{ $link['icon'] }}"></i>
                                    </div>
                                    {{ $link['label'] }}
                                </div>
                                <i class="fa-solid fa-chevron-right text-xs text-gray-300 group-hover:text-ueap-primary transition-colors"></i>
                            </a>
                        @endforeach
                    </nav>
                </div>

                {{-- Secondary Featured (If exists) --}}
                @if(isset($featured[1]))
                    <a href="{{ route('site.post.show', $featured[1]->slug) }}" class="relative h-48 rounded-2xl overflow-hidden group block shadow-sm">
                        <img src="{{ $featured[1]->image_url }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-5">
                            <span class="text-ueap-secondary text-[10px] font-bold uppercase tracking-wider block mb-1">
                                {{ $featured[1]->category->name }}
                            </span>
                            <h3 class="text-white font-bold leading-snug text-lg group-hover:underline decoration-ueap-secondary underline-offset-4">
                                {{ $featured[1]->title }}
                            </h3>
                        </div>
                    </a>
                @endif

            </div>
        </div>
    </div>
</section>
