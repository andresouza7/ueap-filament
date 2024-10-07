<!-- resources/views/home.blade.php -->
@extends('layout')

@section('title', 'Home')

@section('content')
    <div class="container mx-auto">
        @livewire('home-carousel')

        @livewire('home-jumbotron')
    </div>
@endsection
