@extends('site.template.master')

@section('title')
Ueap | Página
@endsection

@section('content')

<div class="titulo_noticia">
    {{$page->title}}
</div>

@if($page->category)
@role('dinfo|ascom')
<div class="titulo_noticia">
    {{-- <span><a target='_blank' href="{{ route('manager.web.page.update', [$page->category->section->web->slug, $page->uuid]) }}"><i class='fa fa-edit'></i>EDITAR</a></span> --}}
</div>
@endif
@endif

<div id="barra_acao">
    {{-- <!--<a href=""><img src='http://www2.ueap.edu.br/publico/img//icone_reportar_erro.png'> Reportar um Erro</a>-->
           {{-- <a rel="nofollow" href="javascript::void(0);" onclick="window.open('http://www2.ueap.edu.br/impressao/imprimirPagina.php?print=1&amp;cod=1','printWindow','width=900,height=600,location=no,menubar=no,resizable=yes,scrollbars=yes'); return false;">
                <img src="http://www2.ueap.edu.br/publico/img//icone_imprimir.png"> Imprimir
            </a>
            <!--<a href=""><img src='http://www2.ueap.edu.br/publico/img//icone_enviar_por_email.png'> Enviar por Email</a>--> --}}
</div>

<div id="texto" class="p-2">
    @if($page->hasMedia())
    <div class="d-flex justify-content-center">
        <img src="{{ $page->getFirstMediaUrl() }}" class="img-fluid"  alt="{{ $page->title }}">
    </div>
    <hr />
    @endif

    {!! clean_text($page->text) !!}
</div>
<hr />
<div id="data_noticia">Última Modificação em : @if($page->updated_at) {{$page->updated_at->format('d/m/Y H:i:s')}} @else {{$page->created_at->format('d/m/Y H:i:s')}} @endif</div>


@endsection