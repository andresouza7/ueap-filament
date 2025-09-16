@extends('transparency.template.master')

@section('title')
    Detalhamento de Despesas {{ $ano }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header pt-3 pb-0">
                        <h4>Detalhamento de Despesas {{ $ano }}</h4>
                        <div class='setting-list'>
                            <a class="btn btn-secondary" href="{{ route('transparency.quadro-despesas.list') }}"><i
                                    class='fa fa-undo'></i> Voltar</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table {!! class_table() !!}>
                                <thead>
                                    <tr>
                                        <th>Mês</th>
                                        <th>Arquivos</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $meses = [
                                            1 => 'Janeiro',
                                            2 => 'Fevereiro',
                                            3 => 'Março',
                                            4 => 'Abril',
                                            5 => 'Maio',
                                            6 => 'Junho',
                                            7 => 'Julho',
                                            8 => 'Agosto',
                                            9 => 'Setembro',
                                            10 => 'Outubro',
                                            11 => 'Novembro',
                                            12 => 'Dezembro',
                                        ];
                                    @endphp
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $meses[$order->month] ?? $order->month }}</td>
                                            <td>
                                                @if (file_exists(public_path('storage/documents/orcamento/' . $order->id . '.pdf')))
                                                    <a target='blank'
                                                        href='{{ env('TRANSPARENCY_URL') }}/storage/documents/orcamento/{{ $order->id }}.pdf'><i
                                                            class='fa fa-download'></i> Baixar</a>
                                                @else
                                                    <span> - </span>
                                                @endif
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
