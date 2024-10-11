<!-- resources/views/posts.blade.php -->
@extends('layout')

@section('title', 'Post Title')

@section('content')
    <div class="flex flex-col md:flex-row w-full gap-4">
        <section class="md:w-2/3 flex flex-col items-center">
            <!-- Post Content -->
            <article class="flex flex-col shadow my-4">
                <!-- Your content here... -->

                <!-- Article Image -->
                {{-- <a href="#" class="hover:opacity-75">
                <img src="https://source.unsplash.com/collection/1346951/1000x500?sig=1">
            </a> --}}

                <div class="bg-white flex flex-col justify-start p-6">
                    <a href="#" class="text-blue-700 text-sm font-bold uppercase pb-4">Technology</a>
                    <a href="#" class="text-3xl font-bold hover:text-gray-700 pb-4">{{ $page->title }}</a>
                    <p href="#" class="text-sm pb-8">
                        By <a href="#" class="font-semibold hover:text-gray-800">David Grzyb</a>, Published on
                        April 25th, 2020
                    </p>
                    <h1 class="text-2xl font-bold pb-3">Introduction</h1>

                    <div class="break-words">{!! str_replace(["\r\n", "\n", "\r"], '', $page->text) !!}</div>
                </div>
            </article>

            <div class="w-full flex py-6">
                <a href="#" class="w-1/2 bg-white shadow hover:shadow-md text-left p-6">
                    <p class="text-lg text-blue-800 font-bold flex items-center"><i class="fas fa-arrow-left pr-1"></i>
                        Anterior</p>
                    <p class="pt-2">Lorem Ipsum Dolor Sit Amet Dolor Sit Amet</p>
                </a>
                <a href="#" class="w-1/2 bg-white shadow hover:shadow-md text-right p-6">
                    <p class="text-lg text-blue-800 font-bold flex items-center justify-end">Próximo <i
                            class="fas fa-arrow-right pl-1"></i></p>
                    <p class="pt-2">Lorem Ipsum Dolor Sit Amet Dolor Sit Amet</p>
                </a>
            </div>
        </section>

        <aside class="md:w-1/3 flex flex-col items-center">
            <!-- Sidebar Content -->
            <div class="w-full bg-white shadow flex flex-col my-4 p-6">
                <p class="text-xl font-semibold pb-5">About Us</p>
                <p class="pb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas mattis est eu odio
                    sagittis tristique. Vestibulum ut finibus leo. In hac habitasse platea dictumst.</p>
                <a href="#"
                    class="w-full bg-blue-800 text-white font-bold text-sm uppercase rounded hover:bg-blue-700 flex items-center justify-center px-2 py-3 mt-4">
                    Get to know us
                </a>
            </div>

            <div class="w-full bg-white shadow flex flex-col my-4 p-6">
                <p class="text-xl font-semibold pb-5">Instagram</p>
                <div class="grid grid-cols-3 gap-3">
                    @for ($i = 0; $i < 9; $i++)
                        <img class="hover:opacity-75" src="https://picsum.photos/200" />
                    @endfor
                </div>
                <a href="#"
                    class="w-full bg-blue-800 text-white font-bold text-sm uppercase rounded hover:bg-blue-700 flex items-center justify-center px-2 py-3 mt-6">
                    <i class="fab fa-instagram mr-2"></i> Follow @dgrzyb
                </a>
            </div>
        </aside>
    </div>
@endsection
