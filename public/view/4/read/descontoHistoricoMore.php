<?php

function mask($val, $mask)
{
    $maskared = '';
    $k = 0;
    for ($i = 0; $i <= strlen($mask) - 1; $i++) {
        if ($mask[$i] == '#') {
            if (isset($val[$k]))
                $maskared .= $val[$k++];
        } else {
            if (isset($mask[$i]))
                $maskared .= $mask[$i];
        }
    }
    return $maskared;
}

$dados = "<ul class='col'>";
$read = new \ConnCrud\Read();
$read->exeRead(PRE . "desconto_multiplica", "WHERE autor = :c ORDER BY id DESC LIMIT 30", "c={$_SESSION['userlogin']['id']}");
if ($read->getResult()) {
    $datetime = new \Helpers\DateTime();
    foreach ($read->getResult() as $item) {
        $valorFinal = 0;
        $totalDesconto = 0;

        $read->exeRead("clientes", "WHERE id = :ic", "ic={$item['conveniado_multiplica']}");
        $cpf = $read->getResult() ? $read->getResult()[0]['cpf'] : "Erro ao buscar Cliente";

        $read->exeRead(PRE . "desconto_multiplica_descontos_descontos", "WHERE desconto_multiplica_id = :dmi", "dmi={$item['id']}");
        if($read->getResult()) {
            foreach ($read->getResult() as $desc) {
                $read->exeRead(PRE . "descontos", "WHERE id = :ii", "ii={$desc['descontos_id']}");
                if($read->getResult()) {
                    $valorFinal += $read->getResult()[0]['valor_particular'];
                    $totalDesconto += $read->getResult()[0]['valor_multiplica'];
                }
            }
        }
        $dados .= "<li class='col'><button class='btn-floating theme pointer opacity hover-opacity-off hover-shadow'><i class='material-icons left padding-right'>print</i></button>"
            . "<div class='left padding-8 container'>"
            . "<span class='color-text-grey'>[{$datetime->getDateTime($item['data'], 'd/m H:i')}]</span>"
            . "&nbsp;&nbsp;&nbsp;"
            . mask($cpf,'###.###.###-##')
            . "&nbsp;&nbsp; => &nbsp;<span class='text-theme-d'>Total: R$" . $valorFinal . "</span>"
            . "</div></li>";
    }
}

$data['data'] = $dados;