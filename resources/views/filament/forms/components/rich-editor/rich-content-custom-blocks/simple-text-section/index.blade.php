{{-- O ID da seção é opcional, mas útil para navegação --}}
<section id="{{ \Illuminate\Support\Str::slug($title) }}" class="scroll-mt-24">
    
    {{-- Título da seção (como na imagem 'print area texto.PNG') --}}
    <h2 class="text-2xl font-bold text-gray-900 mb-4 border-b pb-2 border-gray-200">{{ $title }}</h2>

    {{-- O conteúdo do Rich Editor é renderizado aqui. O Blade escapa o HTML por padrão, 
         então usamos {!! ... !!} para renderizar o HTML gerado pelo Rich Editor. --}}
    <div class="prose max-w-none text-gray-700">
        {!! $content !!}
    </div>
</section>