@extends('transparency.template.master')

@section('title')
    Dotações Orçamentárias
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header">
                        <h4>Dotações Orçamentárias</h4>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table {!! class_table() !!}>
                                <thead>
                                    <tr>
                                        <th scope="col">Ano</th>
                                        <th scope="col">Valor Executado</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($years as $row)
                                        <tr>
                                            <td>{{ $row->year }}</td>
                                            <td>{{ number_format($row->total, 2, ',', '.') }}</td>
                                            <td>
                                                <a class="btn btn-sm btn-primary"
                                                    href="{{ route('transparency.dotacoes.show', $row->year) }}">
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
