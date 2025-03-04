<nav class="bg-white dark:bg-gray-900">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-2 lg:p-4">
        {{-- Logo --}}
        <a href="/novo
        " class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('img/nova_logo_black.png') }}" class="h-8" alt="Logo UEAP" />
        </a>

        {{-- Botao de hamburguer e pesquisa --}}
        <div class="flex xl:order-2">
            <button type="button" data-collapse-toggle="navbar-search" aria-controls="navbar-search"
                aria-expanded="false"
                class="xl:hidden text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5 me-1">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
                <span class="sr-only">Search</span>
            </button>
            <div class="relative hidden xl:block">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                    <span class="sr-only">Search icon</span>
                </div>
                <input type="text" id="search-navbar"
                    class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Pesquisar...">
            </div>
            <button data-collapse-toggle="navbar-search" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg xl:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="navbar-search" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
        </div>

        <div class="items-center justify-between hidden w-full xl:flex xl:w-auto xl:order-1" id="navbar-search">
            {{-- Barra de Pesquisa --}}
            <div class="relative mt-3 xl:hidden">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="text" id="search-navbar"
                    class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Pesquisar...">
            </div>

            {{-- Menu Links --}}
            <ul class="flex flex-col mt-4 font-medium xl:flex-row xl:mt-0 xl:space-x-8 rtl:space-x-reverse z-50">
                @php
                    $menu = \App\Models\WebMenu::where('slug', 'topo')->orderBy('position')->first();
                    $items = $menu->items
                        ->where('menu_parent_id', null)
                        ->where('status', 'published')
                        ->sortBy('position');
                @endphp

                @foreach ($items as $item)
                    @if (count($item->sub_itens) > 0)
                        <li>
                            {{-- Unique ID for each dropdown button --}}
                            <button id="mega-menu-dropdown-button-{{ $item->id }}"
                                data-dropdown-toggle="mega-menu-dropdown-{{ $item->id }}"
                                class="flex items-center justify-between w-full py-2 px-3 font-medium text-gray-900 border-b border-gray-100 xl:w-auto hover:bg-gray-50 xl:hover:bg-transparent xl:border-0 xl:hover:text-blue-600 xl:p-0 dark:text-white xl:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-blue-500 xl:dark:hover:bg-transparent dark:border-gray-700">
                                {{ $item->name }} <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>

                            {{-- Unique ID for each dropdown --}}
                            <div id="mega-menu-dropdown-{{ $item->id }}"
                                class="absolute z-30 hidden w-full p-4 xl:p-0 xl:w-fit text-sm bg-white border border-gray-100 rounded-lg shadow-md dark:border-gray-700 dark:bg-gray-700">
                                <div class="p-4 pb-0 text-gray-900 xl:pb-4 dark:text-white">
                                    <ul class="space-y-4"
                                        aria-labelledby="mega-menu-dropdown-button-{{ $item->id }}">
                                        @foreach ($item->sub_itens as $subitem)
                                            <li>
                                                <a href="/novo/{{ $subitem->url }}"
                                                    class="text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500">
                                                    {{ $subitem->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </li>
                    @else
                        <li>
                            <a href="/novo/{{ $item->url }}"
                                class="block py-2 px-3 text-gray-900 border-b border-gray-100 hover:bg-gray-50 xl:hover:bg-transparent xl:border-0 xl:hover:text-blue-700 xl:p-0 dark:text-white xl:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-blue-500 xl:dark:hover:bg-transparent dark:border-gray-700"
                                aria-current="page">{{ $item->name }}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</nav>

{{-- colored divider --}}
<div class="w-full h-1 bg-gradient-to-r from-blue-700 via-green-500 to-yellow-400"></div>