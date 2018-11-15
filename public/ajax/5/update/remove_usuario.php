<?php
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$allow = !(date('d') > 4) && !empty($_SESSION['convenio']) && $_SESSION['convenio']['status'] == 1;

if($allow) {

    //Remove associação do cliente com a empresa
    $del = new \ConnCrud\Delete();
    $read = new \ConnCrud\Read();

    $del->exeDelete("clientes_juridicos_clientes", "WHERE clientes_juridicos_id = :ci && clientes_id = :cc", "ci={$_SESSION['convenio']['id']}&cc={$id}");

    //garante que usuário não tenha o plano ativado após remoção
    $read->exeRead("clientes", "WHERE id = :id", "id={$id}");
    if($read->getResult()) {
        $up = new \ConnCrud\Update();
        $up->exeUpdate("planos", ["status" => 0], "WHERE id=:id", "id={$read->getResult()[0]['plano']}");
    }

    $data['data'] = 1;
} else {
    $data['data'] = 2;
}