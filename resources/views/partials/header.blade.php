<!-- resources/views/partials/header.blade.php -->
<!-- Top Bar Nav -->
{{-- <nav class="w-full py-4 bg-blue-800 shadow">
    <div class="w-full container mx-auto flex flex-wrap items-center justify-between">
        <nav>
            <ul class="flex items-center justify-between font-bold text-sm text-white uppercase no-underline">
                <li><a class="hover:text-gray-200 hover:underline px-4" href="#">Shop</a></li>
                <li><a class="hover:text-gray-200 hover:underline px-4" href="#">About</a></li>
            </ul>
        </nav>
        <div class="flex items-center text-lg no-underline text-white pr-6">
            <a class="pl-6" href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a class="pl-6" href="#"><i class="fab fa-twitter"></i></a>
            <a class="pl-6" href="#"><i class="fab fa-linkedin"></i></a>
        </div>
    </div>
</nav> --}}

<!-- Text Header -->
<img src="{{ asset('img/banner-large.jpg') }}" alt="banner ueap" class="mx-auto hidden md:block" />
<img src="{{ asset('img/banner-small.jpg') }}" alt="banner ueap" class="mx-auto md:hidden" />

{{-- <header class="w-full container mx-auto">
    <div class="flex flex-col items-center py-12">
        <a class="font-bold text-gray-800 uppercase hover:text-gray-700 text-5xl" href="#">
            Minimal Blog
        </a>
        <p class="text-lg text-gray-600">Lorem Ipsum Dolor Sit Amet</p>
    </div>
</header> --}}

<!-- Topic Nav -->
<nav class="w-full bg-green-600 text-white" x-data="{ open: false }">
    <div class="block lg:hidden">
        <a href="#"
            class="block lg:hidden text-sm font-bold uppercase text-center flex justify-center items-center"
            @click="open = !open">
            Menu <i :class="open ? 'fa-chevron-down' : 'fa-chevron-up'" class="fas ml-2"></i>
        </a>
    </div>

    <div :class="open ? 'block' : 'hidden'" class="w-full flex-grow lg:flex sm:items-center lg:w-auto">
        <div
            class="w-full container mx-auto flex flex-col lg:flex-row items-center justify-center text-sm font-bold uppercase mt-0 px-6 py-1">

            @php
                $items = \App\Models\WebMenuItem::whereHas('menu', function ($query) {
                    $query->where('slug', 'topo');
                })
                    ->whereNull('menu_parent_id')
                    ->where('status', 'published')
                    ->orderBy('position')
                    ->get();
            @endphp

            @foreach ($items as $item)
                @if ($item->sub_itens->count())
                    <!-- Context Menu Container -->
                    @livewire('dropdown-menu', [
                        'id' => $item->id,
                        'label' => $item->name,
                        'items' => $item->sub_itens->pluck('url', 'name'),
                    ])
                @else
                    <a href="/{{ $item->url }}"
                        class="hover:bg-gray-100 hover:text-black rounded py-2 px-4 mx-2">{{ $item->name }}</a>
                @endif
            @endforeach
        </div>
    </div>
</nav>
