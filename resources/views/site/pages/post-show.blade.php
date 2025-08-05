@extends('site.template.master')

@section('title')
    Ueap | Postagem
@endsection

@section('content')
    <div class="titulo_noticia">
        {{ $post->title }}<br>
        <span> {{ $post->resume }}</span>
    </div>

    @if ($post->category)
        @role('dinfo|ascom')
            <div class="titulo_noticia">
                {{-- <span><a target='_blank' href="{{ route('manager.web.post.update', [$post->category->section->web->slug, $post->uuid]) }}"><i class='fa fa-edit'></i>EDITAR</a></span> --}}
            </div>
        @endif
        @endif


        <div id="barra_acao">
            {{--  <!--<a href=""><img src='http://www2.ueap.edu.br/publico/img//icone_reportar_erro.png'> Reportar um Erro</a>-->
            <a rel="nofollow" href="javascript::void(0);" onclick="window.open('http://www2.ueap.edu.br/impressao/imprimirPostagem.php?print=1&amp;cod=1344','printWindow','width=900,height=600,location=no,menubar=no,resizable=yes,scrollbars=yes'); return false;">
                <img src="http://www2.ueap.edu.br/publico/img//icone_imprimir.png"> Imprimir
            </a>
            <!--<a href=""><img src='http://www2.ueap.edu.br/publico/img//icone_enviar_por_email.png'> Enviar por Email</a>-->  --}}
        </div>


        <div id="texto" class='p-2'>
            {{$post->file}}
            <img src="{{ Storage::url($post->file) }}" class="img-fluid">
            @if (file_exists(public_path('storage/web/posts/' . $post->id . '.jpg')))
                <img src="{{ asset('storage/web/posts/' . $post->id . '.jpg') }}" class="img-fluid" alt="{{ $post->image_subtitle }}">

                @if ($post->image_subtitle)
                    <div id="data_noticia">{{ $post->image_subtitle }} </div>
                @endif

                <hr />
            @endif



            {!! clean_text($post->text) !!}

            @if ($post->image_credits)
                <div id="data_noticia">Imagem : {{ $post->image_credits }} </div>
            @endif
        </div>

        <hr />
        <div id="data_noticia">Última Modificação em : @if ($post->updated_at)
                {{ $post->updated_at->format('d/m/Y H:i:s') }}
            @else
                {{ $post->created_at->format('d/m/Y H:i:s') }} @endif
        </div>
    @endsection
