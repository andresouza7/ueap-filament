<x-filament::button 
    tag="a" 
    href="{{ url('auth/google') }}" 
    style="margin-top: -12px;" 
    color="gray"
>
    Entrar com Email Institucional
</x-filament::button>


<div class="relative my-1">
    <div class="flex justify-start text-sm text-gray-100">
        Precisa de ajuda?
    </div>
    <div class="w-full border-t border-gray-300"></div>
</div>

<x-filament::button style="margin-top: -12px;" color="danger" icon="heroicon-o-lifebuoy" tag="a"
    href="https://servicedesk.ueap.edu.br/" target="_blank">
    Suporte DINFO
</x-filament::button>

<style>
    body {
        margin: 0;
        padding: 0;
        min-height: 100vh;
        min-height: 100dvh;
        background: url('/img/bg-login.jpg') no-repeat center center fixed;
        background-size: cover;
        position: relative;
    }

    .fi-simple-main {
        width: 500px !important;
        padding: 30px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        background: rgba(0, 0, 0, 0.5);
    }

    .fi-simple-main span:not(.fi-btn-label),
    .fi-simple-main h1 {
        color: white;
    }

    .fi-logo {
        width: 240px;
        height: 80px !important;
    }

    @media screen and (min-width: 1024px) {
        main {
            height: 100vh;
            height: 100dvh;
            position: absolute;
            right: 0;
            padding: 60px !important;
            border-radius: 0 !important;
        }
    }
</style>
