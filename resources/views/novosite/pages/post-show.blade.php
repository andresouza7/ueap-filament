@extends('novosite.template.master')

@section('title', $post->title ?? 'Notícia')

@section('content')

    @php $url_atual = urlencode(url()->current()); @endphp

    <x-novosite.components.page-header
        :title="$post->title"
        :subtitle="$post->category->name"
        :breadcrumb="[
            ['label' => 'Notícias', 'url' => route('site.post.list')],
            ['label' => $post->category->name, 'url' => route('site.post.list', ['category' => $post->category->slug])]
        ]"
    >
        <div class="flex flex-wrap items-center gap-6 text-sm font-medium text-white/80">
            <div class="flex items-center gap-2">
                <i class="fa-regular fa-calendar"></i>
                <time>{{ $post->created_at->format('d/m/Y') }}</time>
            </div>
            <div class="flex items-center gap-2">
                <i class="fa-regular fa-eye"></i>
                <span>{{ number_format($post->hits, 0, ',', '.') }} visualizações</span>
            </div>

            <div class="flex items-center gap-3 ml-auto">
                <span class="text-xs uppercase tracking-wide opacity-70">Compartilhar:</span>
                <a href="https://api.whatsapp.com/send?text={{ $url_atual }}" class="hover:text-ueap-secondary transition-colors" aria-label="WhatsApp">
                    <i class="fa-brands fa-whatsapp text-lg"></i>
                </a>
                <a href="https://twitter.com/intent/tweet?url={{ $url_atual }}" class="hover:text-ueap-secondary transition-colors" aria-label="Twitter">
                    <i class="fa-brands fa-x-twitter text-lg"></i>
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ $url_atual }}" class="hover:text-ueap-secondary transition-colors" aria-label="Facebook">
                    <i class="fa-brands fa-facebook text-lg"></i>
                </a>
            </div>
        </div>
    </x-novosite.components.page-header>

    <section class="bg-white py-12 lg:py-20">
        <div class="max-w-ueap mx-auto px-4 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16">

                {{-- Matéria --}}
                <main class="lg:col-span-8">
                    <article class="article-body">
                        @foreach ($post->content ?? [] as $block)
                            <div class="mb-8">
                                @include('novosite.components.post-block-renderer', ['block' => $block])
                            </div>
                        @endforeach
                    </article>

                    <footer class="mt-16 pt-8 border-t border-gray-100 flex justify-between items-center text-sm text-slate-500">
                        <span class="font-medium">Fim da publicação</span>
                        <span class="italic">Atualizado em {{ $post->updated_at->format('d/m/Y \à\s H:i') }}</span>
                    </footer>

                    <div class="mt-16">
                        <h3 class="text-2xl font-bold text-ueap-primary mb-8 border-b border-gray-100 pb-4">Relacionados</h3>
                        @include('novosite.components.post-relacionados', ['posts' => $relatedPosts])
                    </div>
                </main>

                {{-- Sidebar --}}
                <aside class="lg:col-span-4 space-y-12">
                    @if ($post->web_menu)
                        <nav class="bg-gray-50 rounded-xl p-6 border border-gray-100">
                            <h4 class="text-sm font-bold text-slate-400 uppercase tracking-widest mb-6">Nesta Seção</h4>
                            <div class="space-y-2">
                                @foreach (optional($post->web_menu)->items()->where('status', 'published')->orderBy('position')->get() ?? [] as $item)
                                    @php $isActive = request()->url() == $item->url; @endphp
                                    <a href="{{ $item->url }}"
                                        class="flex items-center justify-between p-3 rounded-lg transition-all
                                       {{ $isActive ? 'bg-ueap-primary text-white shadow-md' : 'text-slate-700 hover:bg-white hover:shadow-sm' }}">
                                        <span class="text-sm font-medium">{{ $item->name }}</span>
                                        @if(!$isActive)
                                            <i class="fa-solid fa-chevron-right text-xs text-gray-300"></i>
                                        @endif
                                    </a>
                                @endforeach
                            </div>
                        </nav>
                    @endif

                    <div class="space-y-8">
                        @include('novosite.components.sidebar-search')

                        <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm">
                            <h4 class="text-ueap-primary font-bold text-lg mb-4 border-b border-gray-100 pb-2">Últimas Notícias</h4>
                            @include('novosite.components.sidebar-news', ['posts' => $latestPosts])
                        </div>

                        @include('novosite.components.sidebar-newsletter')

                        <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm">
                            <h4 class="text-ueap-primary font-bold text-lg mb-4 border-b border-gray-100 pb-2">Categorias</h4>
                            @include('novosite.components.sidebar-categories', ['categories' => $categories])
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>

@endsection
