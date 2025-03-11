<!-- Seção de Programas Sociais -->
<section class="relative w-full py-10 lg:py-24">
    <!-- Background Gradient -->
    <div class="absolute inset-0 bg-white z-0"></div>

    <div class="max-w-screen-xl mx-auto px-8 relative z-20">
        <!-- Título, Descrição e Botões -->
        <div class="grid mx-auto lg:gap-8 xl:gap-0 lg:grid-cols-12">
            <!-- Texto e Botões -->
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1 class="w-full mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl">
                    <span class="text-blue-700">Ensino,</span>
                    <span class="text-green-700">Pesquisa</span>
                    <span class="text-gray-800">e</span>
                    <span class="text-yellow-500">Extensão</span>
                </h1>
                <div class="w-full h-0.5 bg-gradient-to-r from-gray-400 to-gray-300"></div>
                <p class="w-full mt-6 lg:mt-4 font-light text-gray-800 md:text-base lg:text-lg">
                    A UEAP promove a integração entre pesquisa, ensino e extensão, oferecendo programas que
                    incentivam a formação acadêmica, a inovação e o desenvolvimento comunitário. Nossas iniciativas
                    garantem acesso equitativo ao conhecimento e oportunidades para todos.
                </p>

                <!-- CTA "Conheça nossos programas" -->
                <h1
                    class="w-full mt-6 lg:mt-16 mb-4 text-xl tracking-tight leading-none md:text-2xl text-gray-700 font-semibold">
                    Conheça nossos programas
                </h1>
            </div>

            <!-- Imagem -->
            <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
                {{-- <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/hero/phone-mockup.png" alt="mockup"> --}}
                <img src="{{ asset('img/programas.png') }}" alt="programas sociais ueap">
            </div>
        </div>

        @php
            $programas = [
                [
                    'titulo' => 'PIBID',
                    'descricao' => 'Programa de Bolsas de Iniciação à Docência.',
                    'url' => '#',
                    'icon' => 'fa-users',
                ],
                [
                    'titulo' => 'PRP',
                    'descricao' => 'Programa de Pesquisa e Inovação.',
                    'url' => '#',
                    'icon' => 'fa-flask',
                ],
                [
                    'titulo' => 'PROACE',
                    'descricao' => 'Programa de Ações Comunitárias e Extensão.',
                    'url' => '#',
                    'icon' => 'fa-hand-holding-heart',
                ],
                [
                    'titulo' => 'PROAPE',
                    'descricao' => 'Programa de Apoio ao Ensino.',
                    'url' => '#',
                    'icon' => 'fa-book-open',
                ],
                [
                    'titulo' => 'PROBICT',
                    'descricao' => 'Programa de Bolsas de Iniciação Científica e Tecnológica.',
                    'url' => '#',
                    'icon' => 'fa-microscope',
                ],
                [
                    'titulo' => 'PROMONITORIA',
                    'descricao' => 'Programa de Monitoria Acadêmica.',
                    'url' => '#',
                    'icon' => 'fa-chalkboard-teacher',
                ],
            ];
        @endphp

        <!-- Grid de Programas Sociais -->
        <div class="lg:pt-14 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
            @foreach ($programas as $programa)
                <a href="{{ $programa['url'] }}"
                    class="flex items-center gap-3 p-4 bg-white rounded-lg shadow-md hover:shadow-lg transition">
                    <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-blue-50">
                        <i class="fas {{ $programa['icon'] }} text-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-blue-800">{{ $programa['titulo'] }}</h3>
                        <p class="text-gray-600 text-sm">{{ $programa['descricao'] }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
