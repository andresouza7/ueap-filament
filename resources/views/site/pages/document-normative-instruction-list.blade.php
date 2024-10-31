@extends('site.template.master')

@section('title')
  Ueap |  Home
@endsection

@section('content')

        <div id="lista_noticias">
            <div class="titulo">Instruções Normativas: {{ type(request('slug')) }}</div>

            <table {!!class_table()!!} >
                <tbody>
                    @forelse ($instructions as $instruction)
                        <tr>
                            <td>
                                <b>{{$instruction->number}}/{{$instruction->year}}</b> Emitido por {{$instruction->issuer}} em  {{$instruction->issuance_date->format('d \d\e M \d\e Y')}}<br/>
                               <small>{{$instruction->description}}</small>
                            </td>

                            <td>
                                @if(file_exists(public_path("storage/documents/normative_instruction/".$instruction->id.".pdf")))
                                    <a  target='blank' href='{{asset("storage/documents/normative_instruction/".$instruction->id.".pdf")}}'>Baixar</a>
                                @else
                                    <span> - </span>
                                @endif
                            </td>

                        </tr>
                    @empty
                        <tr><td colspan="7" >Nenhum Registro Encontrado</td></tr>
                    @endforelse
                </tbody>
            </table>

            <ul class="m-3 pagination pagination-circle">
                {!!$instructions->links()!!}
            </ul>
        </div>



        {{-- <nav style="text-align:center" aria-label="Navegação de página exemplo">
            {{$instructions->links()}}
        </nav> --}}

 </section>
@endsection
