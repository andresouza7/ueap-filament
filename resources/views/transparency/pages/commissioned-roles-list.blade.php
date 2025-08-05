@extends('transparency.template.master')

@section('title')
Cargos Comissionados
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

                    <table {!!class_table()!!} >
                        <thead>
                        <tr>
                            <th scope="col">Cargo</th>
                            <th scope="col">Ocupante</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($commisioned_roles as $commissioned)
                            <tr>


                                <td>{{$commissioned->description}}</td>
                                <td>
                                    @forelse($commissioned->users as $user)
                                        {{$user->person->name}}
                                    @empty
                                        <span style="color:red">Vago</span>
                                    @endforelse

                                </td>

                            </tr>
                        @empty

                        @endforelse

                        </tbody>
                    </table>

                </div>



            </div>
            <ul class="m-3 pagination pagination-circle">
                {!!$commisioned_roles->links()!!}
            </ul>
        </div>
        <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->

@endsection
