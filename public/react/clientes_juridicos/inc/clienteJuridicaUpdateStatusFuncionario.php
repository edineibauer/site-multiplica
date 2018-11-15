<?php

if ($dadosOld['status'] !== $dados['status']) {
    $read = new \ConnCrud\Read();
    $read->exeRead(PRE . "cliente_p_juridica_clientes_funcionarios", "WHERE cliente_p_juridica_id = :cid", "cid={$dados['id']}");
    if ($read->getResult()) {
        //status mudou
        $up = new \ConnCrud\Update();
        foreach ($read->getResult() as $cliente)
            $up->exeUpdate(PRE . "clientes", ["status_do_convenio" => $dados['status']], "WHERE id = :client", "client={$cliente['clientes_id']}");
    }
}