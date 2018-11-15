<?php
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$allow = !(date('d') > 4) && !empty($_SESSION['convenio']) && $_SESSION['convenio']['status'] == 1;

if($allow) {

    $up = new \ConnCrud\Update();
    $create = new \ConnCrud\Create();
    $del = new \ConnCrud\Delete();
    $read = new \ConnCrud\Read();

    //Obtém informações sobre o cliente
    $read->exeRead("clientes", "WHERE id = :id", "id={$id}");
    if($read->getResult()) {
        $cliente = $read->getResult()[0];

        //Verifica se o plano do cliente esta ativo, se estiver, impede o processo para evitar manipulações indesejadas
        $read->exeRead("planos", "WHERE id = :p", "p={$cliente['plano']}");
        if(!$read->getResult() || $read->getResult()[0]['status'] == 0) {
            //se não existir plano vinculado ou se estiver desativado, realiza vínculo com a empresa

            //remove associação com outra empresa
            $del->exeDelete("clientes_juridicos_clientes", "WHERE clientes_id = :cij", "cij={$id}");

            if(!$read->getResult()) {
                //cria um plano para o cliente

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
                //atualiza o plano do cliente

                $plano = [
                    "data_de_inicio" => $_SESSION['convenio']['data_de_inicio'],
                    "plano" => $_SESSION['convenio']['plano']['id'],
                    'status' => 1
                ];
                $up->exeUpdate("planos", $plano, "WHERE id=:idc", "idc={$cliente['plano']}");
            }

            //vincula com a empresa atual
            $create->exeCreate("clientes_juridicos_clientes", ["clientes_id" => $id, "clientes_juridicos_id" => $_SESSION['convenio']['id']]);
            $data['data'] = 1;
        } else {
            $data['data'] = 3;
        }
    } else {
        $data['data'] = 4;
    }
} else {
    $data['data'] = 2;
}