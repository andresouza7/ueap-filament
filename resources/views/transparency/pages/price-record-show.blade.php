@extends('transparency.template.master')

@section('title')
Atas de Registro de Preço
@endsection


@section('content')

<div class="container-fluid">
    <div class="row">

        <!-- /.col-md-6 -->
        <div class="col-lg-12">


            <div class="card">
                {{-- <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">@yield('title')</h4>
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                            <a class="btn btn-sm btn-dark" href="{{route('transparency.home')}}"  ><i class="fa fa-mail-reply-all"></i> Voltar</a>
                        </div>
                    </div>
                </div><!-- end card header --> --}}
                <div class="card-body table-responsive p-0">

                    <div class="card-body table-responsive p-2">

                        <div class="card-body pb-0">
                            <div class="row">



                                <div class="col-12 col-sm-12 col-md-12 d-flex align-items-stretch flex-column">
                                    <div class="card d-flex flex-fill pb-1">
                                        <div class="card-header text-muted border-bottom-0 text-right  text-sm pb-1">
                                            <h2 class="lead"><b>ARP nº: </b>  {{$bid->number}} / {{$bid->year}}</b></h2>
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

                                                    <div class="col-12">
                                                        <hr/>



                                                        <table {!!class_table()!!} >
                                                            <thead>
                                                            <tr>
                                                                <th scope="col">Data Publicação</th>
                                                                <th scope="col">Name</th>
                                                                <th scope="col"></th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @forelse ($bid->documents as $document)
                                                                <tr>
                                                                    <td>{{$document->created_at}}</td>
                                                                    <td>{{$document->description}}</td>
                                                                    <td><a class='btn-sm btn-primary' href='{{asset("storage/documentos/bid/".$document->id.".pdf")}}'>Download</a></td>
                                                                </tr>
                                                            @empty
                                                                <tr><td colspan="7" >Nenhum Registro Encontrado</td></tr>
                                                            @endforelse
                                                            </tbody>
                                                        </table>

                                                    </div>

                                                </div>
                                            </div>



                                        </div>
                                    </div>




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
