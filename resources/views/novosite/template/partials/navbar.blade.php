{{-- resources/views/partials/navbar.blade.php --}}
<nav class="bg-white border-gray-200 dark:bg-gray-900">
   
    <div class="flex flex-wrap items-center justify-between max-w-screen-xl mx-auto p-4">
        <a href="https://flowbite.com" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('img/nova_logo_black.png') }}" class="h-8" alt="Flowbite Logo" />
        </a>

        <div id="mega-menu" class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1">
            <ul class="flex flex-col mt-4 font-medium md:flex-row md:mt-0 md:space-x-8 rtl:space-x-reverse z-50">
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
                            <button id="mega-menu-dropdown-button-{{ $item->id }}" data-dropdown-toggle="mega-menu-dropdown-{{ $item->id }}"
                                class="flex items-center justify-between w-full py-2 px-3 font-medium text-gray-900 border-b border-gray-100 md:w-auto hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-gray-700">
                                {{ $item->name }} <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>

                            {{-- Unique ID for each dropdown --}}
                            <div id="mega-menu-dropdown-{{ $item->id }}"
                                class="absolute z-10 hidden w-fit text-sm bg-white border border-gray-100 rounded-lg shadow-md dark:border-gray-700 dark:bg-gray-700">
                                <div class="p-4 pb-0 text-gray-900 md:pb-4 dark:text-white">
                                    <ul class="space-y-4" aria-labelledby="mega-menu-dropdown-button-{{ $item->id }}">
                                        @foreach ($item->sub_itens as $subitem)
                                            <li>
                                                <a href="{{ $subitem->url }}"
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
                            <a href="{{ $item->url }}"
                                class="block py-2 px-3 text-gray-900 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-gray-700"
                                aria-current="page">{{ $item->name }}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>

    <div class="w-full h-1 bg-gradient-to-r from-blue-500 to-blue-700"></div>
</nav>