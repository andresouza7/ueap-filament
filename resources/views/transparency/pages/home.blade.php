@extends('transparency.template.master')

@section('title')
Navegação
@endsection


@section('content')

<div class="container-fluid">

<div class="row">


    <div class="card">
        {{-- <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">Navegação</h4>
            <div class="flex-shrink-0">
                <div class="form-check form-switch form-switch-right form-switch-md">
                </div>
            </div>
        </div><!-- end card header --> --}}

        <div class="card-body">

            <div class="live-preview">
                <div class="row g-3">

                    @foreach(menu_transparency() as $menu)

                        <div class="col-12 col-md-4 col-xxl-3">
                            <div class="card ribbon-box border shadow-none mb-lg-0">
                                <a href="{{route($menu['route'], $menu['parameter'])}}" >
                                    <div class="card-body p-3">
                                        <div class="ribbon ribbon-primary round-shape"><i class="{{$menu['icon']}}" style="font-size: 14px"></i></div>
                                        <h5 style="font-size: 16px" class="text-end">{{$menu['name']}} </h5>

                                        <div class="ribbon-content mt-4  text-end">
                                                <span class='btn btn-sm btn-primary'>Acessar</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        {{--  --}}

                    @endforeach

                </div>
                <!-- end row -->
            </div>


        </div><!-- end card-body -->
    </div>


</div>




    <div class="row">

        <!-- /.col-md-6 -->
        <div class="col-lg-12">


            <div class="card">
                <div class="card-body" style="font-size: 14px;">
                    <h5>PORTAL DE ACESSO A INFORMAÇÃO</h5>
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

                    <h5>SERVIÇO DE INFORMAÇÃO AO CIDADÃO - SIC</h5>
                    <p>
                        O SIC- Serviço de Informação ao Cidadão no âmbito da UEAP está localizado na SEDE/PROTOCOLO, Campus Universitário 1, Avenida Presidente Vargas,  CEP 69920-900, Macapá-Amapá.
                        <br/>
                        Atendimento de segunda-feira a sexta-feira, no horário das <b>8h às 20h</b>.
                        <br/>
                    </p>

                    {{--  <h5>PORTAL DA OUVIDORIA</h5>
                    <p>
                        A Ouvidoria da UEAP está localizada no XXXXXXXXXXXXXXXX, Campus Universitário, XXXXXXXXXXXXX, CEP xxxxxxxxx, Macapá-AP.
                        Atendimento de segunda-feira a sexta-feira, no horário das 8h às 20h.

                        Telefone (96) XXXXXXXXXX

                    </p>  --}}

                </div>
            </div>
        </div>
        <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->

@endsection
