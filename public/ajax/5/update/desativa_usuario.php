<?php
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$allow = !(date('d') > 4) && !empty($_SESSION['convenio']) && $_SESSION['convenio']['status'] == 1;
$data['data'] = 2;

if($allow) {
    $read = new \ConnCrud\Read();
    $read->exeRead("clientes", "WHERE id = :id", "id={$id}");
    if($read->getResult()) {
        $up = new \ConnCrud\Update();
        $up->exeUpdate("planos", ["status" => 0], "WHERE id=:id", "id={$read->getResult()[0]['plano']}");
        $data['data'] = 1;
    }
}