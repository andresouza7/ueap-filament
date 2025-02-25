<x-filament::button style="margin-top: -12px; background: white; color: black;">Entrar com Email
    Institucional</x-filament::button>
<x-filament::button style="margin-top: -12px;" color="danger" icon="heroicon-o-lifebuoy" tag="a"
    href="https://servicedesk.ueap.edu.br/" target="_blank">Suporte DINFO</x-filament::button>

<style>
    body {
        margin: 0;
        padding: 0;
        min-height: 100vh;
        min-height: 100dvh;
        /* dynamic viewport height */
        background: url('/img/login-bg.jpg') no-repeat center center fixed;
        background-size: cover;
        position: relative;
    }

    body::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        /* background: linear-gradient(0deg, rgba(34, 193, 195, 0.3) 0%, rgba(58, 216, 105, 0.6) 50%); */
        z-index: -1;
        /* Ensure the gradient stays below content */
    }

    .fi-simple-main {
        margin: 0;
        width: 450px;
        border-radius: 0;
        padding: 30px;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        background: rgba(0, 0, 0, 0.5);
        /* Semi-transparent background */
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
            position: absolute;
            right: 0;
        }

        /* main:before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: darkcyan;
        border-radius: 12px;
        z-index: -9;
        transform: rotate(7deg);
    } */
    }
</style>
