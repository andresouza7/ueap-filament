@props([])

<section class="w-full bg-ueap-blue-dark text-white p-6 relative overflow-hidden" aria-labelledby="newsletter-title">

    {{-- Decorativo Sidebar --}}
    <div class="absolute top-0 right-0 w-16 h-16 bg-ueap-green/10 rounded-bl-full pointer-events-none"></div>

    {{-- HEADER --}}
    <div class="mb-6 relative z-10">
        <div class="flex items-center gap-2 mb-2">
            <span class="text-ueap-green font-bold text-[10px] uppercase tracking-[0.3em]">Informativo</span>
        </div>
        <h3 id="newsletter-title" class="text-2xl font-black text-white leading-none tracking-tighter uppercase">
            Newsletter <span class="text-ueap-green">Ueap</span>
        </h3>
    </div>

    <p class="text-white/70 text-xs mb-6 font-normal leading-relaxed relative z-10">
        Receba os destaques semanais da universidade diretamente no seu e-mail.
    </p>

    <form action="{{ route('newsletter.subscribe') }}" method="POST" class="flex flex-col gap-3 relative z-10">
        @csrf
        <div class="relative">
            <input type="email" name="email" required placeholder="Seu e-mail aqui"
                class="w-full bg-white/10 border border-white/20 px-4 py-3 text-white text-xs placeholder:text-white/40 focus:outline-none focus:border-ueap-green focus:bg-white/20 transition-all rounded-none">
        </div>

        <button type="submit"
            class="w-full px-4 py-3 bg-ueap-green text-ueap-blue-dark font-bold uppercase text-[11px] tracking-widest hover:bg-white transition-colors group">
            <span class="flex items-center justify-center gap-2">
                Inscrever-se
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 transition-transform group-hover:translate-x-1"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </span>
        </button>
    </form>

    <p class="mt-4 text-[9px] text-white/30 text-center font-mono relative z-10">
        Respeitamos sua privacidade.
    </p>

</section>
