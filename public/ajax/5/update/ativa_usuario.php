<?php
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$allow = !(date('d') > 4) && !empty($_SESSION['convenio']) && $_SESSION['convenio']['status'] == 1;
$data['data'] = 2;

if($allow) {
    $read = new \ConnCrud\Read();
    $read->exeRead("clientes", "WHERE id = :id", "id={$id}");
    if($read->getResult()) {
        $cliente = $read->getResult()[0];
        $up = new \ConnCrud\Update();

        //Verifica se o usuário possui plano
        if(empty($cliente['plano'])) {
            //cria plano

            $plano = [
                "data_de_inicio" => $_SESSION['convenio']['data_de_inicio'],
                "plano" => $_SESSION['convenio']['plano']['id'],
                'status' => 1
            ];

            $create = new \ConnCrud\Create();
            $create->exeCreate("planos", $plano);
            if($create->getResult())
                $up->exeUpdate("clientes", ["plano" => $create->getResult()],"WHERE id = :id", "id={$id}");

        } else {
            //atualiza
            $plano = [
                "data_de_inicio" => $_SESSION['convenio']['data_de_inicio'],
                "plano" => $_SESSION['convenio']['plano']['id'],
                'status' => 1
            ];
            $up->exeUpdate("planos", $plano, "WHERE id = :idc", "idc={$cliente['plano']}");
        }
        $data['data'] = 1;
    } else {
        $data['data'] = 3;
    }
}