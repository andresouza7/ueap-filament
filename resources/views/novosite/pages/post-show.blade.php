@extends('novosite.template.master')

@section('title', $post->title ?? 'Notícia')

@section('content')

    <x-novosite.components.page-header
        :title="$post->title"
        :subtitle="$post->category->name"
        :breadcrumb="[
            ['label' => 'Notícias', 'url' => route('site.post.list')],
            ['label' => $post->category->name, 'url' => route('site.post.list', ['category' => $post->category->slug])]
        ]"
    >
        <div class="flex flex-wrap items-center gap-6 text-sm font-medium text-slate-500 mt-6">
            <div class="flex items-center gap-2">
                <i class="fa-regular fa-calendar"></i>
                <time>{{ $post->created_at->format('d/m/Y \à\s H:i') }}</time>
            </div>
            <div class="flex items-center gap-2">
                <i class="fa-regular fa-eye"></i>
                <span>{{ number_format($post->hits, 0, ',', '.') }} visualizações</span>
            </div>

            {{-- Share --}}
            <div class="flex items-center gap-3 ml-auto border-l border-gray-200 pl-6">
                <span class="text-xs font-bold uppercase tracking-wide opacity-50">Compartilhar</span>
                <a href="https://api.whatsapp.com/send?text={{ urlencode(url()->current()) }}" class="text-slate-400 hover:text-[#25D366] transition-colors" aria-label="WhatsApp">
                    <i class="fa-brands fa-whatsapp text-lg"></i>
                </a>
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}" class="text-slate-400 hover:text-black transition-colors" aria-label="Twitter">
                    <i class="fa-brands fa-x-twitter text-lg"></i>
                </a>
            </div>
        </div>
    </x-novosite.components.page-header>

    <div class="max-w-ueap mx-auto px-4 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

            {{-- ARTICLE --}}
            <main class="lg:col-span-8">

                {{-- Featured Image --}}
                @if($post->image_url)
                    <figure class="rounded-2xl overflow-hidden shadow-sm mb-10">
                        <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="w-full h-auto">
                        @if($post->image_credits)
                            <figcaption class="text-xs text-slate-400 text-right mt-2 italic px-2">Foto: {{ $post->image_credits }}</figcaption>
                        @endif
                    </figure>
                @endif

                <article class="article-body">
                    @foreach ($post->content ?? [] as $block)
                        @include('novosite.components.post-block-renderer', ['block' => $block])
                    @endforeach
                </article>

                <div class="mt-16 pt-8 border-t border-gray-100 flex justify-between items-center text-sm text-slate-500">
                    <span class="font-medium bg-gray-100 px-3 py-1 rounded">Fim da matéria</span>
                    <span class="italic">Atualizado em {{ $post->updated_at->format('d/m/Y') }}</span>
                </div>

                <div class="mt-16">
                    <h3 class="text-2xl font-bold text-ueap-primary mb-8 pb-4 border-b border-gray-100">Notícias Relacionadas</h3>
                    @include('novosite.components.post-relacionados', ['posts' => $relatedPosts])
                </div>
            </main>

            {{-- SIDEBAR --}}
            <aside class="lg:col-span-4 space-y-10">

                {{-- Menu of Section (if exists) --}}
                @if ($post->web_menu)
                    <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">Nesta Seção</h4>
                        <nav class="space-y-1">
                            @foreach (optional($post->web_menu)->items()->where('status', 'published')->orderBy('position')->get() ?? [] as $item)
                                @php $isActive = request()->url() == $item->url; @endphp
                                <a href="{{ $item->url }}"
                                    class="flex items-center justify-between px-4 py-3 rounded-lg transition-all text-sm font-medium
                                   {{ $isActive ? 'bg-ueap-primary text-white shadow-sm' : 'text-slate-700 hover:bg-white hover:shadow-sm' }}">
                                    <span>{{ $item->name }}</span>
                                    @if(!$isActive)
                                        <i class="fa-solid fa-chevron-right text-[10px] text-slate-300"></i>
                                    @endif
                                </a>
                            @endforeach
                        </nav>
                    </div>
                @endif

                {{-- Latest News Widget --}}
                <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                    <h4 class="text-lg font-bold text-slate-800 mb-6 pb-2 border-b border-gray-100">Últimas Publicações</h4>
                    @include('novosite.components.sidebar-news', ['posts' => $latestPosts])
                </div>

                {{-- Newsletter --}}
                @include('novosite.components.sidebar-newsletter')

            </aside>
        </div>
    </div>
@endsection
