<?php

include_once 'inc/createUserAccount.php';
include_once 'inc/uploadExcel.php';
include_once 'inc/clienteStatus.php';

$setor = $_SESSION['userlogin']['setor'];
$read = new \ConnCrud\Read();
$up = new \ConnCrud\Update();
if($setor === "7") {
    $read->exeRead("revenda", "WHERE login = :li", "li={$_SESSION['userlogin']['id']}");
    if($read->getResult())
        $up->exeUpdate("clientes_juridicos", ['revenda' => (int)$read->getResult()[0]['id']], "WHERE id = :id", "id={$dados['id']}");

} elseif($setor === "8") {
    $read->exeRead("consultor", "WHERE login = :li", "li={$_SESSION['userlogin']['id']}");
    if($read->getResult()) {
        $cliente = ['consultor' => $read->getResult()[0]['id']];
        $read->exeRead("revenda", "WHERE id = :idr", "idr={$read->getResult()[0]['revenda']}");
        if($read->getResult())
            $cliente['revenda'] = $read->getResult()[0]['id'];

        $up->exeUpdate("clientes_juridicos", $cliente, "WHERE id = :id", "id={$dados['id']}");
    }
}