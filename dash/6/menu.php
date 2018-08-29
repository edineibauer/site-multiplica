<?php
if ($_SESSION['userlogin']['setor'] > 3 && $_SESSION['userlogin']['setor'] < 7 && !isset($_SESSION['convenio'])) {
    $type = 1;
    $read = new \ConnCrud\Read();
    $read->exeRead(PRE . "clientes", "WHERE acesso = :ui", "ui={$_SESSION['userlogin']['id']}");
    if ($read->getResult()) {
        $ii = $read->getResult()[0]['id'];
        $read->exeRead(PRE . "credenciado_juridico_clientes_funcionarios", "WHERE clientes_id = :ii", "ii={$ii}");
        if ($read->getResult()) {
            $read->exeRead(PRE . "credenciado_juridico", "WHERE id = :u", "u={$read->getResult()[0]['credenciado_juridico_id']}");
        } else {
            $read->exeRead(PRE . "credenciado_fisico_clientes_funcionarios", "WHERE clientes_id = :ii", "ii={$ii}");
            if ($read->getResult()) {
                $read->exeRead(PRE . "credenciado_fisico", "WHERE id = :u", "u={$read->getResult()[0]['credenciado_fisico_id']}");
                $type = 0;
            }
        }

        if ($read->getResult()) {
            $_SESSION['convenio'] = $read->getResult()[0];
            $_SESSION['convenio']['type'] = $type;
        }
    }
}

if (isset($_SESSION['convenio']))
    include_once PATH_HOME . DEV_PATH . 'dash/4/inc/menu.php';