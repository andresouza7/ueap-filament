<style>
    .page-wrapper.compact-wrapper .page-body-wrapper header.main-nav .main-navbar .nav-menu {
        height: calc(100vh - 100px);

    }
    .page-wrapper.compact-wrapper .page-body-wrapper header.main-nav .main-navbar .nav-menu > li a {
        padding: 6px 10px;
        color:#000;

    }
    .page-wrapper.compact-wrapper .page-body-wrapper header.main-nav .main-navbar .nav-menu > li span {
        font-weight: 400;
        font-size: 15px !important;
    }

    .page-wrapper.compact-wrapper .page-body-wrapper header.main-nav .sidebar-main-title > div h6{
        font-weight: bold !important;
    }

    .nav-link{
        padding-top:5px !important;
        padding-bottom:5px !important;
    }


    .page-wrapper.compact-wrapper .page-body-wrapper header.main-nav .main-navbar .nav-menu > li .nav-submenu li a {
    padding: 8px 15px !important;
    color: #333 !important;
}

.page-wrapper.compact-wrapper .page-body-wrapper header.main-nav .main-navbar .nav-menu > li .nav-submenu li a:hover {
    color: #fff !important;

}
</style>

<header class="main-nav">

    <nav >
        <div class="main-navbar" >
            <div id="main-nav">
                <ul class="nav-menu custom-scrollbar pt-4" style="display: block;">

                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                    </li>

                    <li class="sidebar-main-title mt-0 mb-2 pt-0 pb-0" >
                        <div class="my-0 mt-2 pt-0 pb-1 ">
                            <h6>Menu</h6>
                        </div>
                    </li>

                    <li>
                        <a class="nav-link menu-title" href="{{ route('transparency.home') }}">
                            <span>Inicio</span>
                        </a>
                    </li>


                    @foreach(menu_transparency() as $menu)


                    <li class="dropdown">
                        <a class="nav-link menu-title" href="javascript:void(0)">
                            <span>{{$menu['name']}}</span>
                            <div class="according-menu"><i class="fa fa-angle-right"></i></div>
                        </a>
                        <ul class="nav-submenu menu-content" style="display: none;">

                            @if(isset($menu['navigation']))
                                @foreach( $menu['navigation'] as $item)
                                    <li class="nav-item">
                                        <a @if(isset($item['parameter']))  href="{{route($item['route'], $item['parameter'])}}" @else href="{{route($item['route'])}}"  @endif class="nav-link" data-key="t-vertical">
                                            {{--  <i class="{{$item['icon']}} nav-icon m-0"></i>   --}}
                                            {{$item['name']}}
                                        </a>
                                    </li>
                                @endforeach
                            @endif

                        </ul>
                    </li>





                        @endforeach







                    @role('urh')

                        <li class="sidebar-main-title mt-0 mb-2 pt-0 pb-0" >
                            <div class="my-0 mt-2 pt-0 pb-1 ">
                                <h6>Recursos Humanos</h6>
                            </div>
                        </li>

                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav" href="{{route('manager.user.list')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                <span>Servidores</span>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav" href="{{route('manager.group.list')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3" y2="6"></line><line x1="3" y1="12" x2="3" y2="12"></line><line x1="3" y1="18" x2="3" y2="18"></line></svg>
                                <span>Setores</span>
                            </a>
                        </li>

                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav" href="{{route('manager.calendar-occurrence.list')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                <span>Ocorrencias Ponto</span>
                            </a>
                        </li>

                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav" href="{{route('manager.calendar-occurrence-user.list')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                <span>Mapa de Ferias</span>
                            </a>
                        </li>

                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav" href="{{route('manager.document-ordinance.list')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                <span>Portarias</span>
                            </a>
                        </li>
                    @endif

                    @role('gab')

                        <li class="sidebar-main-title mt-0 mb-2 pt-0 pb-0" >
                            <div class="my-0 mt-2 pt-0 pb-1 ">
                                <h6>Gabinete</h6>
                            </div>
                        </li>

                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav" href="{{route('manager.document-ordinance.list')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                <span>Portarias</span>
                            </a>
                        </li>
                    @endif


                    @role('usg')

                    <li class="sidebar-main-title mt-0 mb-2 pt-0 pb-0" >
                        <div class="my-0 mt-2 pt-0 pb-1 ">
                                <h6>Patrimonio</h6>
                            </div>
                        </li>

                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav" href="{{route('manager.property.furniture.list')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3" y2="6"></line><line x1="3" y1="12" x2="3" y2="12"></line><line x1="3" y1="18" x2="3" y2="18"></line></svg>
                                <span>Imobiliário</span>
                            </a>
                        </li>

                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav" href="{{route('manager.property.vehicle.list')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3" y2="6"></line><line x1="3" y1="12" x2="3" y2="12"></line><line x1="3" y1="18" x2="3" y2="18"></line></svg>
                                <span>Veiculos</span>
                            </a>
                        </li>

                    @endif


                    @role('dinfo')

                        <li class="sidebar-main-title mt-0 mb-2 pt-0 pb-0" >
                            <div class="my-0 mt-2 pt-0 pb-1 ">
                                <h6>Gerencia</h6>
                            </div>
                        </li>

                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav" href="{{route('manager.commissioned-role.list')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3" y2="6"></line><line x1="3" y1="12" x2="3" y2="12"></line><line x1="3" y1="18" x2="3" y2="18"></line></svg>
                                <span>Cargos Comissionados</span>
                            </a>
                        </li>

                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav" href="{{route('manager.effective-role.list')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3" y2="6"></line><line x1="3" y1="12" x2="3" y2="12"></line><line x1="3" y1="18" x2="3" y2="18"></line></svg>
                                <span>Cargos Efetivos</span>
                            </a>
                        </li>

                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav" href="{{route('manager.web.list')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3" y2="6"></line><line x1="3" y1="12" x2="3" y2="12"></line><line x1="3" y1="18" x2="3" y2="18"></line></svg>
                                <span>Sites</span>
                            </a>
                        </li>

                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav" href="{{route('manager.document.category.list')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3" y2="6"></line><line x1="3" y1="12" x2="3" y2="12"></line><line x1="3" y1="18" x2="3" y2="18"></line></svg>
                                <span>Categorias de Documentos</span>
                            </a>
                        </li>
                    @endif

                </ul>
            </div>

            <div class="right-arrow" id="right-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></div>


        </div>
    </nav>
</header>
