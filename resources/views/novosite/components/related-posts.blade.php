@props([
    'posts' => []
])

<section class="mt-12 pt-12">
    {{-- Header alinhado com a identidade visual --}}
    <div class="flex items-center justify-between mb-10">
        <h2 class="text-3xl lg:text-4xl font-black tracking-tighter uppercase italic text-slate-900">
            <span class="text-slate-400 not-italic font-light">Veja</span> também<span class="text-emerald-500 not-italic">.</span>
        </h2>
        <div class="hidden lg:block h-[2px] flex-1 mx-8 bg-slate-100"></div>
    </div>

    {{-- Grid: Lista densa no mobile, 4 colunas simétricas no desktop --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-10">
        @foreach ($posts as $post)
            <article class="group">
                <a href="{{ route('site.post.show', $post->slug) }}" class="flex flex-row lg:flex-col gap-5 items-start">

                    {{-- Container da Imagem: Estilo Industrial --}}
                    <div class="shrink-0 w-24 h-24 sm:w-32 sm:h-32 lg:w-full lg:h-auto lg:aspect-[16/10] overflow-hidden bg-slate-100 rounded-[2px] relative border border-slate-100">
                        <img src="{{ 'https://picsum.photos/seed/' . $post->id . '/600/450' }}" 
                             alt="{{ $post->title }}"
                             class="w-full h-full object-cover transition duration-700 group-hover:scale-105 group-hover:grayscale-[0.3]">
                        
                        {{-- Overlay de hover sutil --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </div>

                    {{-- Conteúdo --}}
                    <div class="flex flex-col min-w-0">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-[9px] font-black uppercase tracking-widest text-emerald-600 bg-emerald-50 px-1.5 py-0.5">
                                {{ $post->category->name ?? 'Update' }}
                            </span>
                            <span class="text-slate-300 text-[10px]">—</span>
                            <time class="text-[9px] font-bold text-slate-400 uppercase tracking-tighter">
                                {{ $post->created_at->format('d.m.Y') }}
                            </time>
                        </div>

                        <h3 class="font-extrabold text-base lg:text-lg text-slate-800 group-hover:text-emerald-600 transition-all leading-tight italic line-clamp-2 lg:line-clamp-3 mb-4">
                            {{ $post->title }}
                        </h3>

                        {{-- Link decorativo que segue a identidade --}}
                        <div class="mt-auto flex items-center gap-2">
                            <span class="h-[1px] w-0 bg-emerald-500 group-hover:w-8 transition-all duration-500"></span>
                            <span class="text-[9px] font-black uppercase tracking-widest text-slate-400 group-hover:text-slate-900 transition-colors">
                                Ler mais
                            </span>
                        </div>
                    </div>
                </a>
            </article>
        @endforeach
    </div>
</section>