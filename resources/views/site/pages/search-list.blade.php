@extends('site.template.master')

@section('title')
    Ueap | Busca
@endsection

@section('content')
    <div class="container p-3" id="lista_noticias">
        <h4 class="fw-bold mb-4">Resultados para "{{ $query }}"</h4>

        @forelse ($results as $type => $matches)
            <h5 class="fw-semibold mt-4">{{ $type }}</h5>
            @if ($matches['items']->isEmpty())
                <p class="text-muted">Nenhum resultado encontrado em {{ $type }}.</p>
            @else
                <ul class="list-unstyled">
                    @foreach ($matches['items'] as $item)
                        <li class="d-flex flex-column mb-2">
                            <div class="d-flex justify-content-start align-items-center mb-1 gap-2">
                                <span class="text-muted small">
                                    {{ Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}
                                </span>
                                <span>-</span>
                                <a href="{{ route('old.site.' . $matches['route'] . '.show', $item->slug) }}"
                                    class="text-decoration-none">
                                    {{ $item->title }}
                                </a>
                            </div>
                            <p class="text-muted small mt-2 fst-italic">
                                <!-- Use strip_tags to remove any HTML and just display the plain text -->
                                "{!! trim(clean_text(strip_tags($item->snippet))) !!}..."
                            </p>
                        </li>
                    @endforeach
                </ul>
            @endif
        @empty
            <p class="text-muted">Nenhum resultado encontrado.</p>
        @endforelse
    </div>

    <div class="container p-3">
        <!-- Seção adicional -->
        <div class="mt-5 p-3 border border-light rounded bg-light">
            <h5 class="fw-bold">Não encontrou o que você procura?</h5>
            <p class="mb-2">Caso não tenha encontrado a informação desejada, você pode entrar em contato com um dos
                seguintes setores para obter ajuda:</p>
            <ul class="list-unstyled">
                <li>
                    <strong>Setor de Protocolo:</strong> <a href="mailto:protocolo@ueap.edu.br"
                        class="text-decoration-none">protocolo@ueap.edu.br</a>
                </li>
                <li>
                    <strong>Assessoria de Comunicação:</strong> <a href="mailto:ascom@ueap.edu.br"
                        class="text-decoration-none">ascom@ueap.edu.br</a>
                </li>

                <li>
                    <strong>Gabinete da Reitoria:</strong> <a href="mailto:gab@ueap.edu.br"
                        class="text-decoration-none">gab@ueap.edu.br</a>
                </li>
                <li>
                    <strong>Suporte Técnico de Informática:</strong> <a href="mailto:suporte@ueap.edu.br"
                        class="text-decoration-none">dinfo@ueap.edu.br</a>
                </li>
            </ul>
            <p class="text-muted small">Estamos à disposição para ajudá-lo com quaisquer dúvidas ou problemas.</p>
        </div>
    </div>
@endsection
