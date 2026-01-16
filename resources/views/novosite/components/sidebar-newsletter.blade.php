@props([])

<section class="w-full group" aria-labelledby="newsletter-title">
    {{-- HEADER ESTRUTURAL (DNA UEAP) --}}
    <div class="flex items-center gap-3 mb-6">
        <div class="w-10 h-[12px] bg-[#002266]"></div>
        <h3 id="newsletter-title" class="text-[13px] font-[1000] uppercase tracking-[0.4em] text-[#002266]">
            NEWS_<span class="text-[#A4ED4A] italic">LETTER</span>
        </h3>
        <div class="flex-1 h-[2px] bg-[#002266]/10"></div>
    </div>

    {{-- CARD IMPACTO MÁXIMO --}}
    <div class="relative bg-[#A4ED4A] border-[4px] border-[#002266] rounded-[2.5rem] p-8 shadow-[8px_8px_0px_0px_#002266]">
        
        <div class="relative z-10">
            {{-- Título Gigante e Esmagado --}}
            <h4 class="text-4xl font-[1000] text-[#002266] leading-[0.85] tracking-[-0.05em] uppercase italic mb-4">
                FIQUE POR <br> <span class="bg-[#002266] text-[#A4ED4A] px-2 not-italic">DENTRO_</span>
            </h4>
            
            <p class="text-[14px] text-[#002266] leading-tight mb-8 font-[900] uppercase tracking-tighter">
                O resumo essencial do que acontece na UEAP, toda semana no seu e-mail.
            </p>

            <form class="flex flex-col gap-4" aria-label="Inscrição em informativo">
                {{-- Input com borda pesada --}}
                <div class="relative w-full">
                    <input type="email" 
                        id="newsletter_email"
                        name="email"
                        required
                        placeholder="NOME@EXEMPLO.COM"
                        class="w-full bg-white border-[3px] border-[#002266] rounded-2xl px-5 py-4 text-[12px] text-[#002266] 
                        placeholder:text-[#002266]/40 focus:outline-none focus:bg-[#002266] focus:text-[#A4ED4A] transition-all font-[900] uppercase tracking-widest shadow-inner">
                </div>

                {{-- Botão "Soco na Cara" --}}
                <button type="submit"
                    class="relative w-full bg-[#002266] text-[#A4ED4A] py-5 text-[14px] font-[1000] uppercase tracking-[0.3em] 
                    rounded-2xl border-b-[6px] border-[#001133] hover:border-b-0 hover:translate-y-[2px] active:translate-y-[4px] transition-all group/btn">
                    
                    <span class="relative flex items-center justify-center gap-3">
                        INSCREVER_AGORA
                        <div class="w-6 h-6 bg-[#A4ED4A] text-[#002266] rounded-full flex items-center justify-center group-hover:rotate-45 transition-transform">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="4"><path d="M12 4v16m8-8H4"/></svg>
                        </div>
                    </span>
                </button>
            </form>
        </div>

        {{-- Pattern de Fundo (Simulando o grid da imagem) --}}
        <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: radial-gradient(#002266 1px, transparent 0); background-size: 20px 20px;"></div>
    </div>

    {{-- Info de Sistema no Rodapé --}}
    <div class="mt-4 flex justify-between items-center px-2">
        <span class="text-[9px] font-black text-[#002266] uppercase tracking-[0.5em]">SYSTEM_READY</span>
        <div class="flex gap-2">
            <div class="w-3 h-3 bg-[#002266] rotate-45"></div>
            <div class="w-3 h-3 bg-[#A4ED4A] border-2 border-[#002266] rotate-45"></div>
        </div>
    </div>
</section>