@extends('transparency.template.master')

@section('title')
    Quadro de Detalhamento de Despesas
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-header">
                    <h4>Quadro de Detalhamento de Despesas</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table {!! class_table() !!}>
                            <thead>
                                <tr>
                                    <th scope="col">Ano</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($years as $year)
                                    <tr>
                                        <td>{{ $year }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-primary" href="{{ route('transparency.quadro-despesas.show', $year) }}">
                                                Detalhes
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
