@props([
    'title' => 'Título da Seção',
    'color' => 'blue',
])

<div class="mb-6">
    
    <div class="relative">
        <!-- Barra colorida arredondada apenas em cima -->
        <div class="absolute top-0 left-0 w-full h-1 rounded-t-full bg-{{ $color }}-500"></div>

        
        <!-- Conteúdo do título -->
        <h2 class="relative text-base font-bold text-gray-800 dark:text-white flex items-center gap-2 pt-3">
            {{ $slot ?? '' }}
            <span>{{ $title }}</span>
        </h2>
        <div class="absolute top-0 left-0 right-0">
                    {{-- v4 style would be the same here --}}
                    <div class="bg-green-600 h-1 w-full rounded-t-md"></div>
                </div>
    </div>
</div>
