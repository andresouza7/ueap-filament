@props(['image', 'title', 'date' => null, 'url' => '#'])

<div
    class="relative overflow-hidden rounded-md shadow-lg cursor-pointer group 
           aspect-[16/7] sm:aspect-[4/3] md:aspect-square">
    <!-- Imagem -->
    <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-105"
        style="background-image: url('{{ $image }}');"></div>

    <!-- Overlay -->
    <div
        class="absolute inset-0 bg-primary/80 group-hover:bg-primary/40 transition-all duration-500 flex flex-col justify-end p-4">
        <!-- Título -->
        <h3 class="text-sm md:text-lg font-bold text-white leading-snug">
            <a href="{{ $url }}"
                class="decoration-accent-yellow decoration-[1.5px] underline-offset-[6px] transition-all duration-500 group-hover:underline group-hover:decoration-[2px]">
                {{ $title }}
            </a>
        </h3>

        <!-- Data -->
        @if ($date)
            <span class="text-accent-yellow mt-1 text-xs md:text-sm font-semibold">{{ $date }}</span>
        @endif
    </div>
</div>
