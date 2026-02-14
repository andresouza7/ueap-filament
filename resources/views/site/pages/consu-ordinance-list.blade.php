@extends('site.template.master')

@section('title')
    Ueap | Home
@endsection

@section('content')
    <form class='form' action="{{ route('old.site.document.consu-ordinance.list') }}" method="get">
        <div class='row m-2'>

            <div class='col-4'>
                <input autocomplete="off" class="form-control busca" placeholder="Assunto / Descrição" type="text"
                    name="name" value="{{ request('name') }}">
            </div>

            <div class='col-2'>
                <input autocomplete="off" class="form-control busca" placeholder="Número" type="text" name="number"
                    value="{{ request('number') }}">
            </div>

            <div class='col-2'>
                <input autocomplete="off" class="form-control busca" placeholder="Ano" type="text" name="year"
                    value="{{ request('year') }}">
            </div>
            <div class='col-2'>
                <button class="form-control btn btn-success" type="submit">Filtrar</button>
            </div>
            <div class='col-2'>
                <a style='color:white !important;' class="form-control btn btn-secondary"
                    href='{{ route('old.site.document.consu-ordinance.list') }}'>Limpar Filtro</a>
            </div>

        </div>
    </form>

    <div id="lista_noticias">
        <div class="titulo">TODAS AS <span>PORTARIAS</span></div>
        <ul>
            @forelse($ordinances as $ordinance)
                @if (file_exists(public_path('storage/documents/ordinances/' . $ordinance->id . '.pdf')))
                    <li><a target='blank' title="{{ $ordinance->title }}"
                            href="{{ asset('storage/documents/ordinances/' . $ordinance->id . '.pdf') }}">
                            <span>{{ $ordinance->number }}/{{ $ordinance->year }} - <b>{{ $ordinance->subject }}</b> -
                            </span>{{ $ordinance->description }}</a>
                    </li>
                @else
                    <li><a title="{{ $ordinance->title }}" href="#">
                            <span>{{ $ordinance->number }}/{{ $ordinance->year }} - <b>{{ $ordinance->subject }}</b> -
                            </span>{{ $ordinance->description }}</a>
                    </li>
                @endif
            @empty
                <li>Nenhuma Portaria encontrada</li>
            @endforelse

        </ul>

    </div>


    <nav style="text-align:center" aria-label="Navegação de página exemplo">
        {{ $ordinances->links() }}
    </nav>

    </section>
@endsection
