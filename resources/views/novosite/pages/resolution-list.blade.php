@extends('novosite.template.main')

@section('title')
    Ueap | Home
@endsection

@section('content')
    <section class="container mx-auto max-w-4xl px-4 lg:px-8 py-8 text-sm">
        <!-- Search and Filter Form -->
        <form class="w-full mx-auto my-6 bg-white p-4 rounded-lg shadow-md"
            action="{{ route('site.document.resolution.list') }}" method="get">
            <div class="grid grid-cols-1 sm:grid-cols-5 gap-2">
                <!-- Description Input -->
                <div>
                    <input autocomplete="off"
                        class="w-full p-1.5 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="Descrição" type="text" name="name" value="{{ request('name') }}">
                </div>

                <!-- Number Input -->
                <div>
                    <input autocomplete="off"
                        class="w-full p-1.5 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="Número" type="text" name="number" value="{{ request('number') }}">
                </div>

                <!-- Year Input -->
                <div>
                    <input autocomplete="off"
                        class="w-full p-3 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="Ano" type="text" name="year" value="{{ request('year') }}">
                </div>

                <!-- Filter Button -->
                <div>
                    <button
                        class="w-full p-3 bg-blue-600 text-white text-sm rounded-md hover:bg-indigo-700 transition-colors"
                        type="submit">Filtrar</button>
                </div>

                <!-- Clear Filter Button -->
                <div>
                    <a href="{{ route('site.document.resolution.list') }}"
                        class="w-full p-3 bg-gray-400 text-white text-sm rounded-md hover:bg-gray-600 transition-colors text-center block">
                        Limpar
                    </a>
                </div>
            </div>
        </form>


        <!-- Resolutions List -->
        <div id="lista_noticias" class="my-8">
            <!-- Section Title -->
            <div class="text-3xl font-bold text-gray-900 mb-6">
                TODAS AS <span class="text-indigo-600">RESOLUÇÕES</span>
            </div>

            <!-- Resolutions List -->
            <ul class="space-y-4">
                @forelse($resolutions as $resolution)
                    @if (file_exists(public_path('storage/consu/resolutions/' . $resolution->id . '.pdf')))
                        <li>
                            <a target="_blank" title="{{ $resolution->title }}"
                                href="{{ asset('storage/consu/resolutions/' . $resolution->id . '.pdf') }}"
                                class="block p-4 border-b border-gray-200 rounded-lg hover:bg-gray-50 hover:shadow-md transition-all text-justify">
                                <span class="font-bold text-indigo-600">{{ $resolution->number }}/{{ $resolution->year }} -
                                </span>
                                <span class="text-gray-700">{{ $resolution->name }}</span>
                            </a>
                        </li>
                    @else
                        <li>
                            <a title="{{ $resolution->title }}" href="#"
                                class="block p-4 border-b border-gray-200 rounded-lg hover:bg-gray-50 hover:shadow-md transition-all text-justify">
                                <span class="font-bold text-indigo-600">{{ $resolution->number }}/{{ $resolution->year }}
                                    - </span>
                                <span class="text-gray-700">{{ $resolution->name }}</span>
                            </a>
                        </li>
                    @endif
                @empty
                    <li class="text-gray-500 text-center py-6">Nenhuma Resolução encontrada</li>
                @endforelse
            </ul>
        </div>

        <!-- Pagination -->
        <nav class="text-center mt-8">
            {{ $resolutions->links('pagination::tailwind') }}
        </nav>
    </section>
@endsection
