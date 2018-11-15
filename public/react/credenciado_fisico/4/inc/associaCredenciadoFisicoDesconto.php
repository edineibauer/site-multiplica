<?php
$up = new \ConnCrud\Update();
$read = new \ConnCrud\Read();
$up->exeUpdate("descontos", ["credenciado_fisico_id" => null], "WHERE credenciado_fisico_id = :di", "di={$dados['id']}");
$read->exeRead("credenciado_fisico_descontos_descontos", "WHERE credenciado_fisico_id = :id", "id={$dados['id']}");
if($read->getResult()) {
    foreach ($read->getResult() as $rel)
        $up->exeUpdate("descontos", ["credenciado_fisico_id" => $dados['id']], "WHERE id = :di", "di={$rel['descontos_id']}");
}