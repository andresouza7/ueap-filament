@extends('transparency.template.master')

@section('title')
Servidores
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

                    <div class="table-responsive">
                        <table {!!class_table()!!} >

                            <tbody>
                            @forelse ($groups as $group)
                                <tr style="background-color: #ddd; font-weight: bold">
                                    <td  colspan="2">{{$group->description}}</td>
                                </tr>

                                @if($group->users->count() > 0)
                                    @foreach ($group->users->where('password','<>','X')->sortBy('login') as $user)
                                        <tr>
                                            <td>{{$user->person->name}}</td>
                                            <td>@if($user->effective_role){{$user->effective_role->description}}@endif</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>

                                        <td style="color:red"> Nenhum Usuário neste Setor</td>
                                    </tr>
                                @endif

                            @empty
                                <tr><td colspan="7" >Nenhum Registro Encontrado</td></tr>
                            @endforelse
                            </tbody>
                        </table>

                    </div>

                </div>

            </div>

            <ul class="m-3 pagination pagination-circle">
                {!!$groups->links()!!}
            </ul>
        </div>
        <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->

@endsection
