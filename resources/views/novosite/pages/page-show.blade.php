@extends('novosite.template.main')

@section('title', 'Página')

@section('content')
    <main class="antialiased">
        <div class="w-full bg-green-800 text-white">
            <div class="mx-auto max-w-screen-xl px-8 py-2">
                <h1 class="text-xl font-medium">/ Páginas</h1>
                <a href="/novo" class="text-sm text-gray-100 mt-2">Voltar ao Início</a>
            </div>
        </div>

        <div class="flex justify-between p-2 lg:p-12 mx-auto max-w-screen-xl">
            <!-- Main Content -->
            <article
                class="mx-auto w-full max-w-4xl px-6 format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
                <header class="mb-4 lg:mb-6 not-format">

                    <!-- Page Title and Drawer Toggle Button -->
                    <div class="flex items-center justify-between">
                        <h1
                            class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">
                            {{ $page->title }}
                        </h1>
                        <!-- Drawer Toggle Button -->
                        <button
                            class="lg:hidden text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                            type="button" data-drawer-target="drawer-example" data-drawer-show="drawer-example"
                            aria-controls="drawer-example">
                            <div class="flex items-center">
                                <span>Menu</span>
                                <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </div>
                        </button>
                    </div>
                </header>

                <!-- Post Image -->
                @if ($page->image_url)
                    <img class="w-full mb-4 lg:mb-6 rounded-lg shadow-sm" src="{{ $page->image_url }}" alt="Post Image">
                @endif

                <!-- Post Content -->
                <div
                    class="text-justify leading-loose text-neutral-600">
                    <div class="record-text">
                        {!! clean_text($page->text) !!}
                    </div>
                </div>
            </article>

            @if (isset($page) and $page->web_menu_id > 0)
                <!-- Vertical Navbar (Hidden on Mobile) -->
                <aside class="hidden lg:block w-64 ml-8 border-l border-gray-200 dark:border-gray-700 pl-8">
                    <nav class="sticky top-16">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 border-b-2 border-green-600">Menu da Página</h2>
                        <ul class="space-y-2">
                            <!-- Menu Links -->
                            @php
                                $menu_lateral = \App\Models\WebMenu::where('web_menu_place_id', 6)
                                    ->where('id', $page->web_menu_id)
                                    ->get();
                            @endphp

                            @foreach ($menu_lateral->where('status', 'published') as $menu)
                                <ul class="nav flex-column font-medium text-sm">
                                    @foreach ($menu->items->where('menu_parent_id', null)->where('status', 'published')->sortBy('position') as $item)
                                        <li>
                                            <a href="/novo/{{ $item->url }}"
                                                class="flex items-center p-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors duration-200">
                                                <span class="ml-3">{{ $item->name }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endforeach
                        </ul>
                    </nav>
                </aside>
            @endif
        </div>

        @if (isset($page) and $page->web_menu_id > 0)
            <!-- Drawer Component -->
            <div id="drawer-example"
                class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-80 dark:bg-gray-800"
                tabindex="-1" aria-labelledby="drawer-label">
                <h5 id="drawer-label"
                    class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400">
                    <svg class="w-4 h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    Menu da Página
                </h5>
                <button type="button" data-drawer-hide="drawer-example" aria-controls="drawer-example"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close menu</span>
                </button>

                <!-- Drawer Content (Menu Links) -->
                <nav>
                    <ul class="space-y-2">
                        @foreach ($menu_lateral->where('status', 'published') as $menu)
                            <ul class="nav flex-column">
                                @foreach ($menu->items->where('menu_parent_id', null)->where('status', 'published')->sortBy('position') as $item)
                                    <li>
                                        <a href="/novo/{{ $item->url }}"
                                            class="flex items-center p-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors duration-200">
                                            <span class="ml-3">{{ $item->name }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endforeach
                    </ul>
                </nav>
            </div>
        @endif
    </main>
@endsection
