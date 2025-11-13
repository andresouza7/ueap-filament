@props([
    'href' => '#',
    'color' => 'blue',
    'icon' => '',
    'title' => 'Título',
])

<a href="{{ $href }}" class="flex items-center bg-white p-3 rounded-xl shadow hover:shadow-md transition">
    <!-- Ícone: não permite shrink do ícone e mantém centralizado -->
    <div class="flex-shrink-0 p-2 bg-{{ $color }}-100 text-{{ $color }}-600 rounded-lg inline-flex items-center justify-center">
        {!! $icon !!}
    </div>

    <!-- Texto: ocupa o espaço restante, permite wrap (quebrar linha) sem estourar -->
    <span class="ml-3 font-medium text-gray-700 text-sm leading-snug break-words flex-1 min-w-0">
        {{ $title }}
    </span>
</a>
