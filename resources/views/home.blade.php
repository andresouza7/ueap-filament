<!-- resources/views/home.blade.php -->
@extends('layout')

@section('title', 'Home')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4 bg-white w-full">
        <!-- Coluna da esquerda -->
        <div class="md:col-span-2 flex items-center justify-center rounded-sm">
            @livewire('home-carousel')
        </div>

        <!-- Coluna da direita -->
        <div class="grid grid-rows-2 md:col-span-1 gap-4">
            <!-- News Item 1 -->
            <div class="relative shadow-lg rounded-sm overflow-hidden h-48">
                <img src="https://picsum.photos/200/300" alt="Small News" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-70"></div>
                <div class="absolute bottom-0 left-0 p-4 text-white z-10">
                    <h3 class="text-lg font-semibold mb-2">News Title 1</h3>
                    <p class="text-sm">A brief description of the news content goes here.</p>
                    <a href="#" class="text-green-400 font-bold hover:underline">Saber Mais</a>
                </div>
            </div>
            <!-- News Item 2 -->
            <div class="relative shadow-lg rounded-sm overflow-hidden h-48">
                <img src="https://picsum.photos/200/300" alt="Small News" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-70"></div>
                <div class="absolute bottom-0 left-0 p-4 text-white z-10">
                    <h3 class="text-lg font-semibold mb-2">News Title 2</h3>
                    <p class="text-sm">Another brief description of a news article.</p>
                    <a href="#" class="text-green-400 font-bold hover:underline">Saber Mais</a>
                </div>
            </div>
        </div>
    </div>

    @livewire('home-jumbotron')
@endsection