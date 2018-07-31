<?php

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$type = ($_SESSION['convenio']['type'] ? "juridica" : "fisica");

$up = new \ConnCrud\Update();
$create = new \ConnCrud\Create();
$del = new \ConnCrud\Delete();

$del->exeDelete("cliente_p_juridica_clientes_usuarios", "WHERE clientes_id = :ci", "ci={$id}");
$del->exeDelete("cliente_p_fisica_clientes_usuarios", "WHERE clientes_id = :cij", "cij={$id}");
$up->exeUpdate("clientes", ["status_do_convenio" => 1], "WHERE id=:id", "id={$id}");
$create->exeCreate("cliente_p_{$type}_clientes_usuarios", ["clientes_id" => $id, "cliente_p_{$type}_id" => $_SESSION['convenio']['id']]);

$data['data'] = 1;