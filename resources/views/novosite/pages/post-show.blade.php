@extends('novosite.template.master')

@section('title', isset($post->title) ? $post->title : (isset($post->slug) ? str_replace('-', ' ', ucfirst($post->slug))
    : 'Notícia'))

@section('content')
    <div class="flex flex-col">
        <style>
            /* Tipografia base */
            :root {
                --text: #0f172a;
                --muted: #6b7280;
                --card-shadow: 0 8px 28px rgba(15, 23, 42, 0.06);
                --accent: #0b6b3a;
                /* use sua cor se tiver */
            }

            body {
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
            }

            .post-wrapper {
                font-family: "Inter", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
                color: var(--text);
            }

            .post-article {
                font-family: "Merriweather", Georgia, serif;
                line-height: 1.78;
                font-size: 1.03rem;
                color: var(--text);
            }

            /* Drop cap (somente em telas md+) */
            @media (min-width:768px) {
                .post-article p:first-of-type::first-letter {
                    float: left;
                    font-size: 4.6rem;
                    line-height: 0.78;
                    font-weight: 700;
                    margin-right: .55rem;
                    margin-top: .08rem;
                    color: var(--text);
                    font-family: "Merriweather", Georgia, serif;
                    -webkit-font-smoothing: antialiased;
                }
            }

            .post-card {
                overflow: hidden;
            }

            /* Botões */
            .btn-back {
                display: inline-flex;
                align-items: center;
                gap: .6rem;
                background: linear-gradient(180deg, #fbfdff, #f6f9fb);
                border: 1px solid #e6e9eb;
                padding: .5rem .85rem;
                border-radius: .6rem;
                font-weight: 600;
                color: var(--text);
                text-decoration: none;
            }

            .btn-back .fa-fw {
                width: 1rem;
                text-align: center;
            }

            .share-icon {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 40px;
                height: 40px;
                border-radius: 999px;
                border: 1px solid rgba(15, 23, 42, 0.06);
                background: white;
                box-shadow: 0 6px 18px rgba(15, 23, 42, 0.03);
                color: var(--text);
                text-decoration: none;
            }

            .share-label {
                font-weight: 600;
                margin-left: .5rem;
                display: inline-block;
            }

            /* Header layout */
            .post-header {
                background: transparent;
                padding: 1rem;
                border-radius: .5rem;
            }

            @media(min-width:1024px) {
                .post-header {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    gap: 1.25rem;
                }
            }

            /* Breadcrumb overflow */
            .breadcrumb {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                white-space: nowrap;
            }

            /* Small niceties */
            .muted {
                color: var(--muted);
            }

            .meta-item {
                display: flex;
                align-items: center;
                gap: .5rem;
                color: var(--muted);
                font-weight: 600;
            }

            .meta-item i {
                color: #9ca3af;
                width: 1.05rem;
                text-align: center;
            }
        </style>

        {{-- Topo branco: somente breadcrumb --}}
        <section class="w-full py-8 border-b border-gray-200"> <!-- border cinza claro -->
            <div class="max-w-[1290px] mx-auto px-4">
                <nav class="text-sm mb-3" aria-label="Breadcrumb">
                    <a href="{{ url('/') }}" class="hover:underline">Início</a>
                    <span class="mx-2">/</span>
                    <a href="{{ route('novosite.home') }}" class="hover:underline">Notícias</a>
                    <span class="mx-2">/</span>
                    <span class="text-gray-600">{{ $post->slug }}</span>
                </nav>

                <header class="mb-4">
                    <h1 class="text-3xl lg:text-4xl font-extrabold text-[#071133] leading-tight">
                        {{ isset($post->title) ? $post->title : (isset($post->slug) ? str_replace('-', ' ', ucfirst($post->slug)) : 'Notícia') }}
                    </h1>

                    <div class="mt-3 text-sm text-gray-500 flex flex-wrap gap-4 items-center">
                        <span>Autor: <strong
                                class="text-gray-700">{{ $post->user_created->login ?? 'Desconhecido' }}</strong></span>
                        <span>•</span>
                        <span>Última modificação: <strong
                                class="text-gray-700">{{ optional($post->updated_at)->format('d/m/Y H:i') ?? '—' }}</strong></span>
                        <span>•</span>
                        <span>Visualizações: <strong
                                class="text-gray-700">{{ number_format($post->hits ?? 0, 0, ',', '.') }}</strong></span>
                        <span class="hidden sm:inline">•</span>
                        <span class="text-gray-400">slug: <code
                                class="bg-gray-100 px-2 py-0.5 rounded">{{ $post->category->name ?? 'sem categoria' }}</code></span>
                    </div>
                </header>

                <div class="flex items-center gap-2">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                        class="share-icon" target="_blank" rel="noopener" aria-label="Compartilhar no Facebook">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($post->title ?? $post->slug) }}"
                        class="share-icon" target="_blank" rel="noopener" aria-label="Compartilhar no Twitter">
                        <i class="fa-brands fa-twitter"></i>
                    </a>
                    <a href="https://wa.me/?text={{ urlencode(($post->title ?? $post->slug) . ' ' . request()->fullUrl()) }}"
                        class="share-icon md:hidden" target="_blank" rel="noopener" aria-label="Compartilhar no WhatsApp">
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>
                </div>
            </div>

        </section>

        {{-- Conteúdo: artigo --}}
        <section class="relative w-full py-10">
            <div
                class="pointer-events-none absolute bottom-0 left-0 w-full h-32 bg-gradient-to-t from-slate-50 to-white z-1">
            </div>

            <div class="relative z-10 max-w-[990px] mx-auto px-4 post-wrapper">

                {{-- Artigo --}}
                <article class="post-article p-7 lg:p-10 post-card">
                    {{-- ATENÇÃO: renderiza HTML — certifique-se que $post->text está sanitizado no backend --}}
                    {!! $post->text !!}
                </article>

                {{-- Ações secundárias (mobile) --}}
                <div class="mt-6 flex items-center justify-between gap-4">
                    <a href="{{ route('novosite.home') }}" class="btn-back md:hidden" aria-label="Voltar às notícias">
                        <i class="fa-solid fa-arrow-left fa-fw"></i>
                        <span>Voltar</span>
                    </a>

                    <div class="flex items-center gap-2">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                            class="share-icon md:hidden" target="_blank" rel="noopener" aria-label="Facebook">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($post->title ?? $post->slug) }}"
                            class="share-icon md:hidden" target="_blank" rel="noopener" aria-label="Twitter">
                            <i class="fa-brands fa-twitter"></i>
                        </a>
                    </div>
                </div>

            </div>
        </section>

        {{-- Seção complementar --}}
        <section class="w-full text-[#1b1b1b] py-14">
            <div class="max-w-[1290px] mx-auto px-4">
                @include('novosite.components.news')
            </div>
        </section>

    </div>
@endsection
