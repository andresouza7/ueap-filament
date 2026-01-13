@props(['menu', 'title' => 'Navegação'])

<nav class="sticky top-24 lg:pl-8">
    {{-- Cabeçalho do Menu: Mais colado e discreto --}}
    <div class="flex items-center gap-2 mb-4 border-b border-slate-100 pb-1.5">
        <h3 class="text-[10px] font-bold uppercase tracking-[0.25em] text-slate-400 whitespace-nowrap">
            {{ $title }} <span class="text-emerald-600 italic">Interna</span>
        </h3>
    </div>

    {{-- Lista de Itens: Espaçamento reduzido (py-2 e gap-0) --}}
    <div class="flex flex-col max-w-[240px]">
        @foreach (optional($menu)->items()->where('status', 'published')->orderBy('position')->get() ?? [] as $item)
            @php $isActive = request()->url() == $item->url; @endphp

            <a href="{{ $item->url }}"
                class="group flex items-center justify-between px-3 py-2 border-b border-slate-50 transition-all duration-200
                {{ $isActive ? 'bg-slate-900 text-white' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">

                {{-- Fonte reduzida para 11px e peso Bold --}}
                <span class="text-[11px] font-bold uppercase tracking-wide {{ $isActive ? 'italic' : '' }}">
                    {{ $item->name }}
                </span>

                @if ($isActive)
                    <span class="h-[2px] w-3 bg-emerald-500"></span>
                @else
                    <i class="fa-solid fa-chevron-right text-[7px] text-slate-300 opacity-0 -translate-x-1 group-hover:opacity-100 group-hover:translate-x-0 transition-all"></i>
                @endif
            </a>
        @endforeach
    </div>
</nav>