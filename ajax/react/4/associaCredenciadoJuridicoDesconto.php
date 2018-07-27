<?php
$up = new \ConnCrud\Update();
$read = new \ConnCrud\Read();
$read->exeRead("credenciado_juridico_descontos_descontos", "WHERE credenciado_juridico_id = :id", "id={$dados['id']}");
if($read->getResult()) {
    foreach ($read->getResult() as $rel)
        $up->exeUpdate("descontos", ["credenciado_juridico_id" => $dados['id']], "WHERE id = :di", "di={$rel['descontos_id']}");
}