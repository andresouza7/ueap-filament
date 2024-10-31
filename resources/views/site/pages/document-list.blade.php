@extends('site.template.master')

@section('title')
  Ueap |  Home
@endsection

@section('content')

        <div id="lista_noticias">
            <div class="titulo">Documentos: {{ type(request('slug')) }}</div>

            <table {!!class_table()!!} >
                {{--  <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Descrição</th>
                        <th scope="col"></th>
                    </tr>
                </thead>  --}}
                <tbody>

                    @forelse ($documents as $document)
                        <tr>
                            <td><b>{{$document->title}}</b><br/>{{$document->description}}</td>
                            <td class='align-center'>
                                @if(file_exists(public_path("storage/documents/general/".$document->id.".pdf")))
                                    <a  class='btn btn-sm btn-success white' target='blank' href='{{asset("storage/documents/general/".$document->id.".pdf")}}'>
                                        <i class='fa fa-search'></i>
                                    </a>
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

        </div>


        <nav style="text-align:center" aria-label="Navegação de página exemplo">
            {{$documents->links()}}
        </nav>

 </section>
@endsection
