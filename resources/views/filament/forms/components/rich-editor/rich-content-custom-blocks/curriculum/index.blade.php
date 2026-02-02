<section id="estrutura-dinamica" class="scroll-mt-24">
    <h2 class="text-2xl font-bold text-gray-900 mb-4 border-b pb-2 border-gray-200">Estrutura Curricular</h2>
    
    <div class="space-y-2">
        @forelse ($semesters as $index => $semester)
            {{-- Usa a tag <details> como no seu modelo --}}
            <details class="group bg-white border border-gray-200 rounded-lg open:border-ueap-green">
                {{-- O cabeçalho é o <summary> --}}
                <summary 
                    class="flex justify-between items-center cursor-pointer p-4 font-medium text-gray-900 group-hover:bg-gray-50 transition-colors"
                >
                    <span>{{ $semester['name'] }}</span>
                    {{-- Ícone de seta com rotação condicional --}}
                     <span class="transition group-open:rotate-180 text-ueap-green flex-shrink-0">
                        <i class="fa-solid fa-chevron-down w-6 h-6"></i> 
                    </span>
                </summary>
                
                {{-- O conteúdo do semestre --}}
                <div class="text-gray-600 p-4 border-t border-gray-100 bg-gray-50/50">
                    <ul class="space-y-2 text-sm">
                        @forelse ($semester['subjects'] ?? [] as $subject)
                            <li class="flex justify-between border-b border-gray-100 last:border-b-0 py-1">
                                <span class="text-gray-800">{{ $subject['name'] }}</span>
                                <span class="font-bold text-gray-400">{{ $subject['hours'] }}</span>
                            </li>
                        @empty
                            <li class="text-gray-500 italic">Nenhuma disciplina cadastrada neste semestre.</li>
                        @endforelse
                    </ul>
                </div>
            </details>
        @empty
            <div class="p-4 border border-gray-200 rounded-lg bg-white">
                <p class="text-gray-500 italic">Nenhuma estrutura curricular cadastrada.</p>
            </div>
        @endforelse
    </div>
</section>