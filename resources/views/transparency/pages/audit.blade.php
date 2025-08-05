@extends('transparency.template.master')

@section('title')
Auditoria
@endsection


@section('content')

<div class="container-fluid">
    <div class="row">

        <!-- /.col-md-6 -->
        <div class="col-lg-12">


            <div class="card">
                <div class="card-header border-0">
                    <div class="card-tools">
                        {{-- <a href="#" class="btn btn-tool btn-sm">
                            <i class="fas fa-download"></i>
                        </a>
                        <a href="#" class="btn btn-tool btn-sm">
                            <i class="fas fa-bars"></i>
                        </a> --}}
                    </div>
                </div>
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
