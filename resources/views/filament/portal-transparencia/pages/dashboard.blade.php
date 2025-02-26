<x-filament::page>
    <div>
        <div class="text-center bg-green-700 text-white p-6 mb-4">
            <img src="{{ asset('img/brasao_light.png') }}" alt="Portal da Transparência" class="mx-auto" style="width: 220px;">
            <h1 class="text-2xl font-bold mt-2">Portal da Transparência</h1>
            <h2 class="text-xl mt-1 text-gray-200">Universidade do Estado do Amapá</h2>
        </div>


        <div class="bg-white p-4 shadow-lg mb-4 border">
            <h3 class="text-lg font-bold mb-2">O que você procura?</h3>
            <div class="flex items-center">
                <input type="text" placeholder="Search..." class="flex-grow p-2 border border-gray-300">
                <button class="ml-2 px-4 py-2 bg-green-700 text-white hover:bg-green-500">Buscar</button>
            </div>
        </div>

        <h2 class="text-2xl font-bold mb-2">Destaques</h2>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 text-center">
            <div class="bg-white p-4 shadow-lg flex flex-col justify-between gap-2 text-sm border border-gray-300">
                <div class="flex justify-center">
                    <x-filament::icon icon="heroicon-m-home" class="w-14 text-blue-600" />
                </div>
                <h3 class="text-xl font-bold">Unidades <br> Administrativas</h3>
                <select class="mt-2 p-2 border border-gray-300">
                    <option value="">Select an option</option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                </select>
            </div>
            <div class="bg-white p-4 shadow-lg flex flex-col justify-between gap-2 text-sm border border-gray-300">
                <div class="flex justify-center">
                    <x-filament::icon icon="heroicon-m-arrows-pointing-in" class="w-14 text-red-600" />
                </div>
                <h3 class="text-xl font-bold">Despesas</h3>
                <select class="mt-2 p-2 border border-gray-300">
                    <option value="">Select an option</option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                </select>
            </div>
            <div class="bg-white p-4 shadow-lg flex flex-col justify-between gap-2 text-sm border border-gray-300">
                <div class="flex justify-center">
                    <x-filament::icon icon="heroicon-m-arrows-pointing-out" class="w-14 text-green-600" />
                </div>
                <h3 class="text-xl font-bold">Receitas</h3>
                <select class="mt-2 p-2 border border-gray-300">
                    <option value="">Select an option</option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                </select>
            </div>
            <div class="bg-white p-4 shadow-lg flex flex-col justify-between gap-2 text-sm border border-gray-300">
                <div class="flex justify-center">
                    <x-filament::icon icon="heroicon-m-information-circle" class="w-14 text-cyan-600" />
                </div>
                <h3 class="text-xl font-bold">Convênios e Parcerias</h3>
                <select class="mt-2 p-2 border border-gray-300">
                    <option value="">Select an option</option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                </select>
            </div>
        </div>

        <div class="bg-white p-4 shadow-lg flex flex-col gap-2 text-sm border border-gray-300 mt-4">
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
