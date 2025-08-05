@extends('transparency.template.master')

@section('title')
Organograma
@endsection


@section('content')


<div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">@yield('title')</h4>
                                    <div class="flex-shrink-0">
                                        <div class="form-check form-switch form-switch-right form-switch-md">
                                            <a class="btn btn-sm btn-dark" href="{{route('transparency.home')}}"  ><i class="fa fa-mail-reply-all"></i> Voltar</a>
                                        </div>
                                    </div>
                                </div><!-- end card header -->
                                <div class="card-body">
                                    <div class="row">

                                        @forelse($groups->where('id', 22) as $group)
                                                <span class="mb-3 p-0 parent-title" style='text-align:center'><a href="javascript: void(0);" class="fw-semibold fs-14">CONSELHO SUPERIOR</a></span>
                                                <span class="mb-3 p-0 parent-title" style='text-align:center'><a href="javascript: void(0);" class="fw-semibold fs-14">I</a></span>
                                                <span class="mb-3 p-0 parent-title" style='text-align:center'><a href="javascript: void(0);" class="fw-semibold fs-14">{{ $group->description }}</a></span>

                                                @if($group->sub_groups)

                                                        @foreach($group->sub_groups as $pro_reitoria)

                                                            <div class="col-sm-3">
                                                                <div class="verti-sitemap">
                                                                    <ul class="list-unstyled mb-0">
                                                                        <li class="p-0 parent-title"><a href="javascript: void(0);" class="fw-medium fs-14">{{ $pro_reitoria->description }}</a></li>
                                                                        <li>

                                                                                @if($pro_reitoria->sub_groups)

                                                                                    @foreach($pro_reitoria->sub_groups as $divisao)
                                                                                    <div class="first-list">
                                                                                        <div class="list-wrap">
                                                                                            <a href="javascript: void(0);" class="fw-medium text-primary">{{ $divisao->description }}</a>
                                                                                        </div>

                                                                                         @if($divisao->sub_groups)

                                                                                             @foreach($divisao->sub_groups as $unidade)

                                                                                                    <ul class="second-list list-unstyled">

                                                                                                        <li>
                                                                                                            <a href="javascript: void(0);">{{ $unidade->description }}</a>
                                                                                                            {{--  <ul class="third-list list-unstyled">
                                                                                                                <li><a href="javascript: void(0);">Jack
                                                                                                                        Coates -
                                                                                                                        Member</a></li>
                                                                                                                <li><a href="javascript: void(0);">Owen
                                                                                                                        Jarvis -
                                                                                                                        Member</a></li>
                                                                                                                <li><a href="javascript: void(0);">Ashlee
                                                                                                                        Haney
                                                                                                                        - Member</a></li>
                                                                                                                <li><a href="javascript: void(0);">Archie
                                                                                                                        Cook -
                                                                                                                        Member</a></li>
                                                                                                            </ul>  --}}
                                                                                                        </li>
                                                                                                    </ul>
                                                                                                @endforeach
                                                                                            @endif
                                                                                    </div>

                                                                                    @endforeach
                                                                                @endif

                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>


                                                        @endforeach
                                                        </ul>
                                                    </li>
                                                @endif

                                            @empty
                                            @endforelse



                                        <!--end col-->





                                    </div>
                                    <!--end row-->
                                </div>
                                <!--end card-body-->
                            </div>
                            <!--end card-->
                        </div>
                        <!--end col-->
                    </div>





@endsection
