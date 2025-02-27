{{-- resources/views/home.blade.php --}}
@extends('site.template.main')

@section('title', 'Home')

@section('content')
    <div class="carousel bg-gray-300 h-64 flex items-center justify-center">
        <p>Carrossel de imagens</p>
    </div>

    <section class="mt-8">
        <h2 class="text-2xl font-bold mb-4">Últimas Notícias</h2>
        <div class="grid md:grid-cols-3 gap-4">
            <div class="bg-white p-4 shadow-md">Notícia 1</div>
            <div class="bg-white p-4 shadow-md">Notícia 2</div>
            <div class="bg-white p-4 shadow-md">Notícia 3</div>
        </div>
    </section>

    <section class="mt-8">
        <h2 class="text-2xl font-bold mb-4">Próximos Eventos</h2>
        <div class="grid md:grid-cols-3 gap-4">
            <div class="bg-white p-4 shadow-md">Evento 1</div>
            <div class="bg-white p-4 shadow-md">Evento 2</div>
            <div class="bg-white p-4 shadow-md">Evento 3</div>
        </div>
    </section>
@endsection