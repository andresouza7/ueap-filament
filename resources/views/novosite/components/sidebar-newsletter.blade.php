<section class="w-full">
    {{-- Título Harmonizado com o Padrão da Sidebar --}}
    <div class="flex items-center gap-3 mb-5">
        <h3 class="text-[11px] font-black uppercase tracking-[0.2em] text-slate-900 whitespace-nowrap">
            Newsletter
        </h3>
        <div class="h-[1px] flex-1 bg-gradient-to-r from-slate-200 to-transparent"></div>
    </div>

    {{-- Conteúdo com Design Profissional --}}
    <div class="flex flex-col border-l-2 border-slate-900 pl-5 py-1">
        <h4 class="text-xl font-extrabold text-slate-900 leading-none tracking-tighter uppercase italic mb-4">
            Fique por <span class="text-emerald-600 not-italic">dentro.</span>
        </h4>
        <p class="text-[12px] text-slate-500 leading-snug mb-6 font-medium italic">
            O resumo essencial do que acontece na UEAP, toda semana.
        </p>

        <form class="flex flex-col gap-2">
            {{-- Input com bordas retas e foco minimalista --}}
            <div class="group relative w-full">
                <input type="email" placeholder="Seu e-mail institucional ou pessoal"
                    class="w-full bg-slate-50 border border-slate-200 rounded-none px-4 py-3 text-sm text-slate-900 
                    placeholder:text-slate-300 focus:outline-none focus:border-slate-900 transition-all duration-300">
            </div>

            {{-- Botão de ação direta --}}
            <button type="submit"
                class="w-full bg-slate-900 text-white py-4 text-[11px] font-black uppercase tracking-[0.2em] 
                rounded-none hover:bg-emerald-600 transition-all duration-500 cursor-pointer shadow-none outline-none">
                Assinar Informativo
            </button>
        </form>
    </div>
</section>