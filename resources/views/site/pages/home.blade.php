@extends('site.template.master')

@section('title')
  Ueap |  Home
@endsection

@section('content')

    <br/>
<link rel="stylesheet" type="text/css" href="{{asset('site_antigo/css/default.css')}}" media="screen" />
<link rel="stylesheet" type="text/css" href="{{asset('site_antigo/css/nivo-slider.css')}}" media="screen" />
<script type="text/javascript" src="{{asset('site_antigo/js/jquery.nivo.slider.js')}}"></script>
<script type="text/javascript">
$(window).load(function() {
$('#slider').nivoSlider({
effect:"fold",
slices:15,
animSpeed:900,
pauseTime:3000,
directionNav:true, //Next & Prev
directionNavHide:true, //Only show on hover
controlNav:true, //1,2,3…
beforeChange: function(){},
afterChange: function(){}
});
});
</script>


<div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
    @php
        $banners = \App\Models\WebBanner::where('web_banner_place_id', 1)->where('status', 'published')->orderByDesc('id')->limit(10)->get();
        $active = true;
        $cont = 1;
    @endphp

    {{--  <div class="carousel-indicators">
        @foreach($banners as $banner)
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="{{ $cont++ }}"  aria-current="true" ></button>
        @endforeach
    </div>  --}}

    <div class="carousel-inner">
        @foreach($banners as $banner)
            <a href='{{ $banner->url }}'>
                <div class="carousel-item @php if($active == true){ echo 'active';}  @endphp">
                    @if(file_exists(public_path("storage/web/banners/".$banner->id.".jpg")))
                        <img src="{{asset("storage/web/banners/".$banner->id.".jpg")}}" class="d-block w-100" alt="{{$banner->title}}">
                        <div class="carousel-caption d-none d-md-block">
                            {{-- <h5>{{$banner->title}}</h5>
                            <p>{{$banner->description}}</p> --}}
                        </div>
                    @endif
                </div>
            </a>
            @php
                $active = false;
            @endphp
        @endforeach
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

    <div class='row m-1'>



        <div class='col-4 col-md-2 icon border p-1'>
            <a href='{{ route('site.document.list', 'calendar') }}'>
                <img class='img-fluid' src='{{asset('site_antigo/img/icone_calendario.png')}}'/>
                <br/>Calendário Acadêmico
            </a>
        </div>
      {{-- <div class='col-4 col-md-2 icon border  p-1'><a href='pagina/legislacao.html'>
        <img class='img-fluid' src='{{asset('site_antigo/img/icone_legislacao.png')}}'/><br/>Legislação <br/>Ueap</a></div>
      <div class='col-4 col-md-2 icon border  p-1'><a href='pagina/instrucoes_normativas.html'>
        <img class='img-fluid' src='{{asset('site_antigo/img/icone_instrucao_normativa.png')}}'/><br/>Instruções Normativas</a></div>
      <div class='col-4 col-md-2 icon border  p-1'><a href='{{ route('site.document.resolution.list') }}'>
        <img class='img-fluid' src='{{asset('site_antigo/img/icone_resolucao.png')}}'/><br/>Resoluções CONSU</a></div>
      <div class='col-4 col-md-2 icon border  p-1'><a href='pagina/prestacao_de_contas.html'>
        <img class='img-fluid  p-1' src='{{asset('site_antigo/img/icone_transparencia.png')}}'/><br/>Prestação de Contas</a></div>
      <div class='col-4 col-md-2 icon border'><a href='{{ route('transparency.bid.list') }}'>
        <img class='img-fluid  p-1' src='{{asset('site_antigo/img/icone_licitacoes.png')}}'/><br/>Licitações</a></div> --}}


    </div>
<script type="text/javascript" src="{{asset('site_antigo/js/slideshow.js')}}"></script>

{{-- provisório --}}
<div id="lista_noticias">
    <div class='titulo'>Resultado Editais 2024 (provisório) </div>
    <ul>
        <li><a href='{{route('site.page.show', "resultado-editais-2024-provisorio-.html")}}'>Editais PROEXT</a></li>
        <li><a href='{{route('site.page.show', "editais-e-arquivos-provis-rios-propesp-2024.html")}}'>Editais PROPESP </a></li>
        <li><a href='{{route('site.page.show', "editais-prograd-2024.html")}}'>Editais PROGRAD </a></li>
        <li><a href='{{route('site.page.show', "processos-seletivos-ueap.html")}}'>Editais DIPS </a></li>
    </ul>
</div>
{{-- provisório --}}

<div id="lista_noticias">
    <div class='titulo'>Últimas Notícias (<a href='{{route('site.post.list')}}'>Ver Todas</a>)</div>
    <ul>


        @foreach($posts as $post)
        <li> <span>{{$post->created_at->format('d/m/Y')}}</span> -
            <a title=" {{$post->title}}" href='{{route('site.post.show', $post->slug)}}'>
                {{$post->title}}
            </a>
        </li>
        @endforeach
    </ul>
</div>


<div id="lista_noticias">
    <div class='titulo'>Eventos</div>
    <ul>
        @foreach($events as $event)
            <li> <span>{{$event->created_at->format('d/m/Y')}}</span> -
                <a title=" {{$event->title}}" href='{{route('site.post.show', $event->slug)}}'>
                    {{$event->title}}
                </a>
            </li>
        @endforeach
    </ul>
</div>

    {{--  <div id="lista_noticias">
        <div class='titulo'>Processos Seletivos (<a target="_blank"  href='http://processoseletivo.ueap.edu.br/'>Ver Todos</a>)</div>

        <style>
            small{
                color:red;
            }

        </style>
        <ul>

            @php
                $posts = \App\Models\WebPost::limit(10)->get();
            @endphp

            @foreach($posts as $post)


                <li><a target='_blank' href='http://processoseletivo.ueap.edu.br/?p=detalhes&cod=400'>
                        <span>Publicação: 07/10/2022 | </span>
                        <span>Nº do Edital: 058/2022</span>
                        <br/>

                        PIBID - VAGAS REMANESCENTES E CADASTRO RESERVA


                    </a></li>

            @endforeach
        </ul>
    </div>  --}}

@endsection
