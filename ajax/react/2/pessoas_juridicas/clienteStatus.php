<?php
$d = new \EntityForm\Dicionario($entity);
$c = $d->search("status")->getColumn();
if (!empty($c)) {
    $read = new \ConnCrud\Read();
    $read->exeRead("pessoas_juridicas", "WHERE id=:id", "id={$dados['id']}");
    if ($read->getResult())
        $dados['plano'] = (int)$read->getResult()[0]['plano'];

    $read->exeRead(PRE . "pessoas_juridicas_clientes_usuarios", "WHERE pessoas_juridicas_id = :cid", "cid={$dados['id']}");
    if ($read->getResult()) {
        //status mudou
        $up = new \ConnCrud\Update();
        $create = new \ConnCrud\Create();
        foreach ($read->getResult() as $cliente) {
            $read->exeRead(PRE . "clientes", "WHERE id=:id", "id={$cliente['clientes_id']}");
            if ($read->getResult() && !empty($read->getResult()[0]['plano'])) {
                $up->exeUpdate(PRE . "planos", ["status" => $dados['status'], "plano" => $dados['plano']], "WHERE id = :client", "client={$read->getResult()[0]['plano']}");
            } elseif ($read->getResult()) {
                $create->exeCreate("planos", ["status" => $dados['status'], "plano" => $dados['plano'], "data_de_inicio" => date("Y-m-d")]);
                $up->exeUpdate("clientes", ["plano" => $create->getResult()], "WHERE id = :uid", "uid={$cliente['clientes_id']}");
            }
        }
    }
}