<html>

<head>
    <meta charset="UTF-8">
    <meta charset="utf-8">
    <title>@php echo $filename; @endphp</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            font-size: 10px;
            font-family: verdana;
            color: #000 !important;
            -webkit-print-color-adjust: exact;
        }

        h1 {
            font-size: 15px !important;
        }

        small {
            font-size: 9px;
        }

        .cell-label {
            font-size: 9px;
            font-weight: bold;
        }

        .tabela {
            border: 1px solid #000;
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            margin: 0;
            padding: 2px;
            border: 1px solid;

        }


        .feriado {
            background: #ccc !important;
            letter-spacing: 5px;
        }

        @page {
            size: A4;
            /* or 'letter', 'auto', etc. */
            margin: 0.5cm;
            /* Adjust margins as needed */
        }

        @media print {
            .assinatura {
                width: 100%;
            }

            .feriado {
                background: #ccc !important;

                max-width: 600px;
                letter-spacing: 3px;
                text-align: left;
                white-space: nowrap; /* Prevent text from wrapping */
                overflow: hidden; /* Hide overflow */
                text-overflow: ellipsis; /* Add ellipsis (...) for overflow text */
            }


        }
    </style>
</head>

<body>

    @php

        function dia_pascoa($ano)
        {
            //retorna a pascoa
            $a = fmod($ano, 19);
            $b = floor($ano / 100);
            $c = fmod($ano, 100);
            $d = floor($b / 4);
            $e = fmod($b, 4);
            $f = floor(($b + 8) / 25);
            $g = floor(($b - $f + 1) / 3);
            $h = fmod(19 * $a + $b - $d - $g + 15, 30);
            $i = floor($c / 4);
            $k = fmod($c, 4);
            $l = fmod(32 + 2 * $e + 2 * $i - $h - $k, 7);
            $m = floor(($a + 11 * $h + 22 * $l) / 451);
            $mes = floor(($h + $l - 7 * $m + 114) / 31);
            $dia = fmod($h + $l - 7 * $m + 114, 31) + 1;
            return mktime(0, 0, 0, $mes, $dia, $ano);
        }

        function calendario($user, $month, $year, $type, $occurrences, $occurrences_user)
        {
            //Vari�vel de retorno do código em HTML
            $retorno = '';

            //Primeira linha do calendário
            $arr_dias = ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'];

            //Deseja iniciar pelo sábado?
            $ini_sabado = false;

            //Feriados comuns

            function dateRange($first, $last, $step = '+1 day', $format = 'd/m/Y')
            {
                $dates = [];
                $current = strtotime($first);
                $last = strtotime($last);

                while ($current <= $last) {
                    $dates[] = date($format, $current);
                    $current = strtotime($step, $current);
                }

                return $dates;
            }

            //GERA OCORRENCIAS

            if ($occurrences) {
                foreach ($occurrences as $ocorrencia) {
                    $descricao = $ocorrencia->description;

                    $datas = dateRange($ocorrencia->start_date, $ocorrencia->end_date);

                    foreach ($datas as $d) {
                        $dt = explode('/', $d);

                        if ($year == $dt[2]) {
                            $dx = (int) $dt[0];
                            $mx = (int) $dt[1];
                            $feriados["$dx-$mx"] = "$descricao";
                        }
                    }
                }
            }

            //GERA AS FÉRIAS CONFORME O SERVIDOR
            if ($occurrences_user) {
                foreach ($occurrences_user as $ferias) {
                    $descricao = $ferias->description;

                    $datas = dateRange($ferias->start_date, $ferias->end_date);

                    foreach ($datas as $d) {
                        $dt = explode('/', $d);
                        if ($year == $dt[2]) {
                            $dx = (int) $dt[0];
                            $mx = (int) $dt[1];

                            $feriados["$dx-$mx"] = "$descricao";
                        }
                    }
                }
            }

            //Feriados com data mutante
            $pascoa = dia_pascoa($year);
            $feriados[date('j-n', $pascoa)] = 'PÁSCOA';
            $feriados[date('j-n', $pascoa - 86400 * 2)] = 'PAIXÃO';
            $feriados[date('j-n', $pascoa - 86400 * 46)] = 'CINZAS';
            $feriados[date('j-n', $pascoa - 86400 * 47)] = 'CARNAVAL';
            $feriados[date('j-n', $pascoa + 86400 * 60)] = 'CORPUS CHRISTI';

            $cont_mes = 1;
            if ($ini_sabado) {
                $dia_semana = converte_dia(date('w', mktime(0, 0, 0, $month, 1, $year))); //dia da semana do primeiro dia do mes
            } else {
                //Comum
                $dia_semana = date('w', mktime(0, 0, 0, $month, 1, $year));
            }
            $t_mes = date('t', mktime(0, 0, 0, $month, 1, $year)); //no. total de dias no mes

            //dados do mes passado
            $dia_semana_ant = date('d', mktime(0, 0, 0, $month, 0, $year)) + 1 - $dia_semana;
            $mes_ant = date('m', mktime(0, 0, 0, $month, 0, $year));
            $ano_ant = date('Y', mktime(0, 0, 0, $month, 0, $year));

            //dados do mes seguinte
            $dia_semana_post = 1;
            $mes_post = date('m', mktime(0, 0, 0, $month, $t_mes + 1, $year));
            $ano_post = date('Y', mktime(0, 0, 0, $month, $t_mes + 1, $year));

            $retorno .= '<center>';

            //titulo do calendario
            $retorno .= "<div class=\"titulo\">";

            $retorno .=
                "<div style='display: flex; justify-content: flex-end; font-weight: bold; font-size: 11px;'>Controle de Frequência</div>";
            $retorno .= "<div style='display: flex; gap: 4px; margin-top: 2px;'>
                    <img height='60px' src='../../custom/manager/images/brasao_gea.png' />
                    <div style='flex: 1; display: flex; flex-direction:column; align-items: flex-start; justify-content: center'>
                        <strong style='font-size: 12px; margin-bottom: 3px;'>UNIVERSIDADE DO ESTADO DO AMAPÁ | UEAP</strong>

                    </div>
                    <img style='float:right'height='56px' src='../../custom/manager/images/brasao_ueap_sem_nome.png'>
                </div>";
            $retorno .=
                "<div style='display: flex; justify-content: flex-end;'>
                    <div style='padding: 2px 20px; background: #ccc'>Mês/Ano: " .
                converte_mes($month) .
                '/' .
                $year .
                "</div>
                </div>";

            //montagem do calendario

            if (request('type') == 'blank') {
                $enrollment = '<br/>';
            } else {
                $enrollment = $user->enrollment;
            }

            $local = $user->records?->local ?? "<br/>";

            $retorno .= "<table class='tabela' style='margin-top: 6px;'>";
            $retorno .=
                '<tr>' .
                "<td colspan='2'><span class='cell-label'>Unidade Organizacional</span><br/>" .
                $user->group->description .
                '</td>' .
                '</tr>' .
                '<tr>' .
                "<td style='width: 50% !important;'><span class='cell-label'>Município</span><br/>" .
                $local .
                '</td>' .
                "<td style='width: 50% !important;'></td>" .
                '</tr>';
            $retorno .= '</table>';

            $retorno .= "<div style='text-align: left;'>Servidor</div>";

            $retorno .= "<table class='tabela'>";
            $retorno .=
                "<tr style='vertical-align: top;'>" .
                "<td width='48%'><span class='cell-label'>Nome</span><br/>" .
                $user->person->name .
                '</td>' .
                "<td width='12%'><span class='cell-label'>Matrícula</span><br/>" .
                $user->enrollment .
                '</td>' .
                "<td width='12%' colspan='2'><span class='cell-label'>CPF</span><br/>" .
                $user->person->cpf_cnpj .
                '</td>' .
                "<td width='12%' colspan='2'><span class='cell-label'>Carga horária</span><br/><br/></td>" .
                "<td><span class='cell-label'>Jornada</span><br/><br/></td>" .
                '</tr>';

            $retorno .=
                "<tr style='vertical-align: top;'>" . "<td width='48%'<span class='cell-label'>Cargo</span><br/>";

            if ($type == 'commissioned_role' and $user->commissioned_role_id > 0 and request('type') != 'blank') {
                if ($user->effective_role) {
                    $retorno .= $user->effective_role->description . ' | ' . $user->commissioned_role->description;
                } else {
                    $retorno .= $user->commissioned_role->description;
                }
            } else {
                if ($user->effective_role and request('type') != 'blank') {
                    $retorno .= $user->effective_role->description;
                } else {
                    $retorno .= '<br/>';
                }
            }
            $retorno .=
                '</td>' .
                "<td width='12%'><span class='cell-label'>Tipo Vínculo</span><br/><br/></td>" .
                "<td width='18%' colspan='3'><span class='cell-label'>Nível/Referência</span><br/><br/></td>" .
                "<td width='6%' colspan='1'><span class='cell-label'>Federal</span><br/><br/></td>" .
                "<td><span class='cell-label'>Matrícula SIAPE</span><br/><br/></td>" .
                '</tr></table>';

            //Cabeçalho da Tabela

            $retorno .= "<table class='tabela' style='margin-top: 4px;'>";
            $retorno .= "<tr class='cell-label'>";
            $retorno .= "<td width='2%;' rowspan='2' >Dia</td>";
            $retorno .= "<td width='23%;' align='center' colspan='2'>Manhã/Hora</td>";
            $retorno .= "<td width='23%;' align='center' colspan='2'>Tarde/Hora</td>";
            $retorno .= "<td width='23%;' align='center' colspan='2'>Noite/Hora</td>";
            $retorno .= "<td width='30%;' rowspan='2' align='center' colspan='4'>Assinatura</td>";
            $retorno .= '</tr>';

            $retorno .= "<tr class='cell-label'>";
            $retorno .= "<td width='6%;'align='center'>Entrada</td>";
            $retorno .= "<td width='6%;' align='center'>Saída</td>";
            $retorno .= "<td width='6%;' align='center'>Entrada</td>";
            $retorno .= "<td width='6%;' align='center'>Saída</td>";
            $retorno .= "<td width='6%;' align='center'>Entrada</td>";
            $retorno .= "<td width='6%;'align='center'>Saída</td>";
            $retorno .= '</tr>';

            $cont_cor = 0;
            while ($t_mes >= $cont_mes) {
                $cont_semana = 0;
                $retorno .= '<tr>';
                if ($dia_semana == 7) {
                    $dia_semana = 0;
                }

                if ($cont_cor % 2 != 0) {
                    $cor = '#282828';
                } else {
                    $cor = '#282828';
                }

                $request = request();

                while ($dia_semana < 7) {
                    if ($cont_mes <= $t_mes) {
                        // celula do dia do mes
                        if ($dia_semana == $cont_semana) {
                            $retorno .= '<tr>';
                            $retorno .= "<td align='center' valign='top' class='dia'>" . $cont_mes . '</td>';
                            if (isset($feriados[$cont_mes . '-' . $month])) {
                                $nome_feriado = $feriados[$cont_mes . '-' . ((int) $month)];
                            } else {
                                $nome_feriado = '';
                            }

                            if ($nome_feriado != '') {
                                if ($nome_feriado == 'CINZAS') {
                                    $retorno .=
                                        "<td style='background:#ccc;-webkit-print-color-adjust:exact;' colspan='2'><center>" .
                                        $nome_feriado .
                                        '</center></td>';
                                    $retorno .= "<td align='center'> 14:00 </td>";
                                    $retorno .= "<td align='center'> 18:00 </td>";
                                    $retorno .= "<td align='center'> - </td>";
                                    $retorno .= "<td align='center'> - </td>";

                                    if (
                                        $request->use_signature == 'yes' and
                                        file_exists(public_path('storage/signatures/' . $user->uuid . '.jpg'))
                                    ) {
                                        $retorno .=
                                            "<td align='center'> <img style='height:15px;'  src='/storage/signatures/" .
                                            $user->uuid .
                                            ".jpg'></td>";
                                    } else {
                                        $retorno .= "<td align='center'></td>";
                                    }
                                } else {
                                    $retorno .=
                                        "<td class='feriado' style='-webkit-print-color-adjust:exact;' colspan='7'>" .
                                        $nome_feriado .
                                        '</td>';
                                }
                            } elseif ($dia_semana == 6) {
                                $retorno .= "<td class='feriado' colspan='7'>SÁBADO</td>";
                            } elseif ($dia_semana == 0) {
                                $retorno .= "<td class='feriado' colspan='7'>DOMINGO</td>";
                            } else {
                                if (true) {
                                    $retorno .= "<td align='center'>";
                                    if ($request->manha_start) {
                                        $retorno .= $request->manha_start;
                                    } else {
                                        $retorno .= ' - ';
                                    }
                                    $retorno .= '</td>';
                                    $retorno .= "<td align='center'>";
                                    if ($request->manha_end) {
                                        $retorno .= $request->manha_end;
                                    } else {
                                        $retorno .= ' - ';
                                    }
                                    $retorno .= '</td>';

                                    $retorno .= "<td align='center'>";
                                    if ($request->tarde_start) {
                                        $retorno .= $request->tarde_start;
                                    } else {
                                        $retorno .= ' - ';
                                    }
                                    $retorno .= '</td>';
                                    $retorno .= "<td align='center'>";
                                    if ($request->tarde_end) {
                                        $retorno .= $request->tarde_end;
                                    } else {
                                        $retorno .= ' - ';
                                    }
                                    $retorno .= '</td>';

                                    $retorno .= "<td align='center'>";
                                    if ($request->noite_start) {
                                        $retorno .= $request->noite_start;
                                    } else {
                                        $retorno .= ' - ';
                                    }
                                    $retorno .= '</td>';
                                    $retorno .= "<td align='center'>";
                                    if ($request->noite_end) {
                                        $retorno .= $request->noite_end;
                                    } else {
                                        $retorno .= ' - ';
                                    }
                                    $retorno .= '</td>';
                                } else {
                                    $retorno .= "<td align='center'> </td>";
                                    $retorno .= "<td align='center'> </td>";
                                    $retorno .= "<td align='center'> </td>";
                                    $retorno .= "<td align='center'> </td>";
                                    $retorno .= "<td align='center'> </td>";
                                    $retorno .= "<td align='center'> </td>";
                                }

                                if (
                                    $request->use_signature == 'yes' and
                                    file_exists(public_path('storage/signatures/' . $user->uuid . '.jpg'))
                                ) {
                                    $retorno .=
                                        "<td align='center'> <img style='height:15px;'  src='/storage/signatures/" .
                                        $user->uuid .
                                        ".jpg'></td>";
                                } else {
                                    $retorno .= "<td align='center'></td>";
                                }
                            }

                            $retorno .= '</tr>';
                            $cont_mes++;
                            $dia_semana++;
                            $cont_semana++;
                        } else {
                            $cont_semana++;
                            $dia_semana_ant++;
                        }
                    } else {
                        while ($cont_semana < 7) {
                            $cont_semana++;
                            $dia_semana_post++;
                        }
                        break 2;
                    }
                }
                $retorno .= '</tr>';
                $cont_cor++;
            }

            $retorno .= '</table>';

            $retorno .= "<div style='display: flex; gap: 4px; margin-top: 50px; margin-bottom: 200px;'>
                <div style='flex: 2'>
                    <table class='tabela' style='margin-top: 12px;'>
                        <tr height='28px'>
                            <td rowspan='6' width='65px' style='font-size: 7px; text-align: center; vertical-align: top; padding: 6px;'>
                                Em caso de abono
                                a chefia imediata
                                deverá especificar
                                o dia a ser
                                abonado,
                                descrever
                                o motivo e assinar
                                </td>
                            <td width='30px' style='text-align: center;'>Dia</td>
                            <td width='45%' style='text-align: center;'>Motivo</td>
                            <td style='text-align: center;'>Assinatura</td>
                            </tr>";
            for ($n = 0; $n < 5; $n++) {
                $retorno .= "<tr>
                            <td><br/></td>
                            <td><br/></td>
                            <td><br/></td>
                        </tr>";
            }

            $retorno .= "</table>
                </div>
                    <div style='flex: 1'>
                        <div style='text-align: left; font-weight: bold;'>Servidor</div>
                        <table class='tabela'>
                            <tr height='30px'>
                                <td colspan='2' style='font-size: 8px'>
                                    Reconheço como verdadeiras as anotações sobre a minha assiduidade e pontualidade e as assumo na íntegra.
                                </td>
                            </tr>
                            <tr style='height: 35px; vertical-align: top;'>
                                <td width='40px'><small>Data</small></td>
                                <td><small>Assinatura</small></td>
                            </tr>
                        </table>
                        <div style='text-align: left; font-weight: bold;'>Chefia imediata</div>
                        <table class='tabela'>
                            <tr style='height: 35px; vertical-align: top;'>
                                <td width='40px'><small>Data</small></td>
                                <td><small>Assinatura</small></td>
                            </tr>
                        </table>
                    </div>
                </div>";

            return $retorno;
        }

        function converte_dia($dia_semana)
        {
            //funcao para comecar a montar o calendario pela quarta-feira
            if ($dia_semana == 0) {
                $dia_semana = 1;
            } elseif ($dia_semana == 1) {
                $dia_semana = 2;
            } elseif ($dia_semana == 2) {
                $dia_semana = 3;
            } elseif ($dia_semana == 3) {
                $dia_semana = 4;
            } elseif ($dia_semana == 4) {
                $dia_semana = 5;
            } elseif ($dia_semana == 5) {
                $dia_semana = 6;
            } elseif ($dia_semana == 6) {
                $dia_semana = 0;
            }

            return $dia_semana;
        }

        function converte_mes($mes)
        {
            if ($mes == 1) {
                $mes = 'Janeiro';
            } elseif ($mes == 2) {
                $mes = 'Fevereiro';
            } elseif ($mes == 3) {
                $mes = 'Março';
            } elseif ($mes == 4) {
                $mes = 'Abril';
            } elseif ($mes == 5) {
                $mes = 'Maio';
            } elseif ($mes == 6) {
                $mes = 'Junho';
            } elseif ($mes == 7) {
                $mes = 'Julho';
            } elseif ($mes == 8) {
                $mes = 'Agosto';
            } elseif ($mes == 9) {
                $mes = 'Setembro';
            } elseif ($mes == 10) {
                $mes = 'Outubro';
            } elseif ($mes == 11) {
                $mes = 'Novembro';
            } elseif ($mes == 12) {
                $mes = 'Dezembro';
            }
            return strtoupper($mes);
        }

    @endphp

    {!! calendario($user, $month, $year, $type, $occurrences, $occurrences_user) !!}
</body>

</html>
