<?php

namespace App\Filament\PortalTransparencia\Pages;

use Filament\Pages\Page;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $title = '';
    protected static ?string $navigationLabel = 'Início';

    protected static string $view = 'filament.portal-transparencia.pages.dashboard';

    public function getMenuItems(): array
    {
        return menu_transparency();
    }
}


function menu_transparency($type = false){

    $array = array(
        // array("name" => "Inicio",                               "parameter" => "home",              "icon" => "fa fa-file",             "route" => "transparency.home"),

        array("name" => "Institucional",    "parameter" => "institucional", "icon" => "fa fa-folder-open",    "route" => "transparency.navigation",
                "navigation" => array(
                    // array("name" => "Institucional",    "icon" => "fa fa-file",                                     "route" => "transparency.institutional"),
                    array("name" => "Legislação",       "icon" => "fa fa-file",   "parameter" => "legislation",     "route" => "transparency.document.list"),
                    array("name" => "Organograma",      "icon" => "fa fa-file",                                     "route" => "transparency.organization"),
                    array("name" => "Servidores",       "icon" => "fa fa-file",                                     "route" => "transparency.effective-role.list"),
                    array("name" => "Cargos",           "icon" => "fa fa-file",                                     "route" => "transparency.commissioned-role.list"),
                )
        ),

        array("name" => "Execução Orçamentária e Finanças",  "parameter" => "finance", "icon" => "fa fa-folder-open",    "route" => "transparency.navigation",
            "navigation" => array(
                array("name" => "Orçamento",                "icon" => "fa fa-file", "parameter" => "income",                    "route" => "transparency.order.list"),
                array("name" => "Despesas",                 "icon" => "fa fa-file", "parameter" => "expense",                   "route" => "transparency.order.list"),
                array("name" => "Quadro Despesas",          "icon" => "fa fa-file", "parameter" => "expense_details",           "route" => "transparency.order.list"),
                array("name" => "Demonstrações contábeis",  "icon" => "fa fa-file", "parameter" => "demonstracoes-contabeis",   "route" => "transparency.document.list"),
                array("name" => "Relação de Pagamentos",    "icon" => "fa fa-file", "parameter" => "relacao-pagamento",         "route" => "transparency.document.list"),
                array("name" => "Folha de Pagamento",       "icon" => "fa fa-file",                                             "route" => "transparency.payroll.list"),

                array("name" => "Restos a Pagar",       "icon" => "fa fa-file", "parameter" => "restos-a-pagar",                "route" => "transparency.document.list"),

            )
        ),

        // array("name" => "Conselho Superior Universitário",   "parameter" => "consu",             "icon" => "fa fa-folder-open",    "route" => "transparency.navigation",
        //     "navigation" => array(
        //         array("name" => "Resoluções",   "icon" => "fa fa-file",     "route" => "site.consu.resolution.list"),
        //         // array("name" => "Atas",         "icon" => "fa fa-file",     "route" => "site.consu.ata.list")
        //     )
        // ),


        array("name" => "Licitações",   "parameter" => "licitacao",         "icon" => "fa fa-folder-open",    "route" => "transparency.navigation",
            "navigation" => array(
                array("name" => "Licitações",               "icon" => "fa fa-file",     "route" => "transparency.bid.list"),
                array("name" => "Ata de Registro de Preço", "icon" => "fa fa-file",     "route" => "transparency.price-record.list"),
            )
        ),

        array("name" => "Contratos",   "parameter" => "contratos    ",         "icon" => "fa fa-folder-open",    "route" => "transparency.navigation",
            "navigation" => array(
                array("name" => "Contratos Pessoa Física",     "icon" => "fa fa-file",     "parameter" => "fisica", "route" => "transparency.contract.list"),
                array("name" => "Contratos Pessoa Jurídica",   "icon" => "fa fa-file",     "parameter" => "juridica", "route" => "transparency.contract.list"),

            )
        ),

        array("name" => "Convênios",   "parameter" => "convenios",         "icon" => "fa fa-folder-open",    "route" => "transparency.navigation",
            "navigation" => array(
                array("name" => "Acordos de Cooperação Técnica PROEXT",     "icon" => "fa fa-file",   "parameter" => "convenio-extensao",     "route" => "transparency.document.list"),
                array("name" => "Convênios p/ Pesquisa",                    "icon" => "fa fa-file",   "parameter" => "convenio-pesquisa",     "route" => "transparency.document.list"),
                array("name" => "Convênios p/ Pós-Graduação",               "icon" => "fa fa-file",   "parameter" => "convenio-pos-graduacao",     "route" => "transparency.document.list"),
            )
        ),

        // array("name" => "PATRIMÔNIO",                       "parameter" => "patrimonio",        "icon" => "fa fa-folder-open",    "route" => "transparency.navigation",
        //     "navigation" => array(
        //         array("name" => "Listagem",         "icon" => "fa fa-file",     "route" => "transparency.expense.list"),
        //     )
        // ),

        // array("name" => "AUDITORIA",                        "parameter" => "auditoria",         "icon" => "fa fa-folder-open",    "route" => "transparency.navigation",
        //     "navigation" => array(

        //         array("name" => "Auditoria",            "icon" => "fa fa-file",     "route" => "transparency.audit.list"),
        //     )
        // ),
        // array("name" => "OUVIDORIA",                        "parameter" => "ouvidoria",         "icon" => "fa fa-folder-open",    "route" => "transparency.navigation",
        //     "navigation" => array(
        //         array("name" => "Exercicio",         "icon" => "fa fa-file",     "route" => "transparency.expense.list"),
        //     )
        // ),

        array("name" => "Bolsas e Auxílios.",               "parameter" => "bolsa",             "icon" => "fa fa-folder-open",    "route" => "transparency.navigation",
            "navigation" => array(
                array("name" => "Bolsas de Pesquisas Professor",    "icon" => "fa fa-file",   "parameter" => "bolsa-pesquisa-professor",    "route" => "transparency.document.list"),
                array("name" => "Bolsas de Pesquisas Técnico",      "icon" => "fa fa-file",   "parameter" => "bolsa-pesquisa-tecnico",      "route" => "transparency.document.list"),
                array("name" => "Bolsas de Pesquisas Alunos",       "icon" => "fa fa-file",   "parameter" => "bolsa-pesquisa-aluno",        "route" => "transparency.document.list"),

                array("name" => "Auxílio Atleta",                   "icon" => "fa fa-file",   "parameter" => "auxilio-atleta",        "route" => "transparency.document.list"),
                array("name" => "Auxílio Pro-Esportes",             "icon" => "fa fa-file",   "parameter" => "auxilio-pro-esporte",        "route" => "transparency.document.list"),
                array("name" => "Auxílio Viagem para Competições Esportivas (AVICE)",           "icon" => "fa fa-file",   "parameter" => "avice",        "route" => "transparency.document.list"),

                array("name" => "Programa de Assistência Complementar ao Estudante (PROACE)",   "icon" => "fa fa-file",   "parameter" => "proace",        "route" => "transparency.document.list"),
                array("name" => "Programa Institucional de Bolsas de Extensão (PIBEX)",         "icon" => "fa fa-file",   "parameter" => "pibex",        "route" => "transparency.document.list"),
                array("name" => "Programa Institucional de Bolsa Trabalho (PIBT)",              "icon" => "fa fa-file",   "parameter" => "pibt",        "route" => "transparency.document.list"),
                array("name" => "Projetos e Programas de Extensão (Geral)",                     "icon" => "fa fa-file",   "parameter" => "financiamento-proext",        "route" => "transparency.document.list"),
                array("name" => "Projetos e Programas de Extensão com UCEX",                    "icon" => "fa fa-file",   "parameter" => "ucex",        "route" => "transparency.document.list"),

                array("name" => "Eventos – Financiamento",                                      "icon" => "fa fa-file",   "parameter" => "edital-financiamento-eventos",        "route" => "transparency.document.list"),
                )
        ),


        array("name" => "Relatórios",              "parameter" => "relatorio",         "icon" => "fa fa-folder-open",    "route" => "transparency.navigation",
            "navigation" => array(
                array("name" => "GESTÃO",       "icon" => "fa fa-file",   "parameter" => "relatorio-gestao",     "route" => "transparency.document.list"),
                array("name" => "PROPLAD",      "icon" => "fa fa-file",   "parameter" => "relatorio-proplad",     "route" => "transparency.document.list"),
                array("name" => "PROGRAD",      "icon" => "fa fa-file",   "parameter" => "relatorio-prograd",     "route" => "transparency.document.list"),
                array("name" => "PROEXT",       "icon" => "fa fa-file",   "parameter" => "relatorio-proext",     "route" => "transparency.document.list"),
                array("name" => "PROPESP",      "icon" => "fa fa-file",   "parameter" => "relatorio-propesp",     "route" => "transparency.document.list"),
                array("name" => "UF",           "icon" => "fa fa-file",   "parameter" => "relatorio-uf",         "route" => "transparency.document.list"),
            )
        ),



        // array("name" => "CRONOGRAMA DE PAGAMENTO (UF)",     "parameter" => "cronograma",        "icon" => "fa fa-folder-open",    "route" => "transparency.navigation",
        //     "navigation" => array(
        //         array("name" => "Exercicio",         "icon" => "fa fa-file",     "route" => "transparency.expense.list"),
        //     )),

        // array("name" => "CPA",                              "parameter" => "cpa",               "icon" => "fa fa-folder-open",    "route" => "transparency.navigation",
        //     "navigation" => array(
        //         array("name" => "Exercicio",         "icon" => "fa fa-file",     "route" => "transparency.expense.list"),
        //     )
        // ),
        // array("name" => "CARTAS DE SERVIÇOS",               "parameter" => "carta",             "icon" => "fa fa-folder-open",    "route" => "transparency.navigation",
        //     "navigation" => array(
        //         array("name" => "Exercicio",         "icon" => "fa fa-file",     "route" => "transparency.expense.list"),
        //     )
        // ),
        // array("name" => "ACESSO A INFORMAÇÃO",              "parameter" => "acesso",            "icon" => "fa fa-folder-open",    "route" => "transparency.navigation",
        //     "navigation" => array(
        //         array("name" => "Exercicio",         "icon" => "fa fa-file",     "route" => "transparency.expense.list"),
        //     )
        // ),
        // array("name" => "INFORMAÇÕES GERAIS",               "parameter" => "geral",             "icon" => "fa fa-folder-open",    "route" => "transparency.navigation",
        //     "navigation" => array(
        //         array("name" => "Exercicio",         "icon" => "fa fa-file",     "route" => "transparency.expense.list"),
        //     )
        // )

    );

    if($type){
        $filtro =
            array_filter(
                $array,
                function ($value) use ($type) {
                    return (strpos($value['parameter'], $type) !== false);
                }

            );



        if(isset($filtro)){
            foreach ($filtro as $f){
                return $f['navigation'];
            }

        }

    }else{
        return $array;
    }



}
