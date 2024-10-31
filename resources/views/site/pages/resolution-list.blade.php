@extends('site.template.master')

@section('title')
  Ueap |  Home
@endsection

@section('content')
        <form class='form' action="{{ route('site.document.resolution.list') }}" method="get">
            <div class='row m-2'>

                    <div class='col-4'>
                        <input autocomplete="off"  class="form-control busca" placeholder="Descrição" type="text" name="name" value="{{ request('name') }}">
                    </div>

                    <div class='col-2'>
                        <input autocomplete="off"  class="form-control busca" placeholder="Número" type="text" name="number" value="{{ request('number') }}">
                    </div>

                    <div class='col-2'>
                        <input autocomplete="off"  class="form-control busca" placeholder="Ano" type="text" name="year" value="{{ request('year') }}">
                    </div>
                    <div class='col-2'>
                        <button  class="form-control btn btn-success"  type="submit" >Filtrar</button>
                    </div>
                    <div class='col-2'>
                        <a style='color:white !important;' class="form-control btn btn-secondary" href='{{ route('site.document.resolution.list') }}'>Limpar Filtro</a>
                    </div>

            </div>
        </form>

        <div id="lista_noticias">
            <div class="titulo">TODAS AS <span>RESOLUÇÕES</span></div>
            <ul>
                @forelse($resolutions as $resolution)
                    @if(file_exists(public_path("storage/consu/resolutions/".$resolution->id.".pdf")))
                        <li><a target='blank' title="{{$resolution->title}}" href="{{ asset("storage/consu/resolutions/".$resolution->id.".pdf") }}">
                            <span>{{$resolution->number}}/{{$resolution->year}} - </span> {{$resolution->name}}</a>
                        </li>
                    @else
                        <li><a title="{{$resolution->title}}" href="#">
                            <span>{{$resolution->number}}/{{$resolution->year}} - </span> {{$resolution->name}}</a>
                        </li>
                    @endif
                @empty
                    <li>Nenhuma Resolução encontrada</li>
                @endforelse

            </ul>

        </div>


        <nav style="text-align:center" aria-label="Navegação de página exemplo">
            {{$resolutions->links()}}
        </nav>

 </section>
@endsection
