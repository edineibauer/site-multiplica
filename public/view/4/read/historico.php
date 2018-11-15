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
$read->exeRead(PRE . "transacao", "WHERE usuario_credenciado = :c ORDER BY id DESC LIMIT 5", "c={$_SESSION['userlogin']['id']}");
if ($read->getResult()) {
    $datetime = new \Helpers\DateTime();
    foreach ($read->getResult() as $item) {
        $read->exeRead(PRE . "clientes", "WHERE id = :id", "id={$item['cliente_multiplica']}");
        if ($read->getResult())
            $dados .= "<li class='col'><span class='color-text-grey'>[{$datetime->getDateTime($item['data'], 'd/m H:i')}]</span>"
                . "&nbsp;&nbsp;&nbsp;" . mask($read->getResult()[0]['cpf'],'###.###.###-##') . "&nbsp;&nbsp; => &nbsp;<span class='text-theme-d'>R$" . $item['valor'] . "</span></li>";
    }
}

$dados .= "</ul>";

$data['data'] = $dados;