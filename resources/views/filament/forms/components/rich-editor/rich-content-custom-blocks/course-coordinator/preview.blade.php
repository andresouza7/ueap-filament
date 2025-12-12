<section id="coordenacao-dinamica" class="scroll-mt-24">
    
    {{-- Título da seção --}}
    <h2 class="text-2xl font-bold text-gray-900 mb-4 border-b pb-2 border-gray-200">Coordenação do Curso</h2>

    <div class="bg-gray-50 rounded-xl p-6 border border-gray-100 flex items-start gap-4 shadow-sm">
        
        {{-- Área do Avatar (usando Font Awesome para o ícone padrão) --}}
        <div class="w-16 h-16 bg-gray-200 rounded-full flex-shrink-0 flex items-center justify-center overflow-hidden">
            {{-- Substituindo o SVG por Font Awesome --}}
            <i class="fa-solid fa-user text-3xl text-gray-400"></i>
        </div>

        <div>
            {{-- Nome e Cargo --}}
            <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $name }}</h3>
            <p class="text-ueap-green font-semibold mb-4">Coordenador</p>

            <div class="space-y-2 text-gray-700">
                
                {{-- E-mail --}}
                <div class="flex items-center text-sm">
                    <i class="fa-solid fa-envelope w-4 h-4 mr-2 text-ueap-green"></i>
                    <span class="font-semibold mr-1">E-mail:</span>
                    <a href="mailto:{{ $email }}" class="text-blue-600 hover:text-blue-800 hover:underline">
                        {{ $email }}
                    </a>
                </div>

                {{-- Local --}}
                <div class="flex items-center text-sm">
                    <i class="fa-solid fa-location-dot w-4 h-4 mr-2 text-ueap-green"></i>
                    <span class="font-semibold mr-1">Local:</span>
                    <span>{{ $local }}</span>
                </div>

                {{-- Atendimento --}}
                <div class="flex items-center text-sm">
                    <i class="fa-solid fa-clock w-4 h-4 mr-2 text-ueap-green"></i>
                    <span class="font-semibold mr-1">Atendimento:</span>
                    <span>{{ $hours }}</span>
                </div>

            </div>
        </div>
    </div>
</section>