<!DOCTYPE html>
<html lang="pt-br" class="h-full overflow-x-hidden">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Login | Intranet UEAP</title>
    @vite(['resources/css/login.css'])
</head>

<body class="font-sans antialiased h-full overflow-x-hidden bg-[#007263]">

    <main class="flex flex-col lg:flex-row w-full min-h-screen">

        <section class="hidden lg:flex lg:w-3/5 relative bg-[#007263] items-center overflow-hidden">
            <div class="absolute inset-0 bg-black/10 z-10"></div>

            <div class="relative z-30 flex flex-col w-full px-24">

                <div class="flex flex-col items-start border-l border-white/20 pl-12">

                    <h2 class="text-white text-8xl font-bold uppercase tracking-wide leading-none mb-6">
                        Intranet
                    </h2>

                    <p class="text-white/80 font-light text-2xl tracking-wide max-w-lg mb-12">
                        Plataforma unificada de serviços e gestão administrativa.
                    </p>

                    <div class="flex flex-col items-start gap-4 pt-2 w-64">
                        <img src="/img/logo-white.png" alt="UEAP"
                            class="h-8 w-auto grayscale opacity-70 hover:opacity-100 transition-opacity">
                        <div class="flex flex-col">
                            <span class="text-white/40 text-[10px] font-bold uppercase tracking-[0.4em] leading-tight">
                                Universidade do Estado
                            </span>
                            <span class="text-white/40 text-[10px] font-bold uppercase tracking-[0.4em] leading-tight">
                                do Amapá
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="absolute bottom-12 right-24 z-20 flex items-center gap-3 opacity-30">
                <span class="text-white text-[9px] uppercase tracking-[0.6em] font-semibold">
                    UDR • DINFO
                </span>
            </div>
        </section>

        <section
            class="w-full lg:w-2/5 flex flex-col items-center justify-start lg:justify-center bg-[#fcfcfc] relative z-30 min-h-screen p-6 lg:p-8 shadow-2xl">

            <div class="lg:hidden w-[calc(100%+3rem)] -mx-6 -mt-6 mb-8 overflow-hidden relative">
                <div class="absolute inset-0 bg-[#007263]"></div>
                <div class="relative z-10 pt-12 pb-10 px-6 flex items-center justify-center space-x-4">
                    <img src="/img/logo-white.png" alt="UEAP" class="h-10 w-auto">
                    <div class="h-8 w-[1px] bg-white/20"></div>
                    <h2 class="text-white text-lg font-black uppercase tracking-[0.15em]">INTRANET</h2>
                </div>
            </div>

            <div class="w-full max-w-[400px]">
                <div class="mb-6 lg:mb-8 text-center lg:text-left">
                    <h1 class="text-[#007263] text-3xl lg:text-4xl font-black uppercase tracking-tighter">Login</h1>
                    <p class="text-slate-400 font-bold text-[10px] lg:text-xs uppercase tracking-widest mt-1">Acesse sua
                        conta institucional</p>
                </div>

                <form action="{{ route('login') }}" method="POST" class="space-y-4 lg:space-y-5">
                    @csrf
                    <div class="space-y-2">
                        @if ($errors->any())
                            <div
                                class="mb-6 p-4 rounded-2xl bg-red-50/50 border border-red-100 flex items-start space-x-3 animate-in fade-in slide-in-from-top-2 duration-300">
                                <div class="flex-shrink-0 mt-0.5">
                                    <i class="fa-solid fa-circle-exclamation text-red-500 text-sm"></i>
                                </div>

                                <div class="flex-1">
                                    <h3
                                        class="text-[11px] font-black uppercase tracking-wider text-red-700 leading-none mb-1">
                                        Falha na Autenticação
                                    </h3>
                                    <p
                                        class="text-[10px] font-bold text-red-600/80 uppercase tracking-tight leading-snug">
                                        As credenciais informadas são inválidas ou não possuem permissão de acesso.
                                        Verifique seus dados e tente novamente.
                                    </p>
                                </div>
                            </div>
                        @endif

                        <label
                            class="text-[10px] font-black uppercase tracking-[0.2em] text-[#007263]/60 ml-1">Usuário</label>
                        <div class="relative group">
                            <div
                                class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 group-focus-within:text-[#007263]">
                                <i class="fa-solid fa-id-card lg:text-base text-sm"></i>
                            </div>
                            <input type="text" name="login" required
                                class="w-full bg-white border-2 border-slate-200 rounded-2xl py-3 lg:py-4 pl-12 pr-4 text-[#007263] font-bold focus:outline-none focus:border-[#007263] transition-all text-sm lg:text-base"
                                placeholder="Digite seu acesso">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <div class="flex justify-between items-end px-1">
                            <label
                                class="text-[10px] font-black uppercase tracking-[0.2em] text-[#007263]/60">Senha</label>

                        </div>
                        <div class="relative group">
                            <div
                                class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 group-focus-within:text-[#007263]">
                                <i class="fa-solid fa-lock lg:text-base text-sm"></i>
                            </div>
                            <input type="password" name="password" required
                                class="w-full bg-white border-2 border-slate-200 rounded-2xl py-3 lg:py-4 pl-12 pr-4 text-[#007263] font-bold focus:outline-none focus:border-[#007263] transition-all text-sm lg:text-base"
                                placeholder="••••••••">
                        </div>

                        <div class="flex items-center justify-between px-1">
                            <div class="flex items-center space-x-2">
                                <input type="checkbox" id="remember" name="remember"
                                    class="w-4 h-4 accent-[#007263] cursor-pointer">
                                <label for="remember"
                                    class="text-[11px] font-bold text-slate-500 uppercase tracking-tight cursor-pointer">
                                    Lembrar neste dispositivo
                                </label>
                            </div>

                            <a href="{{ route('filament.app.auth.password-reset.request') }}"
                                class="text-[9px] font-black uppercase text-[#007263] hover:underline">
                                Esqueceu sua senha?
                            </a>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-[#007263] text-white font-black uppercase tracking-[0.2em] py-4 lg:py-5 rounded-2xl shadow-lg hover:bg-[#005a4e] active:scale-[0.98] transition-all flex items-center justify-center space-x-3 group text-xs lg:text-base">
                        <span>Entrar no Sistema</span>
                        <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                    </button>

                    <div class="relative py-2 lg:py-4">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-slate-200"></div>
                        </div>
                        <div class="relative flex justify-center text-[10px] uppercase font-black text-slate-400">
                            <span class="bg-[#fcfcfc] px-4">Ou acesse com</span>
                        </div>
                    </div>

                    <a href="{{ url('auth/google') }}"
                        class="w-full bg-white border-2 border-slate-200 text-[#007263] font-black uppercase py-3 lg:py-4 rounded-2xl flex items-center justify-center space-x-3 shadow-sm hover:bg-slate-50 transition-colors text-[10px] lg:text-xs">
                        <img src="https://www.google.com/favicon.ico" class="w-4 h-4" alt="Google">
                        <span>Email Institucional</span>
                    </a>

                    <a href="https://servicedesk.ueap.edu.br/" target="_blank"
                        class="mt-8 lg:mt-12 p-4 lg:p-5 border-2 border-dashed border-slate-200 rounded-3xl flex items-center space-x-4 hover:border-[#007263]/30 hover:bg-white transition-all group">
                        <div
                            class="w-10 h-10 lg:w-12 lg:h-12 shrink-0 rounded-2xl bg-[#007263] flex items-center justify-center text-white group-hover:bg-[#007263] transition-all">
                            <i class="fa-solid fa-headset text-lg lg:text-xl"></i>
                        </div>
                        <div>
                            <p class="text-[10px] lg:text-xs font-black uppercase text-[#007263]">Suporte Técnico</p>
                            <p class="text-[9px] lg:text-[10px] font-bold text-slate-400 uppercase tracking-tighter">
                                Clique aqui para abrir um chamado</p>
                        </div>
                    </a>
                </form>
            </div>
        </section>
    </main>
</body>

</html>
