<!-- resources/views/home.blade.php -->
@extends('layout')

@section('title', 'Home')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 w-full">
        <!-- Coluna da esquerda -->
        <div class="md:col-span-2 bg-red-500 flex items-center justify-center">
            @livewire('home-carousel')
        </div>

        <!-- Coluna da direita -->
        <div class="grid grid-rows-2 md:col-span-1">
            <!-- Linha superior da esquerda -->
            <div class="bg-blue-500 flex items-center justify-center">
                Notícia destaque 1
            </div>
            <!-- Linha inferior da esquerda -->
            <div class="bg-green-500 flex items-center justify-center">
                Notícia destaque 2
            </div>
        </div>
    </div>

    @livewire('home-jumbotron')

@endsection
