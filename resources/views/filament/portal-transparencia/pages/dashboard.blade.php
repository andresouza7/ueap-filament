<x-filament::page>
    <div class="container mx-auto mt-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($this->getMenuItems() as $item)
                <x-filament::card>
                    <h5 class="text-lg font-bold">{{ $item['name'] }}</h5>
                    <p class="text-sm">{{ $item['description'] ?? '' }}</p>
                    <a href="{{ $item['url'] ?? '#' }}" class="inline-block px-4 py-2 mt-2 text-white bg-blue-500 rounded hover:bg-blue-700">Acessar</a>
                </x-filament::card>
            @endforeach
        </div>
    </div>

    <div class="container mx-auto mt-4">
        <x-filament::card>
            <div class="flex flex-col gap-2 text-sm">
                <h5 class="text-lg font-bold">PORTAL DE ACESSO A INFORMAÇÃO</h5>
                <p>
                    A Lei nº 12.527, sancionada em 18 de novembro de 2011, pela Presidenta da República, Dilma Roussef, regulamenta o direito constitucional de acesso dos cidadãos às informações públicas e é aplicável aos três Poderes da União, dos Estados, do Distrito Federal e dos Municípios, com vigência depois de decorridos 180 (cento e oitenta) dias da publicação. Sua sanção representa mais um importante passo para a consolidação do regime democrático brasileiro e para o fortalecimento das políticas de transparência pública.
                </p>
                <p>
                    A Lei de Acesso a Informações estabelece que órgãos e entidades públicas devem divulgar, independentemente de solicitações, informações de interesse geral ou coletivo, salvo aquelas cuja confidencialidade esteja prevista no texto legal.
                    <b>Esta é a página de transparência da UEAP</b>.
                </p>
                <p>
                    Esta seção reúne e divulga, de forma espontânea, dados da Universidade Estadual do Amapá (UEAP) que são de interesse coletivo ou geral com o objetivo de facilitar o acesso à informação pública, conforme determina a Lei de Acesso à Informação (Lei 12.527, de 18/11/2011).
                    Navegue nos itens ao lado para obter as informações desejadas.
                </p>

                <h5 class="text-lg font-bold">SERVIÇO DE INFORMAÇÃO AO CIDADÃO - SIC</h5>
                <p>
                    O SIC- Serviço de Informação ao Cidadão no âmbito da UEAP está localizado na SEDE/PROTOCOLO, Campus Universitário 1, Avenida Presidente Vargas,  CEP 69920-900, Macapá-Amapá.
                    <br/>
                    Atendimento de segunda-feira a sexta-feira, no horário das <b>8h às 20h</b>.
                    <br/>
                </p>
            </div>
        </x-filament::card>
    </div>
</x-filament::page>
