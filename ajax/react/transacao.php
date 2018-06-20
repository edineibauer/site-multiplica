<?php

if($_SESSION['userlogin']['setor'] == 4) {
    $tipo = 1;
    $cash = null;
    $read = new \ConnCrud\Read();
    $read->exeRead(PRE . "funcionario_credenciado", "WHERE usuario = :ui", "ui={$_SESSION['userlogin']['id']}");
    if ($read->getResult()) {
        $idF = $read->getResult()[0]['id'];
        $read->exeRead(PRE . "credenciado_juridico_funcionario_credenciado_funcionarios", "WHERE funcionario_credenciado_id=:ui", "ui={$idF}");
        if ($read->getResult()) {
            $read->exeRead(PRE . "credenciado_juridico", "WHERE id = :id", "id={$read->getResult()[0]['credenciado_juridico_id']}");
        } else {
            $read->exeRead(PRE . "credenciado_fisico_funcionario_credenciado_funcionarios", "WHERE funcionario_credenciado_id=:ui", "ui={$idF}");
            if ($read->getResult()) {
                $read->exeRead(PRE . "credenciado_fisico", "WHERE id = :id", "id={$read->getResult()[0]['credenciado_fisico_id']}");
                $tipo = 0;
            }
        }
    }

    if (!$read->getResult())
        $read->exeRead(PRE . "credenciado_juridico", "WHERE usuario = :ui", "ui={$_SESSION['userlogin']['id']}");
    if (!$read->getResult()) {
        $read->exeRead(PRE . "credenciado_fisico", "WHERE usuario = :ui", "ui={$_SESSION['userlogin']['id']}");
        $tipo = 0;
    }
    if ($read->getResult()) {
        $data['cashback'] = $read->getResult()[0]['cashback'];
        $data['credenciado'] = $read->getResult()[0]['id'];
        $data['credenciado_juridico'] = $tipo;
        $data['data'] = date("Y-m-d H:i:s");
        $data['status'] = 0;
        $data['usuario_credenciado'] = $_SESSION['userlogin']['id'];
        $data['cliente_multiplica'] = $dados['cliente_multiplica'];
        $data['valor'] = $dados['valor'];
        $create = new \ConnCrud\Create();
        $create->exeCreate(PRE . "transacao", $data);
    }
}