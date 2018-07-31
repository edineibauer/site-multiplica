<?php
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$type = ($_SESSION['convenio']['type'] ? "juridica" : "fisica");

$up = new \ConnCrud\Update();
$del = new \ConnCrud\Delete();

$del->exeDelete("cliente_p_{$type}_clientes_usuarios", "WHERE clientes_id = :cij", "cij={$id}");
$up->exeUpdate("clientes", ["status_do_convenio" => 0], "WHERE id=:id", "id={$id}");

$data['data'] = 1;