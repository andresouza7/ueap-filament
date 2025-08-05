@extends('transparency.template.master')

@section('title')
Resoluções CONSU
@endsection


@section('content')

    <div class="container-fluid">
        <div class="row">

            <!-- /.col-md-6 -->
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
                    <div class="card-body table-responsive p-0">
                        <div class="card-body table-responsive p-2">
                            <div class="m-2 alert alert-secondary"> Aguardando Conteúdo...</div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->

@endsection
