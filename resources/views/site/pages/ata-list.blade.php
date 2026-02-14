@extends('site.template.master')

@section('title')
    Ueap | ATAS
@endsection

@section('content')
    {{--  <form class='form' action="{{ route('site.consu.ata.list') }}" method="get">
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
                        <a style='color:white !important;' class="form-control btn btn-secondary" href='{{ route('old.site.document.resolution.list') }}'>Limpar Filtro</a>
                    </div>


            </div>
        </form>  --}}

    <div id="lista_noticias">
        <div class="titulo">ATAS {{ request('issuer') }}</div>
        <ul>
            @forelse($atas as $ata)
                @if (file_exists(public_path('storage/documents/atas/' . $ata->id . '.pdf')))
                    <li><a target='blank' title="{{ $ata->title }}"
                            href="{{ asset('storage/documents/atas/' . $ata->id . '.pdf') }}">
                            <span>{{ $ata->issuance_date->format('d/m/Y') }} - </span> {{ $ata->title }}</a>
                    </li>
                @else
                    <li><a title="{{ $ata->title }}" href="#">
                            <span>{{ $ata->issuance_date->format('d/m/Y') }} - </span> {{ $ata->title }}</a>
                    </li>
                @endif
            @empty
                <li>Nenhuma Ata encontrada</li>
            @endforelse

        </ul>

    </div>


    <nav style="text-align:center" aria-label="Navegação de página exemplo">
        {{ $atas->links() }}
    </nav>

    </section>
@endsection
