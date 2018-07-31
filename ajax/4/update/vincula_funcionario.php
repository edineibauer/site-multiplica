<?php
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$type = ($_SESSION['convenio']['type'] ? "juridico" : "fisico");

$up = new \ConnCrud\Update();
$create = new \ConnCrud\Create();
$del = new \ConnCrud\Delete();

$del->exeDelete("credenciado_juridico_clientes_funcionarios", "WHERE clientes_id = :ci", "ci={$id}");
$del->exeDelete("credenciado_fisico_clientes_funcionarios", "WHERE clientes_id = :cij", "cij={$id}");
$up->exeUpdate("clientes", ["status_do_convenio" => 1], "WHERE id=:id", "id={$id}");
$create->exeCreate("credenciado_{$type}_clientes_funcionarios", ["clientes_id" => $id, "credenciado_{$type}_id" => $_SESSION['convenio']['id']]);

$data['data'] = 1;
