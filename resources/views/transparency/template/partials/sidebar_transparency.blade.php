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

                </ul>
            </div>

            <div class="right-arrow" id="right-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></div>


        </div>
    </nav>
</header>
