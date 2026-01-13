<section class="w-full group">
    {{-- Título Harmonizado com o Padrão da Sidebar --}}
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center gap-2">
            <span class="flex h-1.5 w-1.5 bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.5)]"></span>
            <h3 class="text-[11px] font-bold uppercase tracking-[0.2em] text-slate-900">
                Newsletter
            </h3>
        </div>
        <span class="text-[8px] font-mono text-slate-400 uppercase tracking-tighter bg-slate-100 px-1.5 py-0.5 border border-slate-200">SUB_04</span>
    </div>

    {{-- Conteúdo Cyber sem Linha Lateral --}}
    <div class="relative bg-slate-50 border border-slate-200 p-6 overflow-hidden">
        {{-- Detalhes Decorativos de Canto (Glitch/Cyber Style) --}}
        <div class="absolute top-0 right-0 w-8 h-8 bg-slate-200 lg:bg-slate-200/50 [clip-path:polygon(100%_0,0_0,100%_100%)]"></div>
        <div class="absolute bottom-0 left-0 w-2 h-10 bg-emerald-500/20"></div>

        <div class="relative z-10">
            <h4 class="text-xl font-[1000] text-slate-900 leading-none tracking-tighter uppercase italic mb-2">
                Fique por <span class="text-emerald-600 not-italic">dentro.</span>
            </h4>
            
            <div class="flex items-center gap-2 mb-4">
                <span class="text-[9px] font-mono text-slate-400 uppercase tracking-widest leading-none">Status: Ready_to_sync</span>
            </div>

            <p class="text-[12px] text-slate-500 leading-snug mb-6 font-medium italic border-l border-slate-300 pl-3">
                O resumo essencial do que acontece na UEAP, toda semana diretamente no seu e-mail.
            </p>

            <form class="flex flex-col gap-2">
                {{-- Input Estilizado como Data Field --}}
                <div class="relative w-full">
                    <div class="absolute left-3 top-1/2 -translate-y-1/2 text-[10px] text-slate-300 font-mono">@</div>
                    <input type="email" placeholder="USUARIO@UEAP.EDU.BR"
                        class="w-full bg-white border border-slate-200 rounded-none pl-8 pr-4 py-3 text-xs text-slate-900 
                        placeholder:text-slate-300 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500/20 transition-all font-mono">
                </div>

                {{-- Botão de Ação Industrial --}}
                <button type="submit"
                    class="relative w-full bg-slate-900 text-white py-4 text-[11px] font-black uppercase tracking-[0.3em] 
                    rounded-none overflow-hidden transition-all duration-300 hover:bg-slate-800 active:scale-[0.98]">
                    
                    {{-- Efeito de brilho no hover --}}
                    <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover:animate-[shimmer_2s_infinite]"></div>
                    
                    <span class="relative flex items-center justify-center gap-2">
                        Assinar_Informativo
                        <i class="fa-solid fa-arrow-right text-[9px] text-emerald-400"></i>
                    </span>
                </button>
            </form>
        </div>

        {{-- Metadata de rodapé do card --}}
        <div class="mt-4 flex justify-between items-center opacity-40">
            <span class="text-[7px] font-mono text-slate-400 uppercase">Encr_Protocol: v2.0</span>
            <span class="text-[7px] font-mono text-slate-400 uppercase">UEAP_INTEL</span>
        </div>
    </div>
</section>

<style>
@keyframes shimmer {
    100% { transform: translateX(100%); }
}
</style>