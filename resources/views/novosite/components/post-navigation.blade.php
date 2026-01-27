@props(['menu', 'title' => 'Navegação'])

<nav class="sticky top-24">
    {{-- Header --}}
    <div class="mb-6 pb-4 border-b border-gray-200">
        <h3
            class="text-2xl font-black text-[#00388d] leading-none tracking-tighter uppercase pl-4 border-l-4 border-ueap-green">
            {{ $title }}
        </h3>
    </div>

    {{-- Lista --}}
    <div class="flex flex-col gap-1">
        @foreach (optional($menu)->items()->where('status', 'published')->orderBy('position')->get() ?? [] as $item)
            @php $isActive = request()->url() == $item->url; @endphp

            <a href="{{ $item->url }}"
                class="block px-4 py-2 text-xs font-bold uppercase tracking-wider transition-colors border-l-2
                {{ $isActive
                    ? 'border-ueap-green text-[#00388d] bg-slate-50'
                    : 'border-transparent text-slate-500 hover:text-[#00388d] hover:bg-slate-50' }}">
                {{ $item->name }}
            </a>
        @endforeach
    </div>
</nav>
