@extends('transparency.template.master')

@section('title')
Licitações
@endsection


@section('content')

<div class="container-fluid">
    <div class="row">

        <!-- /.col-md-6 -->
        <div class="col-lg-12">


            <div class="card">
                {{-- <div class="card-header border-0">
                    <div class="card-tools">
                        <a href="#" class="btn btn-tool btn-sm">
                            <i class="fas fa-download"></i>
                        </a>
                        <a href="#" class="btn btn-tool btn-sm">
                            <i class="fas fa-bars"></i>
                        </a>
                    </div>
                </div> --}}
                <div class="card-body table-responsive p-0">

                    <div class="card-body table-responsive p-2">

                        <div class="card-body pb-0">
                            <div class="row">

                                @forelse ($bids as $bid)



                                    <div class="col-12 col-sm-12 col-md-12 d-flex align-items-stretch flex-column">
                                        <div class="card d-flex flex-fill pb-1">
                                            <div class="card-header text-muted border-bottom-0 text-right  text-sm pb-1">
                                                <h2 class="lead"><b>Edital nº: </b>  {{$bid->number}} / {{$bid->year}}</b></h2>
                                            </div>
                                            <div class="card-body mt-1 pt-1">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <p class="mb-1 text-muted text-sm"> <b>Objeto: </b> {{$bid->description}} </p>
                                                        <p class="mb-1 text-muted text-sm"> <b>Publicado em : </b> {{$bid->location}} | {{$bid->link}} </p>
                                                        <p class="mb-1 text-muted text-sm"> <b>Data de Abertura: </b> {{$bid->start_date->format('d/m/Y H:i:s')}} </p>
                                                        @if($bid->end_date <> '')
                                                            <p class="mb-1 text-muted text-sm"> <b>Data de Encerramento: </b> {{$bid->end_date->format('d/m/Y H:i:s')}} </p>
                                                        @endif
                                                        <p class="mb-1 text-muted text-sm"> <b>Observação: </b> {{$bid->observation}} </p>

                                                    </div>

                                                </div>
                                            </div>
                                            <div class="card-footer p-3">
                                                <div class="text-right">
                                                    <a  target="blank" href="{{route('transparency.bid.show', $bid->uuid)}}" class="btn btn-sm btn-primary pull-right">
                                                        <i class="fa fa-download"></i> Ver Arquivos
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>





                                @empty
                                    <div class="col-12 m-2 alert alert-secondary"> Nenhum Registro Encontrado...</div>
                                @endforelse


                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->

@endsection
