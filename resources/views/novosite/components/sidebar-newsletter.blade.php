<section class="w-full">
    {{-- Título Harmonizado com o Padrão da Sidebar --}}
    <div class="flex items-center gap-3 mb-5">
        <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-900 whitespace-nowrap">
            Newsletter
        </h3>
        <div class="h-px flex-1 bg-gradient-to-r from-gray-200 to-transparent"></div>
    </div>

    {{-- Conteúdo com Design Profissional --}}
    <div class="flex flex-col border-l-2 border-gray-900 pl-5 py-1">
        <h4 class="text-xl font-bold text-gray-900 leading-none tracking-tighter uppercase mb-2">
            Fique por dentro.
        </h4>
        <p class="text-[12px] text-gray-500 leading-relaxed mb-6 italic">
            A curadoria definitiva das atividades acadêmicas e editais da UEAP, entregue
            semanalmente.
        </p>

        <form class="flex flex-col gap-0">
            {{-- Input com bordas retas e foco minimalista --}}
            <div class="group relative w-full">
                <input type="email" placeholder="Seu e-mail institucional ou pessoal"
                    class="w-full bg-transparent border border-gray-200 rounded-none px-4 py-3 text-sm text-gray-900 
                    placeholder:text-gray-300 focus:outline-none focus:border-gray-900 transition-all duration-300">
            </div>

            {{-- Botão de ação direta --}}
            <button type="submit"
                class="w-full bg-gray-900 text-white py-4 text-[11px] font-black uppercase tracking-[0.2em] 
                rounded-none hover:bg-[#017D49] transition-all duration-500 cursor-pointer shadow-none">
                Assinar Informativo
            </button>
        </form>
    </div>
</section>
