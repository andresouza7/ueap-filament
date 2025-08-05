@extends('transparency.template.master')

@section('title')
 {{ type(request('type')) }}
@endsection


@section('content')

<div class="container-fluid">
    <div class="row">

        <!-- /.col-md-6 -->
        <div class="col-lg-12">


            <div class="card">

                <div class="card-header">
                    <div class="row">
                        <div class="col-6">

                        </div>
                        <div class="col-6 ">

                        </div>
                    </div>

                </div>

                <div class="card-body">

                    <div class="table-responsive">
                        <table {!!class_table()!!} >
                            <thead>
                            <tr>
                                <th scope="col">Ano</th>
                                <th scope="col">Name</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($orders as $order)
                                <tr>
                                    <td>{{$order->year}}</td>
                                    <td>{{$order->title}}</td>
                                    <td><a class='btn-sm btn-primary' href='{{asset("storage/documents/order/".$order->id.".pdf")}}'>Download</a></td>
                                </tr>
                            @empty
                                <tr><td colspan="7" >Nenhum Registro Encontrado</td></tr>
                            @endforelse
                            </tbody>
                        </table>

                        <ul class="m-3 pagination pagination-circle">
                            {!!$orders->links()!!}
                        </ul>
                    </div>

                </div>

            </div>

        </div>
        <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->

@endsection
