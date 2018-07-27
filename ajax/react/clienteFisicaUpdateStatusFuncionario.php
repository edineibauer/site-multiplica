<?php

if ($dadosOld['status'] !== $dados['status']) {
    $read = new \ConnCrud\Read();
    $read->exeRead(PRE . "cliente_p_fisica_clientes_funcionarios", "WHERE cliente_p_fisica_id = :cid", "cid={$dados['id']}");
    if ($read->getResult()) {
        $up = new \ConnCrud\Update();
        foreach ($read->getResult() as $cliente)
            $up->exeUpdate(PRE . "clientes", ["status_do_convenio" => $dados['status']], "WHERE id = :client", "client={$cliente['clientes_id']}");
    }
}