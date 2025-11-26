@php
    $menus = \App\Models\WebMenu::where('status', 'published')
        ->whereHas('menu_place', function ($query) {
            $query->where('slug', 'principal');
        })
        ->orderBy('position')
        ->get();
@endphp

@if ($menus->count())
    <div class="bg-white">
        <nav class="hidden lg:flex items-center space-x-6 xl:space-x-8 ">
            <div class="max-w-ueap mx-auto">

            @foreach ($menus as $menu)
                @php
                    $items = $menu
                        ->items()
                        ->whereNull('menu_parent_id')
                        ->where('status', 'published')
                        ->orderBy('position')
                        ->get();
                @endphp

                @if ($items->count())
                    <div class="relative group inline-block">

                        <!-- LABEL DO MENU -->
                        <button
                            class="flex items-center gap-2 text-gray-800 hover:text-ueap-green
                           font-medium transition text-sm py-2 px-1">

                            <span>{{ $menu->name }}</span>
                           
                        </button>

                        <!-- DROPDOWN -->
                        <div
                            class="absolute left-0 top-full -mt-2
                        bg-white shadow-xl rounded-lg border border-gray-200
                        opacity-0 invisible group-hover:opacity-100 group-hover:visible
                        group-hover:translate-y-1 transition-all duration-200 ease-out
                        w-max max-w-[420px] min-w-[220px]
                        py-1 z-[99999] pointer-events-auto">

                            @foreach ($items as $item)
                                <a href="{{ $item->url ?? '#' }}"
                                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-ueap-green
                               text-sm transition truncate border-b border-gray-50 last:border-none">
                                    {{ $item->name }}
                                </a>
                            @endforeach

                        </div>

                    </div>
                @endif
            @endforeach

            </div>

        </nav>
    </div>
@endif
