@extends('transparency.template.master')

@section('title')
Navegação
@endsection


@section('content')

<div class="container-fluid">

    <div class="row">



        <div class="card">
            {{-- <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Navegação : {{type(request('type'))}}</h4>
                <div class="flex-shrink-0">
                    <div class="form-check form-switch form-switch-right form-switch-md">
                        <a class="btn btn-sm btn-dark" href="{{route('transparency.home')}}"  ><i class="fa fa-mail-reply-all"></i> Voltar</a>
                    </div>
                </div>
            </div><!-- end card header --> --}}

            <div class="card-body">

                <div class="live-preview">
                    <div class="row g-3">

                        @if(request('type'))

                            @forelse(menu_transparency(request('type')) as $item)

                                <div class="col-12 col-md-4 col-xxl-3">
                                    <div class="card ribbon-box border shadow-none mb-lg-0">
                                        <a @if(isset($item['parameter']))  href="{{route($item['route'], $item['parameter'])}}" @else href="{{route($item['route'])}}"  @endif >
                                            <div class="card-body p-3">
                                                <div class="ribbon ribbon-primary round-shape"><i class="{{$item['icon']}}" style="font-size: 14px"></i></div>
                                                <h5 style="font-size: 16px" class="text-end">{{$item['name']}} </h5>

                                                <div class="ribbon-content mt-4  text-end">
                                                        <span class='btn btn-sm btn-primary'>Acessar</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                            @empty

                            @endforelse

                        @endif


                    </div>
                    <!-- end row -->
                </div>


            </div><!-- end card-body -->
        </div>




    </div>
</div>

@endsection
