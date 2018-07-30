<?php
if (!empty($_SESSION['convenio'])) {
    $data['cashback'] = (float)$_SESSION['convenio']['cashback'];
    $data['credenciado'] = (int)$_SESSION['convenio']['id'];
    $data['credenciado_juridico'] = $_SESSION['convenio']['type'];
    $data['data'] = date("Y-m-d H:i:s");
    $data['status'] = 0;
    $data['usuario_credenciado'] = $_SESSION['userlogin']['id'];
    $data['cliente_multiplica'] = $dados['cliente_multiplica'];
    $data['valor'] = $dados['valor'];

    $create = new \ConnCrud\Create();
    $create->exeCreate(PRE . "transacao", $data);
}