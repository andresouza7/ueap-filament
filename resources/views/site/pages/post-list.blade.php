@extends('site.template.master')

@section('title')
    Ueap | Home
@endsection

@section('content')
    <div id="busca">
        <form name="buscando" action="/postagens/" method="get">
            <input autocomplete="off" required="required" class="busca" placeholder="Buscar em Notícias UEAP..." type="text"
                name="qry" value="{{ $searchString ?? '' }}"><input class="buscar" type="submit" name="buscar"
                value="Buscar">
        </form>
    </div>

    <div id="lista_noticias">
        <div class="titulo">TODAS AS <span>NOTÍCIAS</span></div>
        <ul>
            @forelse($posts as $post)
                <li><a title="{{ $post->title }}"
                        href="{{ route('old.site.post.show', $post->slug) }}"><span>{{ $post->created_at }} -
                        </span>{{ $post->title }}</a><br>
                    <span>{{ $post->resume }}</span>
                </li>
            @empty
                <li>Nenhuma Noticia encontrada
                    @isset($searchString)
                        para o termo <b>{{ $searchString }}</b>
                    @endisset
                </li>
            @endforelse

        </ul>

    </div>


    <nav style="text-align:center" aria-label="Navegação de página exemplo">
        {{ $posts->links() }}
    </nav>

    </section>
@endsection
