@props([
    'categories' => [],
])

<section class="w-full" aria-labelledby="sidebar-categories-title">
    {{-- HEADER ESTRUTURAL (DNA UEAP) --}}
    <div class="flex items-center gap-3 mb-6">
        {{-- O Retângulo de 12px da identidade --}}
        <div class="w-8 h-[10px] bg-[#002266]"></div>
        <h3 id="sidebar-categories-title" class="text-[12px] font-[900] uppercase tracking-[0.3em] text-[#002266]">
            Explorar_<span class="text-[#A4ED4A] italic">Tags</span>
        </h3>
        <div class="flex-1 h-[1px] bg-slate-100"></div>
    </div>

    {{-- Tags Estilo Pílula UEAP --}}
    <nav class="flex flex-wrap gap-x-2 gap-y-3" role="list">
        @foreach ($categories as $category)
            <div role="listitem">
                <a href="{{ route('site.post.list', ['category' => $category->slug]) }}"
                    aria-label="Ver postagens sobre {{ $category->name }}"
                    class="group relative inline-flex items-center px-4 py-1.5 bg-white border-2 border-[#002266] rounded-full 
                           text-[10px] font-black text-[#002266] uppercase tracking-widest
                           hover:bg-[#002266] hover:text-[#A4ED4A] transition-all duration-300">
                    
                    {{-- Detalhe interno que aparece no hover --}}
                    <span class="mr-1.5 opacity-0 group-hover:opacity-100 transition-opacity">#</span>
                    
                    {{ $category->name }}

                    {{-- Dot decorativo estilo UEAP --}}
                    <span class="ml-2 w-1 h-1 bg-[#A4ED4A] rounded-full group-hover:bg-white"></span>
                </a>
            </div>
        @endforeach
    </nav>

    {{-- Footer da Seção --}}
    <div class="mt-6 flex items-center gap-2">
        <div class="w-full h-[1px] bg-slate-50"></div>
        <span class="text-[8px] font-black text-slate-300 uppercase tracking-[0.4em] whitespace-nowrap">
            Index_Ref_026
        </span>
    </div>
</section>