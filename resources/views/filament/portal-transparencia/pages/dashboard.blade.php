<x-filament::page>
    <div class="space-y-8">
        {{-- BANNER TOPO --}}
        <div class="relative bg-green-700 text-white p-8 mb-8 rounded-lg shadow-lg">
            <div class="flex justify-between">
                <img src="{{ asset('img/brasao_light.png') }}" alt="Portal da Transparência" class="mb-4 w-32 sm:w-40 md:w-48">
                <img src="{{ asset('img/logo_gea.png') }}" alt="Portal da Transparência" class="mb-4 w-28 sm:w-36 md:w-44">
            </div>
            <h1 class="text-3xl font-bold">Portal da Transparência</h1>
            <h2 class="text-xl mt-2 text-gray-200">Universidade do Estado do Amapá</h2>
            <div class="absolute bottom-0 left-0 right-0 h-2 bg-gradient-to-r from-green-500 to-green-700"></div>
        </div>

        {{-- BARRA DE PESQUISA --}}
        <div class="bg-white p-6 shadow-lg rounded-lg border border-gray-200">
            <h3 class="text-lg font-bold mb-4">O que você procura?</h3>
            @livewire(Filament\Livewire\GlobalSearch::class)
            <div class="flex items-center space-x-4">
                <input type="text" placeholder="Search..." class="flex-grow p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                <button class="px-6 py-3 bg-green-700 text-white rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">Buscar</button>
            </div>
        </div>

        {{-- SEÇÃO DE DESTAQUES --}}
        <div>
            <h2 class="text-2xl font-bold mb-2">Destaques</h2>
            <div class="h-1 bg-gradient-to-r from-green-500 to-green-700"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white p-6 text-center shadow-lg rounded-lg flex flex-col justify-between gap-2 border border-gray-200">
                <x-filament::icon icon="heroicon-m-home" class="w-14 mx-auto text-blue-600" />
                <h3 class="text-xl font-bold">Institucional</h3>
                <select class="border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-200">
                    <option value="">Selecione</option>
                    <option value="1">Links Institucionais</option>
                    <option value="2">Organograma da UEAP</option>
                    <option value="2">Legislação</option>
                </select>
            </div>
            <div class="bg-white p-6 text-center shadow-lg rounded-lg flex flex-col justify-between gap-2 border border-gray-200">
                <x-filament::icon icon="heroicon-m-users" class="w-14 mx-auto text-yellow-500" />
                <h3 class="text-xl font-bold">Pessoal</h3>
                <select class="border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-200">
                    <option value="">Selecione</option>
                    <option value="1">Servidores</option>
                    <option value="2">Cargos e Funções</option>
                    <option value="2">Folha de Pagamento</option>
                </select>
            </div>
            <div class="bg-white p-6 text-center shadow-lg rounded-lg flex flex-col justify-between gap-2 border border-gray-200">
                <x-filament::icon icon="heroicon-m-document-chart-bar" class="w-14 mx-auto text-green-600" />
                <h3 class="text-xl font-bold">Relatórios</h3>
                <select class="border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-200">
                    <option value="">Selecione</option>
                    <option value="1">Relatórios Anuais de Gestão</option>
                    <option value="2">Relatórios Anuais - PROPLAD</option>
                    <option value="2">Relatórios Anuais - PROGRAD</option>
                    <option value="2">Relatórios Anuais - PROEXT</option>
                    <option value="2">Relatórios Anuais - PROPESP</option>
                    <option value="2">Relatórios de Finanças</option>
                    <option value="2">Relação de Pagamento</option>
                </select>
            </div>
            <div class="bg-white p-6 text-center shadow-lg rounded-lg flex flex-col justify-between gap-2 border border-gray-200">
                <x-filament::icon icon="heroicon-m-information-circle" class="w-14 mx-auto text-cyan-600" />
                <h3 class="text-xl font-bold">Convênios e Parcerias</h3>
                <select class="border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-200">
                    <option value="">Selecione</option>
                    <option value="1">Convênios para Pesquisa</option>
                    <option value="2">Convênios para Pós-Graduação</option>
                    <option value="2">Acordos de Cooperação Técnica - PROEXT/UEAP</option>
                </select>
            </div>
        </div>

        {{-- SEÇÃO OUTRAS INFORMAÇÕES --}}
        <div>
            <h2 class="text-2xl font-bold mb-2">Outras Informações</h2>
            <div class="h-1 bg-gradient-to-r from-green-500 to-green-700"></div>
        </div>


        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="bg-white p-6 text-center shadow-lg rounded-lg flex flex-col justify-between gap-2 border border-gray-200">
                <x-filament::icon icon="heroicon-m-envelope" class="w-14 mx-auto text-gray-500" />
                <h3 class="text-xl font-bold">Carta de Serviços</h3>
                <a class="py-2 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-200 text-gray-700" target="_blank" href="https://cartaservico.portal.ap.gov.br/carta-de-servico-publica/orgao/46/servicos">
                    Acesse
                </a>
            </div>
            <div class="bg-white p-6 text-center shadow-lg rounded-lg flex flex-col justify-between gap-2 border border-gray-200">
                <x-filament::icon icon="heroicon-m-list-bullet" class="w-14 mx-auto text-gray-500" />
                <h3 class="text-xl font-bold">Planejamento e Orçamento</h3>
                <select class="border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-200">
                    <option value="">Selecione</option>
                    <option value="1">Orçamento</option>
                    <option value="2">Despesas</option>
                    <option value="2">Quadro de Despesas</option>
                    <option value="2">Demonstrações Contábeis</option>
                    <option value="2">Relação de Pagamento</option>
                    <option value="2">Restos a pagar processados e não processados</option>
                </select>
            </div>
            <div class="bg-white p-6 text-center shadow-lg rounded-lg flex flex-col justify-between gap-2 border border-gray-200">
                <x-filament::icon icon="heroicon-m-scale" class="w-14 mx-auto text-gray-500" />
                <h3 class="text-xl font-bold">Licitações e Contratos</h3>
                <select class="border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-200">
                    <option value="">Selecione</option>
                    <option value="1">Contratos</option>
                    <option value="2">Licitações</option>
                    <option value="2">Atas de Registro de Preço</option>
                </select>
            </div>
        </div>

        {{-- BANNER INFORMATIVO RODAPE --}}
        <div class="bg-white p-6 shadow-lg rounded-lg border border-gray-200 mt-8 text-justify flex flex-col gap-2">
            <h5 class="text-lg font-bold">PORTAL DE ACESSO A INFORMAÇÃO</h5>
            <p>
                A Lei nº 12.527, sancionada em 18 de novembro de 2011, pela Presidenta da República, Dilma Roussef,
                regulamenta o direito constitucional de acesso dos cidadãos às informações públicas e é aplicável
                aos três Poderes da União, dos Estados, do Distrito Federal e dos Municípios, com vigência depois de
                decorridos 180 (cento e oitenta) dias da publicação. Sua sanção representa mais um importante passo
                para a consolidação do regime democrático brasileiro e para o fortalecimento das políticas de
                transparência pública.
            </p>
            <p>
                A Lei de Acesso a Informações estabelece que órgãos e entidades públicas devem divulgar,
                independentemente de solicitações, informações de interesse geral ou coletivo, salvo aquelas cuja
                confidencialidade esteja prevista no texto legal.
                <b>Esta é a página de transparência da UEAP</b>.
            </p>
            <p>
                Esta seção reúne e divulga, de forma espontânea, dados da Universidade Estadual do Amapá (UEAP) que
                são de interesse coletivo ou geral com o objetivo de facilitar o acesso à informação pública,
                conforme determina a Lei de Acesso à Informação (Lei 12.527, de 18/11/2011).
                Navegue nos itens ao lado para obter as informações desejadas.
            </p>

            <h5 class="text-lg font-bold">SERVIÇO DE INFORMAÇÃO AO CIDADÃO - SIC</h5>
            <p>
                O SIC- Serviço de Informação ao Cidadão no âmbito da UEAP está localizado na SEDE/PROTOCOLO, Campus
                Universitário 1, Avenida Presidente Vargas, CEP 69920-900, Macapá-Amapá.
                <br />
                Atendimento de segunda-feira a sexta-feira, no horário das <b>8h às 20h</b>.
                <br />
            </p>
        </div>
    </div>
</x-filament::page>
