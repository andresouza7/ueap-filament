<!doctype html>
<html lang='pt-br'>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Portal da Universidade do  Estado do Amapá" />
    <meta name="keywords" content="Amapá, Universidade, Notícias, ueap" />
    <meta name="author" content="Universidade do Estado do Amapá" />

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('site_antigo/img/ico.ico') }}">

    <title>Ueap - @yield('title')</title>
    <base href="http:/ueap.edu.br" />
    <meta property="og:url" content="http://ueap.edu.br" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Universidade do Estado do Amapá" />
    <meta property="og:description" content="Universidade do Estado do Amapá" />
    <meta property="og:image" content="http://ueap.edu.br" />
    <meta property="og:image:width" content="600">
    <meta property="og:image:height" content="315">

    <link href="{{ asset('site_antigo/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('site_antigo/css/css.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('site_antigo/fontawesome/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('custom/css/custom-site.css') }}" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="{{ asset('site_antigo/js/jquery.js') }}"></script>
    <script defer src="{{ asset('site_antigo/fontawesome/js/all.min.js') }}"></script> <!--load all styles -->


    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-W08FZJKCRC"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-W08FZJKCRC');
    </script>

    <style>
        .bg-insta {
            background: linear-gradient(to left, #f09433, #e6683c, #dc2743, #cc2366, #bc1888) !important;
        }

        .rotate-icon {
            transition: transform 0.5s ease-in-out;
            transform-origin: center;
        }

        .social:hover .rotate-icon {
            transform: rotate(360deg);
        }

        footer {
            background: #017840;
            color: white;
        }
    </style>
</head>

<body>

    <main class="container p-0">
        {{-- <div class='col-12' id='fonte'>Foto: Floriano Lima</div> --}}
        {{-- media query do banner configurada em public/site_antigo/css/css.css --}}
        <a title="Acessar Portal da Transparência" href='http://transparencia.ap.gov.br/' target="_blank"
            id="botao_transparencia">
            <img style='width:20px' src="{{ asset('site_antigo/img/icone_transparencia.png') }}" />
        </a>

        <header>

            <a title="UNIVERSIDADE DO ESTADO DO AMAPÁ" href="{{ route('site.home') }}">
                <div id='conteudo_topo'
                    style="background: url('{{ asset('site_antigo/img/banner/banner-large.jpg') }}') no-repeat #000 center; background-size: cover;">
                </div>
            </a>

            <nav class="navbar navbar-expand-lg bg-light">
                <div class="container-fluid">
                    <div class="d-flex gap-2">
                        <!-- Toggle button Menu Institucional -->
                        <button class="btn btn-link d-lg-none my-2 flex-1 fw-bold text-decoration-none" 
                            style="color: #007838;" type="button"
                            data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                            aria-expanded="false" aria-controls="navbarSupportedContent">
                            <i class='fa fa-building'></i> Institucional
                        </button>
                    
                        <!-- Toggle Button Menu Lateral / Mapa do Site -->
                        <button class="btn btn-link d-lg-none my-2 flex-1 fw-bold text-decoration-none" 
                            style="color: #007838;" type="button" data-bs-toggle="collapse" data-bs-target="#mobileMenu" aria-expanded="false" aria-controls="mobileMenu">
                            <i class='fa fa-sitemap'></i> Mapa do Site
                        </button>
                    </div>
                    
            
                    <div class="collapse navbar-collapse menu-topo" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            @php
                                $menu_top = \App\Models\WebMenu::where('web_menu_place_id', 5)->first();
                                $menu_top_itens = $menu_top ? 
                                    $menu_top->items->where('menu_parent_id', null)
                                    ->where('status', 'published')
                                    ->sortBy('position') : false;
                            @endphp
            
                            @if ($menu_top_itens)
                                @foreach ($menu_top_itens as $item)
                                    @if ($item->sub_itens->count() > 0)
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" role="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                {{ $item->name }}
                                            </a>
                                            <ul class="dropdown-menu">
                                                @foreach ($item->sub_itens->where('status', 'published') as $sub)
                                                    <li><a class="dropdown-item" href="{{ $sub->url }}">{{ $sub->name }}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @else
                                        <li class="nav-item">
                                            <a class="nav-link active" aria-current="page" href="{{ $item->url }}">{{ $item->name }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        </ul>
            
                        {{-- <form class="d-flex" action="{{ route('site.search') }}" method="GET">
                            <input class="form-control me-2" type="text" name="query" placeholder="O que você procura?"
                                aria-label="Search" value="{{ request('query') }}" />
                            <button class="btn btn-outline-success" type="submit">Buscar</button>
                        </form> --}}
                    </div>
                </div>
            </nav>
            


        </header>

        <main>
            <div class="row m-0 p-0">
                <div class='col-md px-2 m-0'>

                    
                
                    <!-- Collapsible Menu -->
                    <div id="mobileMenu" class="collapse d-lg-block">
                        <div class='section'>
                            @php
                                $menu_lateral = \App\Models\WebMenu::where('web_menu_place_id', 4)->get();
                            @endphp
                
                            @foreach ($menu_lateral as $menu)
                                <div class='titulo'>{{ $menu->name }}</div>
                                <ul class="nav flex-column">
                                    @foreach ($menu->items->where('menu_parent_id', null)->where('status', 'published')->sortBy('position') as $item)
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ $item->url }}"> {{ $item->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endforeach
                        </div>
                    </div>
                
                </div>
                

                <div class='col-md-7 m-0 p-0'>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="p-2">
                        @yield('content')
                    </div>
                </div>

                <div class='col-md px-2 m-0'>

                    @if (isset($page) and $page->web_menu_id > 0)
                        <div class='section'>

                            @php
                                $menu_lateral = \App\Models\WebMenu::where('web_menu_place_id', 6)
                                    ->where('id', $page->web_menu_id)
                                    ->get();
                            @endphp

                            @foreach ($menu_lateral->where('status', 'published') as $menu)
                                <div class='titulo'>Menu</div>
                                <ul class="nav flex-column">
                                    @foreach ($menu->itens->where('menu_parent_id', null)->where('status', 'published')->sortBy('position') as $item)
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ $item->url }}">{{ $item->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endforeach

                        </div>
                    @endif


                    {{-- banner instagram --}}
                    <div class="d-flex align-items-center justify-content-center social bg-insta p-2"
                        style="margin: 15px 10px 5px 8px;">
                        <a title="Acessar Instagram Ueap" target="_blank" href="https://instagram.com/ueap_oficial"
                            class="d-flex align-items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="30px"
                                height="30px" class="rotate-icon">
                                <path fill="white"
                                    d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" />
                            </svg>
                            <p class="mb-0"
                                style="font-family: cursive, Arial, Helvetica, sans-serif !important; color: white; font-weight: bold; font-size: 1.2rem;">
                                Instagram UEAP</p>
                        </a>
                    </div>


                    <div class="row" id="sociais">
                        {{-- <div class="col-12 mx-1">
                                <a style=' text-align:center;' title="Acessar Processo Seletivo"  target="_blank"  href="http://processoseletivo.ueap.edu.br/?p=detalhes&cod=416">
                                    <img src="{{asset('custom/images/concurso_ueap.png')}}"/>
                                </a>
                            </div>

                            <div class="col-12 mx-1">
                                <a style=' text-align:center;' title="Acessar Processo Seletivo"  target="_blank"  href="http://processoseletivo.ueap.edu.br/?p=detalhes&cod=412">
                                    <img src="{{asset('custom/images/ps_ueap.png')}}"/>
                                </a>
                            </div> --}}

                        <div class="col-12 mx-1">
                            <a style="width:100%; text-align:center;" title="Acessar Ambiente Academico"
                                target="_blank" href="https://sigaa.ueap.edu.br/sigaa/">AMBIENTE ACADÊMICO</a>
                        </div>

                        {{-- <div class="col-12 mx-1">
                            <a style="width:100%; text-align:center;" title="Acessar Processos Seletivos Ueap"
                                target="_blank" href="http://processoseletivo.ueap.edu.br">PROCESSOS SELETIVOS</a>
                        </div> --}}

                        <div class="col-12 mx-1">
                            <a style="width:100%; text-align:center;" title="Acessar Intranet Ueap" target="_blank"
                                href="http://intranet.ueap.edu.br">INTRANET</a>
                        </div>

                        <div class="col-12 mx-1">
                            <a style="width:100%; text-align:center;" title="Acessar Portal da Transparência Ueap"
                                target="_blank" href="http://transparencia.ueap.edu.br">PORTAL DA TRANSPARÊNCIA</a>
                        </div>

                        {{-- <div class="col-12 mx-1">
                            <a style="width:100%; text-align:center;" title="Acessar Portal da Estatuinte"
                                target="_blank" href="http://estatuinte.ueap.edu.br">PORTAL DA ESTATUINTE</a>
                        </div> --}}

                    </div>

                    {{-- INICIO banner DIPS --}}
                    <div id="carouselExampleDips" class="carousel carousel-dark slide m-2" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @php
                                $banners_cta = \App\Models\WebBanner::where('status', 'published')
                                    ->whereHas('banner_place', function($query){
                                        $query->where('slug', 'banner_cta');
                                })->get();
                                $isActive = true; // Flag to mark the first item as active
                            @endphp
                            @foreach ($banners_cta as $banner)
                                <div class="carousel-item {{ $isActive ? 'active' : '' }}">
                                    <a href="{{ $banner->url }}">
                                        <img src="{{ $banner->image_url }}" class="d-block w-100" alt="Slide image">
                                    </a>
                                    <div class="carousel-caption d-none d-md-block">
                                        {{-- <h5>{{ $banner->title }}</h5>
                                        <p>{{ $banner->description }}</p> --}}
                                    </div>
                                </div>
                                @php
                                    $isActive = false; // Set to false after the first iteration
                                @endphp
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDips"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDips"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>


                    {{-- FIM banner DIPS --}}

                    <div class="row  p-2">
                        <div class='titulo'>Serviços</div>
                        <ul class='nav'>
                            @php
                                $banners = \App\Models\WebBanner::whereHas('banner_place', function ($query) {
                                    $query->where('slug', 'servicos');
                                })
                                    ->where('status', 'published')
                                    ->get();
                            @endphp
                            @if ($banners)
                                @foreach ($banners as $banner)
                                    @if (file_exists(public_path('storage/web/banners/' . $banner->id . '.jpg')))
                                        <li>
                                            <a href='{{ $banner->url }}' target="_blank">
                                                <img class='img-fluid'
                                                    src="{{ asset('storage/web/banners/' . $banner->id . '.jpg') }}"
                                                    alt="{{ $banner->title }}" />
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            @endif

                        </ul>
                    </div>

                    <div class="row  p-2">
                        <div class='titulo'>Acesse</div>
                        <ul class='nav'>
                            @php
                                $banners = \App\Models\WebBanner::whereHas('banner_place', function ($query) {
                                    $query->where('slug', 'acesse');
                                })
                                    ->where('status', 'published')
                                    ->get();
                            @endphp
                            @if ($banners)
                                @foreach ($banners as $banner)
                                    @if (file_exists(public_path('storage/web/banners/' . $banner->id . '.jpg')))
                                        <li>
                                            <a href='{{ $banner->url }}'>
                                                <img class='img-fluid'
                                                    src="{{ asset('storage/web/banners/' . $banner->id . '.jpg') }}"
                                                    alt="{{ $banner->title }}" />
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            @endif

                        </ul>
                    </div>

                    <div id='banners'>
                        <div class='titulo'>Programas</div>
                        <ul class='nav'>
                            @php
                                $banners = \App\Models\WebBanner::where('web_banner_place_id', 2)->get();

                            @endphp
                            @if ($banners)
                                @foreach ($banners as $banner)
                                    @if (file_exists(public_path('storage/web/banners/' . $banner->id . '.jpg')))
                                        <li>
                                            <a href='{{ $banner->url }}'>
                                                <img class='img-fluid'
                                                    src="{{ asset('storage/web/banners/' . $banner->id . '.jpg') }}"
                                                    alt="{{ $banner->title }}" />
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </main>

        <br />
        <footer>
            {{--  <div>
                     <div class='section'>
                            <div class='titulo' style='color:#fff'>Links Úteis</div>
                         <div style='text-align:center;'>
                            <a target="_blank" href='http://www2.abruem.org.br/'><img src='{{asset('img/logo_abrauem.png')}}' style='border:1px solid #ccc; width:120px;'></a>
                            <a target="_blank" href='http://www.cnpq.br/'><img src='{{asset('img/logo_cnpq.png')}}' style='border:1px solid #ccc; width:120px;'></a>
                            <a target="_blank" href="http://www.capes.gov.br/"><img src='{{asset('img/logo_capes.png')}}' style='border:1px solid #ccc; width:120px;'></a>
                            <a target="_blank" href='http://www.fapeap.ap.gov.br/'><img src='{{asset('img/logo_fapeap.png')}}' style='border:1px solid #ccc; width:120px;'></a>
                            <a target="_blank" href='http://www.iepa.ap.gov.br/'><img src='{{asset('img/logo_iepa.png')}}' style='border:1px solid #ccc; width:120px;'></a>
                            <a target="_blank" href='http://www.ap.gov.br'><img src='{{asset('img/logo_govap.png')}}' style='border:1px solid #ccc; width:120px;'></a>
                            <a target="_blank" href='http://www.setec.ap.gov.br '><img src='{{asset('img/logo_setec.png')}}' style='border:1px solid #ccc; width:120px;'></a>
                        </div>
                    </div>

                </div>  --}}

            <div class="row align-items-center my-4 p-4 gy-4">
                <div class="col d-flex flex-column align-items-start">
                    <img src="{{ asset('site_antigo/img/logo-white.png') }}" alt="Logo UEAP" width="250px"
                        height="auto" class="my-3" style="margin-left: -8px">
                    <p class="h4" style="font-weight: 600">Universidade do Estado do Amapá</p>
                    <div>Av. Presidente Vargas, nº 650, Centro, Macapá – AP | CEP 68.900-070</div>
                    <div>Email: ueap@ueap.edu.br</div>
                </div>
                <div class="col-auto ms-auto">
                    <a href="https://emec.mec.gov.br/emec/consulta-cadastro/detalhamento/d96957f455f6405d14c6542552b0f6eb/NTcwMQ=="
                        target="_blank">
                        <img src="{{ asset('site_antigo/img/banner/banner_mec.png') }}" alt="Cadastro MEC"
                            width="320px" height="auto">
                    </a>
                </div>
            </div>

            <div class='row m-3 text-center'>
                <div class="col-12 col-md campus w-100">
                    <a href="https://maps.app.goo.gl/G3hQ65XPWmK7gdQ56" title="Ver no Mapa" target="_blank">
                        <div class="descricao"><i class='fa fa-building'></i> Campus I</div>
                        <div class="endereco"><i class='fa fa-map-signs'></i> Av. Presidente Vargas, nº 650
                            <br /> Centro | CEP: 68.900-070
                            <br /> Macapá - AP
                        </div>
                    </a>
                </div>

                <div class="col-12 col-md campus w-100">
                    <div class="descricao"><i class='fa fa-building'></i> Território dos Lagos</div>
                    <div class="endereco"><i class='fa fa-map-signs' ></i> Av. Desidério Antônio Coelho, 470
                         Sete Mangueiras | CEP: 68950-000
                         Amapá - AP
                    </div>
                </div>

                <div class="col-12 col-md campus w-100">
                    <a href="https://maps.app.goo.gl/6CTfZ6LCs8EGsNRT6" title="Ver no Mapa" target="_blank">
                        <div class="descricao"><i class='fa fa-building'></i> Setor Administrativo</div>
                        <div class="endereco"><i class='fa fa-map-signs'></i> Rua Tiradentes, 284
                            <br /> Centro | CEP: 68900-098
                            <br /> Macapá - AP
                        </div>
                    </a>
                </div>

                <div class="col-12 col-md campus w-100">
                    <a href="https://maps.app.goo.gl/DYtzkwTXccMss3rN7" title="Ver no Mapa" target="_blank">
                        <div class="descricao"><i class='fa fa-building'></i> Anexo Graziela</div>
                        <div class="endereco"><i class='fa fa-map-signs'></i> Av. Duque de Caxias, 60
                            <br /> Centro | CEP: 68900-071
                            <br /> Macapá - AP
                        </div>
                    </a>
                </div>

                <div class="col-12 col-md campus w-100">
                    <a href="https://maps.app.goo.gl/vqpDBMFg8L19Ln1q8" title="Ver no Mapa" target="_blank">
                        <div class="descricao"><i class='fa fa-building'></i> NTE - Núcleo Tecnol&oacute;gico</div>
                        <div class="endereco"><i class='fa fa-map-signs'></i> Av.: 13 de Setembro, 2081
                            <br /> Buritizal | CEP 68902-865
                            <br /> Macapá - AP

                        </div>

                        <!--<div class="telefone"><img height="10px" src='{{ asset('img/icone_telefone.png') }}'/> (xx) xxxx-xxxx</div>-->
                        <!--<div class="mapa"><span onclick="verMapa('CampusIII')"><img height="10px" src='{{ asset('img/icone_mapa.png') }}'/> Ver Mapa</span></div>-->
                    </a>
                </div>

                <div class="col-12 col-md campus w-100">
                    <a href="https://maps.app.goo.gl/DYtzkwTXccMss3rN7" title="Ver no Mapa" target="_blank">
                        <div class="descricao"><i class='fa fa-building'></i> Campus III</div>
                        <div class="endereco"><i class='fa fa-map-signs'></i> Av. Mendonça Furtado, 212
                            <br /> Centro | CEP: 68900-060
                            <br /> Macapá - AP
                        </div>
                    </a>
                </div>
                
            </div>

            <hr />

            <div class="pb-3 text-center">
                <div>
                    {{ date('Y') }} - Portal Universidade do Estado do Amapá
                </div>

                <div>
                    Desenvolvido pela DINFO/UEAP
                </div>
            </div>

        </footer>
</body>

<script type="text/javascript" src="{{ asset('site_antigo/js/bootstrap.bundle.min.js') }}"></script>

</html>
